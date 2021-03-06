<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Omnipay\Omnipay;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quantity;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCartController extends Controller
{
    public $gateway;
    public $completePaymentUrl;

    public function __construct()
    {
        $this->gateway = Omnipay::create('Stripe\PaymentIntents');
        $this->gateway->setApiKey(env('STRIPE_SECRET_KEY'));
        $this->completePaymentUrl = url('confirm');
    }


    public function index()
    {
        # code...
        return view("Home.shopping_cart");
    }

    public function addToCart($id, Request $req)
    {
        if ($req->color) {
            // $listProduct = Product::find($id);
            //     ->join('product_image', 'product.MaDT', '=', 'product_image.MaDT')
            //     ->join('product_quantity', 'product.MaDT', '=', 'product_quantity.MaDT')
            //     ->where('product_quantity.Mau', '=', $req->color)
            $color = $req->color;
            $listProduct = Product::where('MaDT', $id)->select(['MaDT', 'TenDT'])
                ->with('image')
                ->with(['quantity' => function ($q) use ($req) {
                    $q->where('Mau', '=', $req->color);
                }])
                ->first();
        } else {
            // $listProduct = Product::join('product_image', 'product.MaDT', '=', 'product_image.MaDT')
            //     ->join('product_quantity', 'product.MaDT', '=', 'product_quantity.MaDT')
            //     ->find($id);
            $listProduct = Product::find($id);
            $color = $listProduct->quantity[0]->Mau;
        }
        $reqQty = $req->input('qtyproduct');
        // $cartitem = Cart::content()->where('id', $id);
        // dd($cartitem);
        $cartitem = Cart::search(function ($cartItem, $rowId) use ($color, $id) {
            return $cartItem->id == $id && $cartItem->options->color == $color;
        });
        // dd($cartitem);
        // echo $listProduct->SoLuong;
        // echo $req->color;
        if(isset($reqQty)){
            if((int)$reqQty <= 0 || !is_numeric($reqQty)){
                return back()->with('error', 'S??? l?????ng kh??ng h???p l???!');
            }
        }else{
            $reqQty = 1;
        }
        // if (!$reqQty)
        //     $reqQty = 1;
        if (Cart::count() > 0) {
            // $cartitem = Cart::content()->where('id', $id)
            //     ->where('options',$req->color);
            // $checksl = $cartitem->flatten(0)[0]->qty ? $cartitem->flatten(0)[0]->qty : 0;
            // s??? l?????ng trong gi??? h??ng
            if (count($cartitem) == 0)
                $checksl = 0;
            else
                $checksl = $cartitem->flatten(0)[0]->qty;
            // echo $checksl."<br>";
            // echo $reqQty;
            // echo $listProduct->quantity[0]->SoLuong;
            if ($listProduct->quantity[0]->SoLuong >= $checksl + $reqQty) {
                // if ($listProduct->SoLuong > 0) {
                Cart::add(['id' => $listProduct->MaDT, 'name' => $listProduct->TenDT, 'qty' => !$reqQty ? 1 : $reqQty, 'price' => $listProduct->quantity[0]->DonGiaBan, 'weight' => $listProduct->quantity[0]->SoLuong, 'options' => ['photo' => $listProduct->image[0]->Anh, 'color' => $listProduct->quantity[0]->Mau]]);
                return back()->with('msg', '???? th??m v??o gi??? h??ng!');
            } else {
                return back()->with('error', 'Kh??ng ????? s??? l?????ng trong kho!');
            }
        } else {
            if ($listProduct->quantity[0]->SoLuong >= $reqQty) {
                Cart::add(['id' => $listProduct->MaDT, 'name' => $listProduct->TenDT, 'qty' => !$reqQty ? 1 : $reqQty, 'price' => $listProduct->quantity[0]->DonGiaBan, 'weight' => $listProduct->quantity[0]->SoLuong, 'options' => ['photo' => $listProduct->image[0]->Anh, 'color' => $listProduct->quantity[0]->Mau]]);
                return back()->with('msg', '???? th??m v??o gi??? h??ng!');
            } else {
                return back()->with('error', 'Kh??ng ????? s??? l?????ng trong kho!');
            }
        }
    }

    function increaseCart($rowid)
    {
        $ww = Cart::get($rowid);
        // $soluong = Quantity::where('MaDT','=',$ww->id)->get();
        $quantity = $ww->qty;
        if ($ww->weight > $quantity) {
            Cart::update($rowid, $quantity += 1);
            return back();
        } else {
            return back()->with('error', 'Kh??ng ????? s??? l?????ng trong kho!');
        }
    }

    function decreaseCart($rowid)
    {
        $ww = Cart::get($rowid);
        $quantity = $ww->qty;
        Cart::update($rowid, $quantity -= 1);
        return back();
    }

    public function cartRemove($id)
    {
        Cart::remove($id);
        return back();
    }

    public function addDiscount(Request $req)
    {
        $id = $req->input('txtDiscount');
        $discount = Discount::where('MaKM','=',$id)
                ->first();
        if ($discount === null){
            Cart::setGlobalDiscount(0);
            $req->session()->forget('discountCode');
            return back()->with('error','M?? gi???m gi?? kh??ng h???p l???');
        }
        if ($discount->TrangThai != 1){
            return back()->with('error','M?? gi???m gi?? kh??ng h???p l???');
        }
        if($discount->SoLuong <= 0){
            return back()->with('error','M?? gi???m gi?? n??y ???? ???????c d??ng h???t');
        }
        $endDate = strtotime(date('Y-m-d H:i:s', strtotime($discount->NgayKetThuc)));
        $startDate = strtotime(date('Y-m-d H:i:s',  strtotime($discount->NgayBatDau)));
        $currentDate = strtotime(date('Y-m-d H:i:s'));
        if($startDate > $currentDate) {
            return back()->with('error','M?? gi???m gi?? n??y ch??a c?? hi???u l???c, th??? l???i sau');
        }
        if($endDate < $currentDate) {
            return back()->with('error','M?? gi???m gi?? n??y ???? h???t h???n');
        }
        Cart::setGlobalDiscount($discount->GiamGia);
        session(['discountCode' => $id]);
        return back()->with('msg', 'S??? d???ng m?? gi???m gi?? th??nh c??ng');
    }

    public function checkout()
    {
        if (Cart::priceTotal() == 0) {
            return back()->with('warning', 'Kh??ng c?? s???n ph???m trong gi??? h??ng ????? thanh to??n');
        }
        return view('Home.checkout');
    }

    public function orderAdd(Request $req)
    {
        $checkpayment = $req->tab;
        if (Cart::priceTotal() == 0) {
            return back()->with('error', 'Kh??ng c?? s???n ph???m trong gi??? h??ng ????? thanh to??n');
        }
        $req->validate([
            'address' => 'required',
            'email' => ['required','email',Rule::in([Auth::guard('customer')->user()->email])],
            'phone_number' => ['required', 'regex:/^(([+]{0,1}\d{2})|\d?)[\s-]?[0-9]{2}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/'],
        ], [
            'address.required' => '?????a ch??? kh??ng ???????c ????? tr???ng',
            'email.required' => 'Email kh??ng ???????c ????? tr???ng',
            'email.email' => 'Email kh??ng h???p l???',
            'email.in' => 'Email kh??ng ????ng v???i t??i kho???n ??ang s??? d???ng',
            'phone_number.required' => "S??? ??i???n tho???i kh??ng ???????c ????? tr???ng",
            'phone_number.regex' => "S??? ??i???n tho???i kh??ng h???p l???",
        ]);
        if ($checkpayment == 'tructiep') {
            if(session('discountCode')){
                $discount = Discount::where('MaKM','=',session('discountCode'))->first();
                
                if ($discount->TrangThai != 1){
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? kh??ng h???p l???');
                }
                if($discount->SoLuong <= 0){
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? n??y ???? ???????c d??ng h???t');
                }
                $endDate = strtotime(date('Y-m-d H:i:s', strtotime($discount->NgayKetThuc)));
                $startDate = strtotime(date('Y-m-d H:i:s',  strtotime($discount->NgayBatDau)));
                $currentDate = strtotime(date('Y-m-d H:i:s'));
                if($startDate > $currentDate) {
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? n??y ch??a c?? hi???u l???c, th??? l???i sau');
                }
                if($endDate < $currentDate) {
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? n??y ???? h???t h???n');
                }
            }
            try {
                DB::beginTransaction();
                $order = new Order();
                $order->NgayDatHang =  Carbon::now();
                $order->DiaChi = $req->address;
                $order->SoDienThoai = $req->phone_number;
                $order->GhiChu = $req->order_note;
                $order->TrangThai = 0;
                $order->MaKM = session('discountCode');
                // $order->EmailKH = $req->email;
                $order->EmailKH = Auth::guard('customer')->user()->email;
                $order->save();
                foreach (Cart::content() as $c) {
                    $check = Quantity::where('MaDT', $c->id)
                        ->where('Mau', $c->options->color)
                        ->first();
                    if ($c->qty > $check->SoLuong) {
                        DB::rollBack();
                        if ($check->SoLuong == 0)
                            return redirect()->back()->with('error', 'S???n ph???m ' . $c->name . ' m??u ' . $c->options->color . ' ???? h???t h??ng');
                        else
                            return redirect()->back()->with('error', 'S???n ph???m ' . $c->name . ' m??u ' . $c->options->color . ' ch??? c??n ' . $check->SoLuong . ' s???n ph???m');
                    } else {
                        $od = new OrderDetail();
                        $od->SoHDB = $order->SoHDB;
                        $od->MaDT = $c->id;
                        $od->Mau = $c->options->color;
                        $od->SoLuong = $c->qty;
                        $od->DonGiaBan = $c->price;
                        $od->save();
                    }
                }
                DB::commit();
                //G???i mail x??c nh???n ????n h??ng
                $details = [
                    'title' => 'Chi ti???t ????n h??ng',
                    'body' => Cart::content(),
                    'discount' => Cart::discount(0),
                    'total' => Cart::subTotal(0),
                    'address' =>$req->address,
                    'note' => $req->order_note,
                    'date' => Carbon::now()
                ];
                Mail::to(Auth::guard('customer')->user()->email)->send(new \App\Mail\MyTestMail($details));
            } catch (\Throwable $th) {
                DB::rollBack();
                // throw $th;
                return redirect()->back()->with('error', '???? x???y ra l???i khi x??? l?? ????n h??ng n??y. Vui l??ng th??? l???i sau');
            }
            Cart::destroy();
            $req->session()->forget('discountCode');
            return redirect()->route('main-page')->with('msg', '?????t h??ng th??nh c??ng');
        }

        if ($checkpayment == 'stripe') {
            if(session('discountCode')){
                $discount = Discount::where('MaKM','=',session('discountCode'))->first();
                if ($discount->TrangThai != 1){
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? kh??ng h???p l???');
                }
                if($discount->SoLuong <= 0){
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? n??y ???? ???????c d??ng h???t');
                }
                $endDate = strtotime(date('Y-m-d H:i:s', strtotime($discount->NgayKetThuc)));
                $startDate = strtotime(date('Y-m-d H:i:s',  strtotime($discount->NgayBatDau)));
                $currentDate = strtotime(date('Y-m-d H:i:s'));
                if($startDate > $currentDate) {
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? n??y ch??a c?? hi???u l???c, th??? l???i sau');
                }
                if($endDate < $currentDate) {
                    Cart::setGlobalDiscount(0);
                    $req->session()->forget('discountCode');
                    return back()->with('error','M?? gi???m gi?? n??y ???? h???t h???n');
                }
            }
            if ($req->input('stripeToken')) {
                $token = $req->input('stripeToken');
                // $total = str_replace(',', '', Cart::priceTotal(0));
                $total = str_replace(',', '', Cart::subTotal(0));
                $response = $this->gateway->authorize([
                    'amount' => $total,
                    'currency' => env('STRIPE_CURRENCY'),
                    'description' => 'Chuy???n kho???n h??a ????n t??? Phone Store.',
                    'token' => $token,
                    'returnUrl' => $this->completePaymentUrl,
                    'confirm' => true,
                ])->send();

                if ($response->isSuccessful()) {
                    $response = $this->gateway->capture([
                        //'amount' => str_replace(',', '', Cart::priceTotal(0)),
                        'amount' => str_replace(',', '', Cart::subTotal(0)),
                        'currency' => env('STRIPE_CURRENCY'),
                        'paymentIntentReference' => $response->getPaymentIntentReference(),
                    ])->send();

                    $arr_payment_data = $response->getData();
                    $result = $this->store_payment([
                        'payer_ngaydathang' => Carbon::now(),
                        'payer_diachi' => $req->input('address'),
                        'payer_sdt' => $req->input('phone_number'),
                        'payer_ordernote' =>  $req->input('order_note'),
                        'payer_discount_code' =>  session('discountCode'),
                        'amount' => $arr_payment_data['amount'],
                        'payer_status' => 1,
                        'payer_email' =>  Auth::guard('customer')->user()->email,
                        'payment_id' => $arr_payment_data['id'],
                    ]);
                    if($result === 'success'){
                        Cart::destroy();
                        $req->session()->forget('discountCode');
                        return redirect()->route('main-page')->with('msg', '?????t h??ng th??nh c??ng');
                    }else{
                        return redirect()->back()->with('error', $result);
                    }
                } elseif ($response->isRedirect()) {
                    session(['payer_email' => $req->input('email')]);
                    session(['payer_ngaydathang' => Carbon::now()]);
                    session(['payer_diachi' => $req->input('address')]);
                    session(['payer_sdt' => $req->input('phone_number')]);
                    session(['payer_ghichu' => $req->input('order_note')]);
                    $response->redirect();
                } else {
                    return back()->with('error', '???? c?? l???i x???y ra!');
                }
            }
        }
    }

    public function confirm(Request $request)
    {
        $response = $this->gateway->confirm([
            'paymentIntentReference' => $request->input('payment_intent'),
            'returnUrl' => $this->completePaymentUrl,
        ])->send();

        if ($response->isSuccessful()) {
            $response = $this->gateway->capture([
                'amount' => str_replace(',', '', Cart::subTotal(0)),
                'currency' => env('STRIPE_CURRENCY'),
                'paymentIntentReference' => $request->input('payment_intent'),
            ])->send();

            $arr_payment_data = $response->getData();

            $this->store_payment([
                'payer_ngaydathang' => session('payer_ngaydathang'),
                'payer_diachi' => session('payer_diachi'),
                'payer_sdt' => session('payer_sdt'),
                'payer_ordernote' => session('order_note'),
                'amount' => $arr_payment_data['amount'],
                'payer_status' => 1,
                'payer_email' => session('payer_email'),
                'payer_tenkh' => session('payer_tenkh'),
                'payment_id' => $arr_payment_data['id'],
                // 'currency' => env('STRIPE_CURRENCY'),
            ]);

            Cart::destroy();
            return redirect()->route('main-page')->with('msg', '?????t h??ng th??nh c??ng');
        } else {
            return redirect()->route('main-page')->with('error', 'L???i r???i');
        }
    }

    public function store_payment($arr_data = [])
    {
        $isPaymentExist = Order::where('payment_id', $arr_data['payment_id'])->first();

        if (!$isPaymentExist) {
            try {
                DB::beginTransaction();
                $payment = new Order;
                $payment->NgayDatHang = $arr_data['payer_ngaydathang'];
                $payment->DiaChi = $arr_data['payer_diachi'];
                $payment->SoDienThoai = $arr_data['payer_sdt'];
                $payment->GhiChu = $arr_data['payer_ordernote'];
                // $payment->TongTien = $arr_data['amount'];
                // $payment->currency = env('STRIPE_CURRENCY');
                $payment->TrangThai = $arr_data['payer_status'];
                $payment->EmailKH = $arr_data['payer_email'];
                $payment->MaKM = $arr_data['payer_discount_code'];
                $payment->payment_id = $arr_data['payment_id'];
                $payment->save();

                foreach (Cart::content() as $c) {
                    $check = Quantity::where('MaDT', $c->id)
                        ->where('Mau', $c->options->color)
                        ->first();
                    if ($c->qty > $check->SoLuong) {
                        DB::rollBack();
                        if ($check->SoLuong == 0){
                            return 'S???n ph???m ' . $c->name . ' m??u ' . $c->options->color . ' ???? h???t h??ng';
                        }
                        else{
                            return 'S???n ph???m ' . $c->name . ' m??u ' . $c->options->color . ' ch??? c??n ' . $check->SoLuong . ' s???n ph???m';
                        }
                    } else {
                        $od = new OrderDetail();
                        $od->SoHDB = $payment->SoHDB;
                        $od->MaDT = $c->id;
                        $od->Mau = $c->options->color;
                        $od->SoLuong = $c->qty;
                        $od->DonGiaBan = $c->price;
                        $od->save();
                    }
                }
                DB::commit();
                $details = [
                    'title' => 'Chi ti???t ????n h??ng',
                    'body' => Cart::content(),
                    'total' => Cart::subTotal(0),
                    'discount' => Cart::discount(0),
                    'address' =>$arr_data['payer_diachi'],
                    'note' => $arr_data['payer_ordernote'],
                    'date' => $arr_data['payer_ngaydathang']
                ];
                Mail::to($arr_data['payer_email'])->send(new \App\Mail\MyTestMail($details));
                return 'success';
            } catch (\Throwable $th) {
                DB::rollBack();
                // throw $th;
                // return redirect()->back()->with('error', '???? x???y ra l???i khi x??? l?? ????n h??ng. Vui l??ng th??? l???i sau');
                return '???? x???y ra l???i khi x??? l?? ????n h??ng. Vui l??ng th??? l???i sau';
            }
        }
    }
}

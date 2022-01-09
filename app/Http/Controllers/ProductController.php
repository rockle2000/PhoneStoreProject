<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Product;
use App\Models\SoLuong;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\Quantity;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // 
    public function getAllProduct()
    {
        $product = Product::all();
        return view("Admin.product.listProduct", compact('product'));
    }

    public function add()
    {
        $supplier = Supplier::where('TrangThai', '1')->get();
        return view("Admin.product.addProduct", compact('supplier'));
    }

    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => ['required'],
                'image.*' => ['required','mimes:jpg,png,jpeg'],
                'txtMaDT' => ['required', 'unique:product,MaDT', 'max:10'],
                'txtTenDT' => ['required'],
                'txtGioiThieu' => ['required'],
                'txtThongSo' => ['required'],
                'ddlNhaSanXuat' => ['required','exists:supplier,MaNSX'],
                'ddlTrangThai' => ['required',Rule::in(['0', '1'])]
            ],
            [
                'image.required' => 'Bạn chưa thêm ảnh cho sản phẩm',
                'image.mimes' => 'Upload file không hợp lệ',
                'txtMaDT.unique' => 'Mã sản phẩm đã tồn tại',
                'txtMaDT.required' => 'Bạn chưa nhập mã sản phẩm',
                'txtMaDT.max' => 'Mã sản phẩm quá dài',
                'txtTenDT.required' => 'Bạn chưa nhập tên sản phẩm',
                'txtGioiThieu.required' => 'Bạn chưa nhập nội dung giới thiệu sản phẩm',
                'txtThongSo.required' => 'Bạn chưa nhập thông số cho sản phẩm',
                'ddlNhaSanXuat.required' => 'Nhà sản xuất không được để trống',
                'ddlNhaSanXuat.exists' => 'Nhà sản xuất không tồn tại',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        try {
            DB::beginTransaction();
            //Tạo sản phẩm
            $product = new Product();
            $product->MaDT  = $request->input('txtMaDT');
            $product->TenDT  = $request->input('txtTenDT');
            $product->GioiThieu = $request->input('txtGioiThieu');
            $product->ThongSo = $request->input('txtThongSo');
            $product->MaNSX  = $request->input('ddlNhaSanXuat');
            $product->TrangThai  = $request->input('ddlTrangThai');
            if (!$product->save()) {
                DB::rollBack();
                return redirect()->action([ProductController::class, 'getAllProduct'])->with('error', 'Lỗi khi thêm sản phẩm');
            }
            if ($request->hasFile('image')) {
                //Xử lý file ảnh
                foreach ($request->file('image') as $file) {
                    $ext = $file->getClientOriginalExtension();
                    $original_name = $file->getClientOriginalName();
                    $filename = time() . $original_name;
                    $file->move('public/backend/uploads/product-images/', $filename);
                    $image = new Image();
                    $image->MaDT = $request->input('txtMaDT');
                    $image->Anh = $filename;
                    if (!$image->save()) {
                        DB::rollBack();
                        return redirect()->action([ProductController::class, 'getAllProduct'])->with('error', 'Lỗi khi thêm file ảnh');
                    }
                }
            }
            DB::commit();
            return redirect()->action([ProductController::class, 'getAllProduct'])->with('status', 'Thêm mới sản phẩm thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->action([ProductController::class, 'getAllProduct'])->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $supplier = Supplier::where('TrangThai', '1')->get();
        if ($product === null || $id === "") {
            return view('errors.admin_404');
        }
        return view('Admin.product.editProduct', compact('product', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('MaDT', "=", $id)->first();
        if ($product === null || $id === "") {
            return view('errors.admin_404');
        }
        $this->validate(
            $request,
            [
                'txtTenDT' => ['required'],
                'txtGioiThieu' => ['required'],
                'txtThongSo' => ['required'],
                'ddlNhaSanXuat' => ['required','exists:supplier,MaNSX'],
                'ddlTrangThai' => ['required',Rule::in(['0', '1'])]
            ],
            [
                'txtTenDT.required' => 'Bạn chưa nhập tên sản phẩm',
                'txtGioiThieu.required' => 'Bạn chưa nhập nội dung giới thiệu sản phẩm',
                'txtThongSo.required' => 'Bạn chưa nhập thông số cho sản phẩm',
                'ddlNhaSanXuat.required' => 'Nhà sản xuất không được để trống',
                'ddlNhaSanXuat.exists' => 'Nhà sản xuất không tồn tại',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        if ($product->update([
            'TenDT'  => $request->input('txtTenDT'),
            'GioiThieu'  => $request->input('txtGioiThieu'),
            'ThongSo' => $request->input('txtThongSo'),
            'MaNSX'  => $request->input('ddlNhaSanXuat'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]))
            return redirect()->action([ProductController::class, 'getAllProduct'])->with('status', 'Sửa thông tin sản phẩm mã ' . $id . ' thành công');
        else
            return view('errors.admin_404');
    }
    public function destroy($id)
    {
        $product = Product::where('MaDT', "=", $id)->first();
        if ($product === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ]);
        } else {
            //Disable sản phẩm
            if ($product->TrangThai == 0) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Sản phẩm này đã được ẩn từ trước'
                ]);
            }
            if ($product->update(['TrangThai' => 0])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Ẩn thông tin sản phẩm thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ]);
            }
        }
    }
    public function active($id)
    {
        $product = Product::where('MaDT', "=", $id)->first();
        if ($product === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ]);
        } else {
            if ($product->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Sản phẩm đã được active từ trước'
                ]);
            }
            if ($product->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Active sản phẩm thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ]);
            }
        }
    }

    public function getNumberInstockByColor($madt, $color)
    {
        $quantity = Quantity::where('MaDT', $madt)
            ->where('Mau', $color)
            ->first();
        if ($quantity === null)
            return response()->json("Not found", 400);
        $product = Product::join('product_quantity', 'product_quantity.MaDT', '=', 'product.MaDT')
            ->where('product_quantity.MaDT', '=', $madt)
            ->where('product_quantity.Mau', '=', $color)
            ->select(
                'product_quantity.MaDT as MaDT',
                'product_quantity.Mau as Mau',
                'product_quantity.SoLuong as SoLuong',
                'product_quantity.DonGiaBan as DonGiaBan',
            )
            ->get();
        return response()->json($product, 200);
    }

    public function getProductDetail($id)
    {
        $product = Product::find($id);
        if ($product === null || $product->TrangThai == 0)
            return view("errors.home_404");
        $supplier = Supplier::find($product->MaNSX);
        if ( $supplier->TrangThai == 0)
            return view("errors.home_404");
        $feedback = Feedback::where('MaDT', '=', $id)
            ->orderBy('NgayTao', 'DESC')
            ->take(3)
            ->get();
        $other_product = Product::where('MaDT', '!=', $id)
            ->where('MaNSX', '=', $product->MaNSX)
            ->where('TrangThai',1)
            ->inRandomOrder()
            ->get();
        if (!$other_product->isEmpty()) {
            if ($other_product->count() >= 6)
                $other_product = $other_product->take(6);
            else
                $other_product = [];
            // else
            //     // $other_product = $other_product->random($other_product->count());
            //     $other_product = $other_product
        }
        return view('Home.single-product', compact('product', 'feedback', 'other_product'));
    }

    public function getProductDetailJSON($id)
    {
        $product = Product::find($id);
        if ($product === null || $product->TrangThai == 0) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Không tìm thấy sản phẩm'
            ], 404);
        } else {
            $product = Product::where('MaDT', $id)
                ->select(['MaDT', 'TenDT', 'DanhGia', 'MaNSX'])
                ->with('image')
                ->with('supplier:MaNSX,TenNSX')
                ->with('quantity')
                ->first();
            return response()->json([
                'status' => 'success',
                'message' => $product
            ], 200);
        }
    }

    public function productBySupplier($supplierId)
    {
        $supplier = Supplier::where('MaNSX', '=', $supplierId)->first();
        if ($supplier === null || $supplier->TrangThai == 0) {
            return view("errors.home_404");
        }
        $supplier_name = $supplier->TenNSX;
        $product = Product::where('MaNSX', '=', $supplierId)
            ->where('TrangThai', '=', 1);
        switch (request('sortBy')) {
            case 'name_asc':
                $product->orderby('TenDT', 'asc');
                break;
            case 'name_desc':
                $product->orderby('TenDT', 'desc');
                break;
            case 'price_asc':
                $product->withMax('quantity as maxprice', 'DonGiaBan')
                    ->orderBy('maxprice', 'asc');
                break;
            case 'price_desc':
                $product->withMax('quantity as maxprice', 'DonGiaBan')
                    ->orderBy('maxprice', 'desc');
                break;
            case 'rating':
                $product->orderby('DanhGia', 'desc');
                break;
            default:
                $product->orderby('MaDT', 'asc');
                break;
        }
        $product = $product->paginate(4);
        return view('Home.productBySupplier', compact('product', 'supplier_name'));
    }

    public function productQuantity($id)
    {
        $quantity = Quantity::where('MaDT', '=', $id)->get();
        if ($quantity === null) {
            return view('errors.admin_404');
        }
        return view('Admin.product.addProductQuantity', compact('quantity', 'id'));
    }
    public function insertQuantity(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'txtMau' => ['required'],
                'txtSoLuong' => ['required','numeric','gt:0'],
                'txtDonGiaNhap' => ['required','numeric','gt:0'],
                'txtDonGiaBan' => ['required','numeric','gt:0'],
            ],
            [
                'txtMau.required' => 'Bạn chưa nhập màu',
                'txtSoLuong.required' => 'Bạn chưa nhập số lượng ',
                'txtSoLuong.numeric' => 'Số lượng không hợp lệ ',
                'txtSoLuong.required' => 'Bạn chưa nhập số lượng ',
                'txtSoLuong.gt' => 'Số lương phải là số dương',

                'txtDonGiaNhap.required' => 'Bạn chưa nhập đơn giá nhập',
                'txtDonGiaNhap.numeric' => 'Đơn giá nhập không hợp lệ',
                'txtDonGiaNhap.gt' => 'Giá nhập phải là số dương',
                
                'txtDonGiaBan.required' => 'Bạn chưa nhập đơn giá bán',
                'txtDonGiaBan.numeric' => 'Đơn giá bán không hợp lệ',
                'txtDonGiaBan.gt' => 'Giá bán phải là số dương',
            ]
        );
        $color =  $request->input('txtMau');
        $check = Quantity::where('MaDT', '=', $id)
            ->where('Mau', '=', $color)
            ->first();
        if ($check === null) {
            $quantity = new Quantity();
            $quantity->MaDT = $id;
            $quantity->Mau = $request->input('txtMau');
            $quantity->SoLuong = $request->input('txtSoLuong');
            $quantity->DonGiaNhap = $request->input('txtDonGiaNhap');
            $quantity->DonGiaBan = $request->input('txtDonGiaBan');
            $quantity->save();
        } else {
            $old_quantity = $check->SoLuong;
            $new_quantity = $request->input('txtSoLuong');
            $sum = $old_quantity + $new_quantity;
            $check->update(['SoLuong' => $sum]);

            // Quantity::where('MaDT', '=', $id)
            //     ->where('Mau', '=', $color)
            //     ->update(['SoLuong' => $sum]);
        }
        return redirect()->action([ProductController::class, 'productQuantity'], $id)->with('msg',"Thêm mới dữ liệu thành công");
    }

    public function updateQuantity(Request $request)
    {
        $mau = $request->get("Mau");
        $madt = $request->get("MaDT");
        $dongianhap = $request->get("DonGiaNhap");
        $dongiaban = $request->get("DonGiaBan");
        $soluong = $request->get("SoLuong");

        if (is_numeric($dongianhap) && is_numeric($dongiaban) && is_numeric($soluong) && $dongiaban >0 && $dongianhap>0 && $soluong >0) {
            $quantity = Quantity::where('MaDT', '=', $madt)
                ->where('Mau', '=', $mau)
                ->first();
            if ($quantity === null)
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Not Found !!!'
                ],404);
            else {
                $quantity->update([
                    "SoLuong" => $soluong,
                    "DonGiaNhap" => $dongianhap,
                    "DonGiaBan" => $dongiaban
                ]);
            }
        } else {
            return response()->json([
                    'status' => 'failed',
                    'message' => 'Dữ liệu không hợp lệ'
                ],500);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Sửa thông thông tin thành công'
        ],200);
    }
    public function deleteQuantity($id, $color)
    {
        $quantity = Quantity::where('MaDT', '=', $id)
            ->where('Mau', '=', $color)
            ->first();
        if ($quantity === null || $id === "" || $color === "") {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not found !!!'
            ], 404);
        }
        if ($quantity->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa thông tin thành công'
            ], 200);
        }
    }

    public function feedback(Request $request)
    {
        $madt = $request->get('MaDT');
        $product = Product::where('MaDT', '=', $madt)->first();
        if ($product === null || $product->TrangThai == 0) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Không tìm thấy sản phầm này!'
            ], 404);
        }
        // $email = $request->get('EmailKH');
        $email = Auth::guard('customer')->user()->email;
        $danhgia = $request->get('DanhGia');
        $binhluan = $request->get('BinhLuan');

        $check_email = Customer::where('email', '=', $email)->where('status','=',1)->first();
        if (!$check_email)
            return response()->json([
                'status' => 'failed',
                'message' => 'Email chưa được đăng ký'
            ], 500);
        if($danhgia>5 || $danhgia<1 || !is_numeric($danhgia)){
            return response()->json([
                'status' => 'failed',
                'message' => 'Nội dung đánh giá không phù hợp'
            ], 500);
        }
        if (ctype_space($binhluan)){
            return response()->json([
                'status' => 'failed',
                'message' => 'Bạn chưa nhập đủ thông tin'
            ], 500);
        }
        $feedback = new Feedback();
        $feedback->MaDT = $madt;
        $feedback->EmailKH = $email;
        $feedback->DanhGia = $danhgia;
        $feedback->BinhLuan = $binhluan;
        $feedback->NgayTao = now();
        if ($feedback->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Đánh giá sản phẩm thành công'
            ], 200);
        } else
            return response()->json([
                'status' => 'failed',
                'message' => 'Có lỗi khi thực hiện thao tác'
            ], 500);
    }
}

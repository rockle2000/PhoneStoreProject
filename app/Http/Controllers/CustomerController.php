<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;

class CustomerController extends Controller
{
    // public function guard()
    // {
    //     return Auth::guard('customer');
    // }
    // home-page

    function info($id) {
        $customer =  Customer::whereId($id)->first();
        if($customer == null || $id == '')
            return view("errors.home_404");
        return view('Home.infocustomer',compact('customer'));
    }

    function changepass($id) {
        $customer =  Customer::whereId($id)->first();
        if($customer == null || $id == '')
            return view("errors.home_404");
        return view('Home.changepass',compact('customer'));
    }

    public function orderByUser()
    {
        $id = Auth::guard('customer')->user()->id;
        $customer = Customer::find($id);
        if($customer == null || $id == '')
            return view("errors.home_404");
        $list_order = Order::where('EmailKH',$customer->email)->orderBy('NgayDatHang','DESC')->paginate(6);
        return view('Home.orderByUser',compact('list_order'));
    }

    function updatepassword(Request $request,$id) {
        $request->validate([
            'oldpass' => 'required',
            'password' => ['required',
               'min:6',
               'max:30',
               'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
               'different:oldpass'
            ],
            'cpassword' => 'required|same:password'
        ],
        [
            'oldpass.required' => 'Chưa nhập mật khẩu cũ',
            'password.required' => 'Chưa nhập mật khẩu mới',
            'password.different' => 'Mật khẩu mới không được trùng với mật khẩu cũ',
            'password.min' => 'Mật khẩu tối thiểu 6 kí tự',
            'password.max' => 'Mật khẩu không vượt quá 30 kí tự',
            'password.regex' => 'Mật khẩu nên gồm 1 chữ cái hoa, 1 kí tự đặc biệt',
            'cpassword.same' => 'Xác nhận mật khẩu mới không khớp',
            'cpassword.required' => 'Chưa nhập lại mật khẩu',
        ]
    );

        $customer = Customer::findOrFail($id);
        if (Hash::check($request->oldpass, $customer->password)) {
           $customer->fill([
            'password' => Hash::make($request->password)
            ])->save();

        //    $request->session()->flash('msg', 'Đổi mật khẩu thành công');
            // return redirect()->route('user.signout')->with('msg', 'Đổi mật khẩu thành công');
            return redirect()->back()->with('msg', 'Đổi mật khẩu thành công');
        } else {
            // $request->session()->flash('fail', 'Mật khẩu cũ không khớp');
            // return redirect()->route('user.changepass',['id' => $id]);
            return redirect()->back()->with('error', 'Mật khẩu cũ không khớp');
        }
    }

    function register(Request $request)
    {
        //Validate Inputs
        $request->validate([
            'name' => 'required',
            'email' => ['required','email','unique:customers,email'],
            'phone_number' => ['required', 'regex:/^(([+]{0,1}\d{2})|\d?)[\s-]?[0-9]{2}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/'],
           
            'password' => ['required',
               'min:8',
               'max:30',
               'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/'
            ],
            'cpassword' => 'required|same:password'
        ],
        [
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được sử dụng',
            'phone_number.required' => "Số điện thoại không được để trống",
            'phone_number.regex' => "Số điện thoại không hợp lệ",
            // 'phone_number.max' => "Số điện thoại không vượt quá 11 số",
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu tối thiểu 8 kí tự',
            'password.max' => 'Mật khẩu không vượt quá 30 kí tự',
            'password.regex' => 'Mật khẩu nên gồm 1 chữ cái hoa, 1 kí tự đặc biệt',
            'cpassword.required' => 'Chưa nhập lại mật khẩu',
            'cpassword.same' => 'Xác nhận mật khẩu mới không khớp',
            
        ]);
        $user = new Customer();
        $user->name = $request->name;
        $user->phone = $request->phone_number;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect()->back()->with('success', 'Đăng ký thành công');
        } else {
            return redirect()->back()->with('error', 'Đăng ký thất bại');
        }
    }

    function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.required' => 'Email không được để trống',
            'email.exists' => 'Email này chưa được đăng ký!',
            'email.email' =>'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        $creds = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($creds)) {
            // return redirect()->route('main-page');
            // return redirect()->action([HomeController::class, 'index']);
            return redirect()->intended('main-page');
        } else {
            return redirect()->route('user.login')->with('error', 'Thông tin đăng nhập không chính xác!');
        }
    }

    function logout()
    {
        Auth::guard('customer')->logout();
        Cart::destroy();
        return redirect()->route('user.login');
    }

    //admin
    public function index()
    {
        $customers = Customer::all();
        return view('Admin.customers.listCustomer', compact('customers'));
    }

    public function create()
    {
        return view('Admin.customers.addCustomer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/'],
            'password' => ['required',
            'min:6',
            'max:30',
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
            'cpassword' => 'required|min:5|max:30|same:password'
        ]);

        try {
            DB::beginTransaction();
            // Logic For Save User Data

            $create_user = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make('password')
            ]);

            if (!$create_user) {
                DB::rollBack();

                return back()->with('error', 'Có vấn đề trong lúc lưu dữ liệu');
            }

            DB::commit();
            return redirect()->route('customers.index')->with('status', 'Customer Stored Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function edit($id)
    {
        $customer =  Customer::whereId($id)->first();

        // if (!$customer) {
        //     return back()->with('error', 'Customer Not Found');
        // }
        if($customer == null || $id == '')
            return view("errors.admin_404");

        return view('Admin.customers.editCustomer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => ['required', 'regex:/^(([+]{0,1}\d{2})|\d?)[\s-]?[0-9]{2}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/'],
        ],[
            'name.required' => 'Tên không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' =>'Số điện thoại không hợp lệ',
            // 'phone.max' =>'Số điện thoại không vượt quá 11 kí tự'
        ]
        );

        try {
            DB::beginTransaction();
            $update_user = Customer::where('id', $id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
            // if (!$update_user) {
            //     DB::rollBack();

            //     return back()->with('error', 'Something went wrong while update user data');
            // }

            DB::commit();
            if($request->hiddeninput) {
                return redirect()->route('main-page')->with('msg', 'Cập nhật thông tin thành công');
            }
            return redirect()->route('customers.index')->with('status', 'Cập nhật thông tin thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->with('error','Đã có lỗi xảy ra');
        }
    }

    // public function destroy($id)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $delete_user = Customer::whereId($id)->delete();

    //         if (!$delete_user) {
    //             DB::rollBack();
    //             return back()->with('error', 'There is an error while deleting user.');
    //         }

    //         DB::commit();
    //         return redirect()->route('customers.index')->with('status', 'User Deleted successfully.');
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         throw $th;
    //     }
    // }

    public function updateStatus($customer_id, $status_code)
    {
        try {
            $update_customer = Customer::whereId($customer_id)->update([
                'status' => $status_code
            ]);

            if ($update_customer) {
                return redirect()->route('customers.index')->with('status', 'Cập nhật trạng thái thành công');
            }

            return redirect()->route('customers.index')->with('error', 'Cập nhật trạng thái thất bại');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

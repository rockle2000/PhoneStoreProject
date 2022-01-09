<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    //
    public function getAllSupplier(Request $request)
    {

        $suppliers = Supplier::all();
        return view('Admin.supplier.listSupplier', compact('suppliers'));
    }
    public function add()
    {
        return view('Admin.supplier.addSupplier');
    }

    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'txtMaNSX' => ['required', 'unique:supplier,MaNSX', 'max:10'],
                'txtTenNSX' => ['required', 'unique:supplier,TenNSX', 'max:50'],
                'txtDiaChi' => ['required', 'max:150'],
                // 'txtSDT' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/','max:11'],
                'txtSDT' => ['required', 'regex:/^(([+]{0,1}\d{2})|\d?)[\s-]?[0-9]{2}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/'],
                'txtEmail' => ['required', 'email:rfc,dns'],
                'ddlTrangThai' => ['required',Rule::in(['0', '1'])]
            ],
            [
                'txtMaNSX.required' => 'Mã nhà sản xuất không được để trống',
                'txtMaNSX.unique' => 'Mã nhà sản xuất đã tồn tại',
                'txtMaNSX.max' => 'Mã nhà sản không được vượt quá 10 kí tự',
                'txtTenNSX.required' => 'Tên nhà sản xuất không được để trống',
                'txtTenNSX.unique' => 'Tên nhà sản xuất đã tồn tại',
                'txtTenNSX.max' => 'Tên nhà sản xuất không được vượt quá 50 kí tự',
                'txtDiaChi.required' => 'Địa chỉ không được để trống',
                'txtDiaChi.max' => 'Địa chỉ không được vượt quá 150 kí tự',
                'txtSDT.required' => 'Số điện thoại không được để trống',
                // 'txtSDT.max' => "Số điện thoại quá dài",
                'txtSDT.regex' => "Số điện thoại không hợp lệ",
                'txtEmail.required' => 'Email không được để trống',
                'txtEmail.email' => 'Email không hợp lệ',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        $supplier = new Supplier();
        $supplier->MaNSX  = $request->input('txtMaNSX');
        $supplier->TenNSX  = $request->input('txtTenNSX');
        $supplier->DiaChi  = $request->input('txtDiaChi');
        $supplier->SoDienThoai  = $request->input('txtSDT');
        $supplier->Email  = $request->input('txtEmail');
        $supplier->TrangThai  = $request->input('ddlTrangThai');
        if (!$supplier->save()) {
            return redirect()->action([SupplierController::class, 'getAllSupplier'])->with('error', 'Lỗi khi thêm mới nhà sản xuất');
        } else {
            return redirect()->action([SupplierController::class, 'getAllSupplier'])->with('status', 'Thêm mới nhà sản xuất thành công');
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::where('MaNSX', "=", $id)->first();
        if ($supplier === null || $id === "") {
            return view('errors.admin_404');
        }
        return view('Admin.supplier.editSupplier', compact('supplier'));
    }
    public function update(Request $request, $id)
    {
        $supplier = Supplier::where('MaNSX', "=", $id)->first();
        if ($supplier === null || $id === "") {
            return view('errors.admin_404');
        }
        $this->validate(
            $request,
            [
                'txtTenNSX' => ['required', 'unique:supplier,TenNSX,'.$supplier->TenNSX.',TenNSX', 'max:50'],
                'txtDiaChi' => ['required', 'max:150'],
                // 'txtSDT' => ['required', 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/','max:11'],
                'txtSDT' => ['required', 'regex:/^(([+]{0,1}\d{2})|\d?)[\s-]?[0-9]{2}[\s-]?[0-9]{3}[\s-]?[0-9]{4}$/'],
                'txtEmail' => ['required', 'email:rfc,dns'],
                'ddlTrangThai' => ['required',Rule::in(['0', '1'])]
            ],
            [
                'txtTenNSX.required' => 'Tên nhà sản xuất không được để trống',
                'txtTenNSX.unique' => 'Tên nhà sản xuất đã tồn tại',
                'txtTenNSX.max' => 'Tên nhà sản xuất không được vượt quá 50 kí tự',
                'txtDiaChi.required' => 'Địa chỉ không được để trống',
                'txtDiaChi.max' => 'Địa chỉ không được vượt quá 150 kí tự',
                'txtSDT.required' => 'Số điện thoại không được để trống',
                // 'txtSDT.max' => "Số điện thoại quá dài",
                'txtSDT.regex' => "Số điện thoại không hợp lệ",
                'txtEmail.required' => 'Email không được để trống',
                'txtEmail.email' => 'Email không hợp lệ',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        if ($supplier->update([
            'TenNSX'  => $request->input('txtTenNSX'),
            'DiaChi'  => $request->input('txtDiaChi'),
            'SoDienThoai' => $request->input('txtSDT'),
            'Email'  => $request->input('txtEmail'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]))
            return redirect()->action([SupplierController::class, 'getAllSupplier'])->with('status', 'Sửa thông tin nhà sản xuất mã ' . $id . ' thành công');
        else
            return view('errors.admin_404');
    }

    public function destroy($id)
    {
        $supplier = Supplier::where('MaNSX', "=", $id)->first();
        if ($supplier === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ]);
        } else {
            //Disable nhà sản xuất
            if ($supplier->TrangThai == 0) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Nhà sản xuất đã được ẩn từ trước'
                ]);
            }
            if ($supplier->update(['TrangThai' => 0])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Xóa thông tin nhà sản xuất thành công!'
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
        $supplier = Supplier::where('MaNSX', "=", $id)->first();
        if ($supplier === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ]);
        } else {
            if ($supplier->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Nhà sản xuất đã được active từ trước'
                ]);
            }
            if ($supplier->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Active nhà sản xuất thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ]);
            }
        }
    }
}

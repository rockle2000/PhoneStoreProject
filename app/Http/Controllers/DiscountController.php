<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    //
    public function getAllDiscountCode()
    {
        $discount = Discount::all();
        return view("Admin.discount.listDiscountCode",compact('discount'));
    }

    public function add()
    {
        return view("Admin.discount.addDiscountCode");
    }
    
    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'txtMaKM' => ['required', 'unique:discount_code,MaKM'],
                'txtTenKM' => ['required'],
                'txtNoiDung' => ['required'],
                'ddlGiamGia' => ['required',Rule::in(['5','10','15','20','25','30'])],
                'txtNgayBatDau' => ['required','date','after_or_equal:now'],
                'txtNgayKetThuc' => ['required','date','after:txtNgayBatDau'],
                'txtSoLuong' => ['required','numeric'],
                'ddlTrangThai' => ['required',Rule::in(['0', '1'])]
            ],
            [
                'txtMaKM.unique' => 'Mã khuyến mãi đã tồn tại',
                'txtMaKM.required' => 'Bạn chưa nhập mã khuyến mãi',
                'txtTenKM.required' => 'Bạn chưa nhập tên khuyến mãi',
                'txtNoiDung.required' => 'Bạn chưa nhập nội dung cho mã khuyến mãi này',
                'ddlGiamGia.required' => 'Bạn chưa chọn mức giảm giá',
                'ddlGiamGia.in' => 'Mức giảm giá không hợp lệ',
                'txtNgayBatDau.required' => 'Bạn chưa nhập ngày bắt đầu',
                'txtNgayBatDau.date' => 'Ngày bắt đầu không đúng định dạng',
                'txtNgayBatDau.after_or_equal' => 'Ngày bắt đầu không hợp lệ',
                'txtNgayKetThuc.required' => 'Bạn chưa nhập ngày kết thúc',
                'txtNgayKetThuc.date' => 'Ngày kết thúc không đúng định dạng',
                'txtNgayKetThuc.after' => 'Ngày kết thúc không hợp lệ',
                'txtThongSo.required' => 'Bạn chưa nhập thông số cho sản phẩm',
                'txtSoLuong.required' => 'Bạn chưa nhập số lượng',
                'txtSoLuong.numeric' => 'Số lượng không hợp lệ',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        try {
            //Tạo sản phẩm
            $discount = new Discount();
            $discount->MaKM  = $request->input('txtMaKM');
            $discount->TenKM  = $request->input('txtTenKM');
            $discount->NoiDung = $request->input('txtNoiDung');
            $discount->GiamGia = $request->input('ddlGiamGia');
            $discount->NgayBatDau  = $request->input('txtNgayBatDau');
            $discount->NgayKetThuc  = $request->input('txtNgayKetThuc');
            $discount->SoLuong = $request->input('txtSoLuong');
            $discount->TrangThai  = $request->input('ddlTrangThai');
            if (!$discount->save()) {
                return redirect()->action([DiscountController::class, 'getAllDiscountCode'])->with('error', 'Lỗi khi thêm mã khuyến mãi mới');
            }
            return redirect()->action([DiscountController::class, 'getAllDiscountCode'])->with('status', 'Thêm mới mã khuyến mãi thành công');
        } catch (\Throwable $th) {
            throw $th;
            // return redirect()->action([DiscountController::class, 'getAllDiscountCode'])->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function edit($id)
    {
        if ($id === "") {
            return view('errors.admin_404');
        }
        $discount = Discount::find($id);
        if ($discount === "") {
            return view('errors.admin_404');
        }
        return view("Admin.discount.editDiscountCode",compact('discount'));
    }

    public function update(Request $request,$id)
    {
        $discount = Discount::where('MaKM', "=", $id)->first();
        if ( $id === "" || $discount === null) {
            return view('errors.admin_404');
        }
        $this->validate(
            $request,
            [
                'txtTenKM' => ['required'],
                'txtNoiDung' => ['required'],
                'ddlGiamGia' => ['required',Rule::in(['5','10','15','20','25','30'])],
                'txtNgayBatDau' => ['required','date','after_or_equal:now'],
                'txtNgayKetThuc' => ['required','date','after:txtNgayBatDau'],
                'txtSoLuong' => ['required','numeric'],
                'ddlTrangThai' => ['required',Rule::in(['0', '1'])]
            ],
            [
                'txtTenKM.required' => 'Bạn chưa nhập tên khuyến mãi',
                'txtNoiDung.required' => 'Bạn chưa nhập nội dung cho mã khuyến mãi này',
                'ddlGiamGia.required' => 'Bạn chưa chọn mức giảm giá',
                'ddlGiamGia.in' => 'Mức giảm giá không hợp lệ',
                'txtNgayBatDau.required' => 'Bạn chưa nhập ngày bắt đầu',
                'txtNgayBatDau.date' => 'Ngày bắt đầu không đúng định dạng',
                'txtNgayBatDau.after_or_equal' => 'Ngày bắt đầu không hợp lệ',
                'txtNgayKetThuc.required' => 'Bạn chưa nhập ngày kết thúc',
                'txtNgayKetThuc.date' => 'Ngày kết thúc không đúng định dạng',
                'txtNgayKetThuc.after' => 'Ngày kết thúc không hợp lệ',
                'txtSoLuong.required' => 'Bạn chưa nhập số lượng',
                'txtSoLuong.numeric' => 'Số lượng không hợp lệ',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        if ($discount->update([
            'TenKM'  => $request->input('txtTenKM'),
            'NoiDung'  => $request->input('txtNoiDung'),
            'GiamGia'  => $request->input('ddlGiamGia'),
            'NgayBatDau' => $request->input('txtNgayBatDau'),
            'NgayKetThuc' => $request->input('txtNgayKetThuc'),
            'SoLuong' => $request->input('txtSoLuong'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]))
            return redirect()->action([DiscountController::class, 'getAllDiscountCode'])->with('status', 'Sửa mã khuyến mãi ' . $id . ' thành công');
        else
            return view('errors.admin_404');
    }
    public function active($id)
    {
        $discount = Discount::where('MaKM', "=", $id)->first();
        if ($discount === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ]);
        } else {
            if ($discount->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Mã giảm giá vẫn đang kích hoạt'
                ]);
            }
            if ($discount->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Kích hoạt mã giảm giá thành công!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ]);
            }
        }
    }
    public function destroy($id)
    {
        $discount = Discount::where('MaKM', "=", $id)->first();
        if ($discount === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Không tìm thấy mã giảm giá'
            ]);
        } else {
            if ($discount->TrangThai == 0) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Mã giảm giá này đã bị vô hiệu từ trước'
                ]);
            }
            if ($discount->update(['TrangThai' => 0])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vô hiệu mã giảm giá thành công!'
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

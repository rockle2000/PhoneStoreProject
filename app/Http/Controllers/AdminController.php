<?php

namespace App\Http\Controllers;

use App\Models\SlideImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        return view("Admin.dashboard");
    }

    public function getAllBanner()
    {
        $banner = SlideImage::all();
        return view('Admin.slide.listBanner', compact('banner'));
    }

    public function addBannerImage()
    {
        return view('Admin.slide.addBanner');
    }
    public function insertBannerImage(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => ['required','mimes:jpg,png,jpeg'],
                'ddlType' => ['required',Rule::in(['Slide Main Page', 'Top Banner','Mid Banner','Bottom Banner'])]
            ],
            [
                'image.required' => 'Bạn chưa thêm ảnh',
                'image.mimes' => 'Ảnh không hợp lệ',
                'ddlType.required' => 'Loại banner không được để trống',
                'ddlType.in' => 'Loại banner không hợp lệ',
            ]
        );
        $file = $request->file('image');
        $original_name = $file->getClientOriginalName();
        $filename = time() . $original_name;
        $file->move('public/backend/uploads/banners/', $filename);
        $image = new SlideImage();
        $image->NoiDung = $request->input('txtNoiDung');
        $image->Type = $request->input('ddlType');
        $image->Anh = $filename;
        if (!$image->save()) {
            return redirect()->action([AdminController::class, 'getAllBanner'])->with('error', 'Lỗi khi thêm mới banner');
        }
        return redirect()->action([AdminController::class, 'getAllBanner'])->with('status', 'Thêm mới banner thành công');
    }
    public function deleteBanner($id)
    {
        if ($id === '')
            return view('errors.admin_404');
        $banner = SlideImage::find($id);
        if ($banner === null)
            return view('errors.admin_404');
        if ($banner->Anh) {
            $path = 'public/backend/uploads/banners/' . $banner->Anh;
            if (File::exists($path)) {
                File::delete($path);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'File ảnh không tồn tại'
                ], 500);
            }
        }
        if (!$banner->delete())
            return response()->json([
                'status' => 'failed',
                'message' => 'Xóa banner thất bại'
            ], 500);
        else
            return response()->json([
                'status' => 'success',
                'message' => 'Xóa banner thành công'
            ], 200);
    }
}

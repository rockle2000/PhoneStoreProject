<?php

namespace App\Http\Controllers;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsCategoryController extends Controller
{
    //
    public function getAllNewsCategory()
    {
        $categories = NewsCategory::all();
        return view("Admin.news.listNewsCategory",compact('categories'));
    }
    public function add()
    {
        return view("Admin.news.addNewsCategory");
    }

    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'txtTheLoai' => ['required', 'unique:newscategory,TheLoai'],
                'ddlTrangThai' => ['required', Rule::in(['0', '1'])]
            ],
            [
                'txtTheLoai.required' => 'Bạn chưa nhập tên thể loại tin tức',
                'txtTheLoai.unique' => 'Thể loại tin tức này đã tồn tại',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        // //Tạo thể loại mới
        try {
            $category = new NewsCategory();
            $category->TheLoai = $request->input('txtTheLoai');
            $category->TrangThai  = $request->input('ddlTrangThai');
            if (!$category->save()) {
                return redirect()->action([NewsCategoryController::class, 'getAllNewsCategory'])->with('error', 'Lỗi khi thêm thể loại tin tức mới');
            }
            return redirect()->action([NewsCategoryController::class, 'getAllNewsCategory'])->with('status', 'Thêm thể loại tin tức mới thành công');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->action([NewsCategoryController::class, 'getAllNewsCategory'])->with('error', 'Đã xảy ra lỗi');
        }
    }
    public function edit($id)
    {
        $newscate = NewsCategory::find($id);
        if ($newscate === null || $id === "") {
            return view('errors.admin_404');
        }
        return view('Admin.news.editNewsCategory', compact('newscate'));
    }

    public function update(Request $request, $id)
    {
        $newscate = NewsCategory::where('MaTheLoai', "=", $id)->first();
        if ($newscate === null || $id === "") {
            return view('errors.admin_404');
        }
        $this->validate(
            $request,
            [
                'txtTheLoai' => ['required'],
                'ddlTrangThai' => ['required', Rule::in(['0', '1'])]
            ],
            [
                'txtTheLoai.required' => 'Bạn chưa nhập tên thể loại tin tức',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        if ($newscate->update([
            'TheLoai'  => $request->input('txtTheLoai'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]))
            return redirect()->action([NewsCategoryController::class, 'getAllNewsCategory'])->with('status', 'Sửa thể loại tin tức thành công');
        else
            return view('errors.admin_404');
    }
    public function active($id)
    {
        $newscate = NewsCategory::where('MaTheLoai', "=", $id)->first();
        if ($newscate === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Không tìm thấy thể loại tin tức'
            ]);
        } else {
            if ($newscate->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Thể loại tin tức đã được active từ trước'
                ]);
            }
            if ($newscate->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Active thể loại tin tức thành công!'
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
        $newscate = NewsCategory::where('MaTheLoai', "=", $id)->first();
        if ($newscate === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Không tìm thấy thể loại tin tức'
            ]);
        } else {
            if ($newscate->TrangThai == 0) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Thể loại tin tức này đã được ẩn từ trước'
                ]);
            }
            if ($newscate->update(['TrangThai' => 0])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Ẩn thể loại tin tức thành công!'
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

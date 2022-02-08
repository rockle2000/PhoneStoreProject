<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    //Home News
    public function getAllNews()
    {
        $newscategories = NewsCategory::where('TrangThai','=','1')->get();
        $news = News::where('TrangThai','=','1')->get();
        return view("Home.news.listNews",compact('news','newscategories'));
    }
    public function add()
    {
        // $blog = Blog::where('TrangThai', '1')->get();
        $newscategories = NewsCategory::where('TrangThai','=','1')->get();
        return view("Admin.news.addNews",compact('newscategories'));
    }

    public function insert(Request $request)
    {
        $this->validate(
            $request,
            [
                'image' => ['required', 'mimes:jpg,png,jpeg'],
                // 'image.*' => ['required','mimes:jpg,png,jpeg'],
                'txtTieuDe' => ['required', 'unique:product,MaDT'],
                'txtTacGia' => ['required'],
                'txtNoiDung' => ['required'],
                'ddlTrangThai' => ['required', Rule::in(['0', '1'])]
            ],
            [
                'image.required' => 'Bạn chưa thêm ảnh cho tin tức này',
                'image.mimes' => 'Upload file không hợp lệ',
                'txtTieuDe.required' => 'Bạn chưa nhập tiêu đề cho bài viết',
                'txtTacGia.required' => 'Bạn chưa nhập tên tác giả',
                'txtNoiDung.required' => 'Bạn chưa nhập nội dung tin tức này',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        //Tạo tin tức mới
        $news = new News();
        $news->TieuDe  = $request->input('txtTieuDe');
        $news->TacGia  = $request->input('txtTacGia');
        $news->NoiDung = $request->input('txtNoiDung');
        $news->TrangThai  = $request->input('ddlTrangThai');
        $file = $request->file('image');
        $original_name = $file->getClientOriginalName();
        $filename = time() . $original_name;
        $file->move('public/backend/uploads/news-images/', $filename);
        $news->Anh = $filename;
        if (!$news->save()) {
            return redirect()->action([ProductController::class, 'getAllProduct'])->with('error', 'Lỗi khi thêm tin tức');
        }
        return redirect()->action([ProductController::class, 'getAllProduct'])->with('status', 'Thêm tin tức mới thành công');
    }

    public function edit($id)
    {
        $news = News::find($id);
        $newscategories = NewsCategory::where('TrangThai','=','1')->get();
        if ($news === null || $id === "") {
            return view('errors.admin_404');
        }
        return view('Admin.news.editNews', compact('news', 'newscategories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::where('Id', "=", $id)->first();
        if ($news === null || $id === "") {
            return view('errors.admin_404');
        }
        $this->validate(
            $request,
            [
                // 'image' => ['required', 'mimes:jpg,png,jpeg'],
                // 'image.*' => ['required','mimes:jpg,png,jpeg'],
                'txtTieuDe' => ['required', 'unique:product,MaDT'],
                'txtTacGia' => ['required'],
                'txtNoiDung' => ['required'],
                'ddlTrangThai' => ['required', Rule::in(['0', '1'])]
            ],
            [
                // 'image.required' => 'Bạn chưa thêm ảnh cho tin tức này',
                // 'image.mimes' => 'Upload file không hợp lệ',
                'txtMaDT.unique' => 'Mã sản phẩm đã tồn tại',
                'txtTieuDe.required' => 'Bạn chưa nhập tiêu đề cho bài viết',
                'txtTacGia.required' => 'Bạn chưa nhập tên tác giả',
                'txtNoiDung.required' => 'Bạn chưa nhập nội dung tin tức này',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        if ($news->update([
            'TieuDe'  => $request->input('txtTieuDe'),
            'TacGia'  => $request->input('txtTacGia'),
            'NoiDung' => $request->input('txtNoiDung'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]))
            return redirect()->action([ProductController::class, 'getAllProduct'])->with('status', 'Sửa tin tức mã ' . $id . ' thành công');
        else
            return view('errors.admin_404');
    }

    public function newsDetail($id)
    {
        $newscategories = NewsCategory::where('TrangThai','=','1')->get();
        $news = News::find($id);
        return view("Home.news.newsDetail",compact('news','newscategories'));
    }
}

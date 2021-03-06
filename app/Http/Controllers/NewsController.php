<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\News;
use App\Models\News_NewsCategory;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    //Home News
    public function getAllNews(Request $request)
    {
        $newscategories = NewsCategory::where('TrangThai', '=', '1')->get();
        $news = News::where('TrangThai', '=', '1')->orderBy("MaTinTuc","DESC");
        $recent_news = News::where('TrangThai', '=', '1')->orderBy("MaTinTuc","DESC")->limit(3)->get();

        if ($request->exists('category')){
            $cateid = $request->get('category');
            $category = NewsCategory::find($cateid);
            if (!is_numeric($cateid) || $category === null)
                return view('errors.home_404');
            $news_id = DB::select("SELECT DISTINCT(news_id) FROM `news_newscategory` where newscategory_id = :id",["id"=>$cateid]);
            $ids_news = json_decode(json_encode($news_id), true);
            $news = News::where('TrangThai', '=', '1')->orderBy("MaTinTuc","DESC")->whereIn('MaTinTuc',$ids_news);
        }
        $news = $news->paginate(2);
        return view("Home.news.listNews", compact('news', 'newscategories','recent_news'));
    }
    //Admin News
    public function getAllNewsAdmin()
    {
        $newscategories = NewsCategory::where('TrangThai', '=', '1')->get();
        $news = News::get();
        return view("Admin.news.listNews", compact('news', 'newscategories'));
    }
    public function add()
    {
        // $blog = Blog::where('TrangThai', '1')->get();
        $newscategories = NewsCategory::where('TrangThai', '=', '1')->get();
        return view("Admin.news.addNews", compact('newscategories'));
    }

    public function insert(Request $request)
    {
        
        $this->validate(
            $request,
            [
                'image' => ['required', 'mimes:jpg,png,jpeg'],
                'txtTieuDe' => ['required', 'unique:news,TieuDe'],
                'txtTacGia' => ['required'],
                'txtNoiDung' => ['required'],
                'ddlTrangThai' => ['required', Rule::in(['0', '1'])]
            ],
            [
                'image.required' => 'Bạn chưa thêm ảnh cho tin tức này',
                'image.mimes' => 'Upload file không hợp lệ',
                'txtTieuDe.required' => 'Bạn chưa nhập tiêu đề cho bài viết',
                'txtTieuDe.unique' => 'Bài viết với tiêu đề này đã tồn tại',
                'txtTacGia.required' => 'Bạn chưa nhập tên tác giả',
                'txtNoiDung.required' => 'Bạn chưa nhập nội dung tin tức này',
                'ddlTrangThai.required' => 'Trạng thái không được để trống',
                'ddlTrangThai.in' => 'Trạng thái không hợp lệ',
            ]
        );
        // //Tạo tin tức mới
        try {
            DB::beginTransaction();
            $news = new News();
            $news->TieuDe  = $request->input('txtTieuDe');
            $news->TacGia  = $request->input('txtTacGia');
            $news->NoiDung = $request->input('txtNoiDung');
            $news->TrangThai  = $request->input('ddlTrangThai');
            $news->NgayTao = date('Y-m-d H:i:s');
            $file = $request->file('image');
            $original_name = $file->getClientOriginalName();
            $filename = time() . $original_name;
            $file->move('public/backend/uploads/news-images/', $filename);
            $news->Anh = $filename;
            if (!$news->save()) {
                DB::rollBack();
                return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('error', 'Lỗi khi thêm tin tức');
            }
            $category = $request->input('ddlDanhMuc');
            foreach ($category as $cate) {
                $news_cate = new News_NewsCategory();
                $news_cate->news_id = $news->MaTinTuc;
                $news_cate->newscategory_id = $cate;
                if (!$news_cate->save()) {
                    DB::rollBack();
                    return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('error', 'Lỗi khi xử lí danh mục');
                }
            }
            DB::commit();
            return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('status', 'Thêm tin tức mới thành công');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('error', 'Đã xảy ra lỗi');
        }
    }

    public function edit($id)
    {
        $news = News::find($id);
        $newscategories = NewsCategory::where('TrangThai', '=', '1')->get();
        if ($news === null || $id === "") {
            return view('errors.admin_404');
        }
        return view('Admin.news.editNews', compact('news', 'newscategories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::where('MaTinTuc', "=", $id)->first();
        if ($news === null || $id === "") {
            return view('errors.admin_404');
        }
        $this->validate(
            $request,
            [
                // 'image' => ['required', 'mimes:jpg,png,jpeg'],
                // 'image.*' => ['required','mimes:jpg,png,jpeg'],
                'txtTieuDe' => ['required'],
                'txtTacGia' => ['required'],
                'txtNoiDung' => ['required'],
                'ddlTrangThai' => ['required', Rule::in(['0', '1'])]
            ],
            [
                // 'image.required' => 'Bạn chưa thêm ảnh cho tin tức này',
                // 'image.mimes' => 'Upload file không hợp lệ',
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
            return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('status', 'Sửa tin tức mã ' . $id . ' thành công');
        else
            return view('errors.admin_404');
    }

    public function newsDetail($id)
    {
        $newscategories = NewsCategory::where('TrangThai', '=', '1')->get();
        $news = News::find($id);
        $recent_news = News::where('TrangThai', '=', '1')->orderBy("MaTinTuc","DESC")->limit(3)->get();
        if ($news == null || !$news->TrangThai) {
            return view("errors.home_404");
        }
        return view("Home.news.newsDetail", compact('news', 'newscategories','recent_news'));
    }

    public function active($id)
    {
        $news = News::where('MaTinTuc', "=", $id)->first();
        if ($news === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Không tìm thấy bài viết'
            ]);
        } else {
            if ($news->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Bài viết đã được active từ trước'
                ]);
            }
            if ($news->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Active bài viết thành công!'
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
        $news = News::where('MaTinTuc', "=", $id)->first();
        if ($news === null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Không tìm thấy bài viết'
            ]);
        } else {
            //Disable sản phẩm
            if ($news->TrangThai == 0) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'Bài viết này đã được ẩn từ trước'
                ]);
            }
            if ($news->update(['TrangThai' => 0])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Ẩn bài viết thành công!'
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

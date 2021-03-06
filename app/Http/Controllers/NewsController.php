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
                'image.required' => 'B???n ch??a th??m ???nh cho tin t???c n??y',
                'image.mimes' => 'Upload file kh??ng h???p l???',
                'txtTieuDe.required' => 'B???n ch??a nh???p ti??u ????? cho b??i vi???t',
                'txtTieuDe.unique' => 'B??i vi???t v???i ti??u ????? n??y ???? t???n t???i',
                'txtTacGia.required' => 'B???n ch??a nh???p t??n t??c gi???',
                'txtNoiDung.required' => 'B???n ch??a nh???p n???i dung tin t???c n??y',
                'ddlTrangThai.required' => 'Tr???ng th??i kh??ng ???????c ????? tr???ng',
                'ddlTrangThai.in' => 'Tr???ng th??i kh??ng h???p l???',
            ]
        );
        // //T???o tin t???c m???i
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
                return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('error', 'L???i khi th??m tin t???c');
            }
            $category = $request->input('ddlDanhMuc');
            foreach ($category as $cate) {
                $news_cate = new News_NewsCategory();
                $news_cate->news_id = $news->MaTinTuc;
                $news_cate->newscategory_id = $cate;
                if (!$news_cate->save()) {
                    DB::rollBack();
                    return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('error', 'L???i khi x??? l?? danh m???c');
                }
            }
            DB::commit();
            return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('status', 'Th??m tin t???c m???i th??nh c??ng');
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('error', '???? x???y ra l???i');
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
                // 'image.required' => 'B???n ch??a th??m ???nh cho tin t???c n??y',
                // 'image.mimes' => 'Upload file kh??ng h???p l???',
                'txtTieuDe.required' => 'B???n ch??a nh???p ti??u ????? cho b??i vi???t',
                'txtTacGia.required' => 'B???n ch??a nh???p t??n t??c gi???',
                'txtNoiDung.required' => 'B???n ch??a nh???p n???i dung tin t???c n??y',
                'ddlTrangThai.required' => 'Tr???ng th??i kh??ng ???????c ????? tr???ng',
                'ddlTrangThai.in' => 'Tr???ng th??i kh??ng h???p l???',
            ]
        );
        if ($news->update([
            'TieuDe'  => $request->input('txtTieuDe'),
            'TacGia'  => $request->input('txtTacGia'),
            'NoiDung' => $request->input('txtNoiDung'),
            'TrangThai' => $request->input('ddlTrangThai')
        ]))
            return redirect()->action([NewsController::class, 'getAllNewsAdmin'])->with('status', 'S???a tin t???c m?? ' . $id . ' th??nh c??ng');
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
                'message' => 'Kh??ng t??m th???y b??i vi???t'
            ]);
        } else {
            if ($news->TrangThai == 1) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'B??i vi???t ???? ???????c active t??? tr?????c'
                ]);
            }
            if ($news->update(['TrangThai' => 1])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Active b??i vi???t th??nh c??ng!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'L???i khi th???c hi???n thao t??c'
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
                'message' => 'Kh??ng t??m th???y b??i vi???t'
            ]);
        } else {
            //Disable s???n ph???m
            if ($news->TrangThai == 0) {
                return response()->json([
                    'status' => 'disabled',
                    'message' => 'B??i vi???t n??y ???? ???????c ???n t??? tr?????c'
                ]);
            }
            if ($news->update(['TrangThai' => 0])) {
                return response()->json([
                    'status' => 'success',
                    'message' => '???n b??i vi???t th??nh c??ng!'
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'L???i khi th???c hi???n thao t??c'
                ]);
            }
        }
    }
}

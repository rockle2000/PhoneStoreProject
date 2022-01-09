<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SlideImage;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    function searchProduct(Request $req)
    {
        $keyWord = $req->keyword;
        $product = Product::where('TenDT', 'like', "%$keyWord%")
            ->where('TrangThai', '1');
        $result_found = $product->count();
        $product = $product->paginate(5);
        return view('Home.search_product', compact('keyWord', 'product','result_found'));
    }
    public function index()
    {
        // $listProduct = Product::all()->where('TrangThai', '=', 1);
        $id_bestSeller = DB::select(
            'SELECT product.MaDT FROM `order`,orderdetail,product,supplier 
            WHERE `order`.SoHDB = orderdetail.SoHDB AND orderdetail.MaDT = product.MaDT AND product.MaNSX = supplier.MaNSX 
            AND product.TrangThai = 1 AND supplier.TrangThai = 1
            GROUP BY product.MaDT
            ORDER BY SUM(orderdetail.SoLuong) DESC
            LIMIT 6'
        );
        $id_bestSeller = json_decode(json_encode($id_bestSeller), true);
        $bestSeller = Product::whereIn('MaDT', $id_bestSeller)->get();

        // $id_supplier = DB::select(
        //     'select supplier.MaNSX from supplier,product
        //     WHERE supplier.MaNSX = product.MaNSX
        //     GROUP BY supplier.MaNSX
        //     HAVING COUNT(MaDT) > 1'
        // );
        $id_supplier = Supplier::join('product', 'product.MaNSX', '=', 'supplier.MaNSX')
            ->where('product.TrangThai', '=', 1)
            ->select('supplier.MaNSX')
            ->groupBy('supplier.MaNSX')
            ->having(DB::raw('count(MaDT)'), '>=', 6)
            ->inRandomOrder()
            ->limit(2)
            ->get();

        $first_list = [];
        $second_list = [];
        for ($i = 0; $i < count($id_supplier); $i++) {
            if ($i == 0) {
                $first_list = Product::where('MaNSX', '=', $id_supplier[$i]->MaNSX)->where('TrangThai', '=', 1)->inRandomOrder()->limit(6)->get();
            } else {
                $second_list = Product::where('MaNSX', '=', $id_supplier[$i]->MaNSX)->where('TrangThai', '=', 1)->inRandomOrder()->limit(6)->get();
            }
        }
        $slide = SlideImage::where('Type', 'Slide Main Page')->limit(2)->get();
        $top_banner = SlideImage::where('Type', 'Top Banner')->limit(2)->get();
        $mid_banner = SlideImage::where('Type', 'Mid Banner')->limit(3)->get();
        $bottom_banner = SlideImage::where('Type', 'Bottom Banner')->inRandomOrder()->limit(1)->first();
        return view("Home.home", compact('bestSeller', 'first_list', 'second_list', 'slide', 'top_banner', 'mid_banner', 'bottom_banner'));
        // print_r(count($listProduct));
    }

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('guest:customer');
    }

    public function contact()
    {
        return view('Home.contact');
    }

    public function about()
    {
        return view('Home.about');
    }

    // public function __construct()
    // {
    //     // $this->middleware('auth');
    //     $this->middleware('guest:customer');
    // }
}

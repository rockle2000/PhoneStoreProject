<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //
    public function index()
    {
        return view('Admin.charts.chart');
    }

    public function revenueByYear($year)
    {
        if (is_numeric($year)) {
            $data = DB::select('CALL DoanhThuTheoNam(?)', array($year));
            return response()->json($data, 200);
        }
    }

    public function productSellBySupplier($year)
    {
        if (is_numeric($year)) {
            $data = DB::select('CALL ThongKeTheoNSX(?)', array($year));
            return response()->json($data, 200);
        }
    }
}

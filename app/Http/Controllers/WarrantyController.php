<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarrantyController extends Controller
{
    //
    public function getAllWarranty()
    {
        $order = Order::where("TrangThai", "=", 1)->orderBy("SoHDB","DESC")->get();
        return view("Admin.warranty.listWarranty", compact('order'));
    }

    public function warrantyDetail($orderId)
    {
        if (!is_numeric($orderId))
            return view('errors.admin_404');
        $order = Order::find($orderId);
        if ($order == null) {
            return view('errors.admin_404');
        }
        $order_detail = DB::select(
            "SELECT `order`.SoHDB,product.MaDT,TenDT,Mau,SoLuong,DonGiaBan,product.BaoHanh as ThoiGianBaoHanh, orderdetail.BaoHanh 
            FROM `orderdetail`,`order`,product where `order`.SoHDB = orderdetail.SoHDB and product.MaDT = orderdetail.MaDT
            and `order`.SoHDB = :orderid",
            ['orderid' => $orderId]
        );

        return view("Admin.warranty.detail", compact('order_detail', 'order'));
    }

    public function updateWarranty(Request $request)
    {
        $sohdb = $request->get("SoHDB");
        $madt = $request->get("MaDT");
        $mau = $request->get("Mau");
        $baohanh = $request->get("BaoHanh");
        $detail = OrderDetail::where('SoHDB', '=', $sohdb)
            ->where("MaDT", '=', $madt)
            ->where('Mau', '=', $mau)
            ->first();
        if ($detail === null)
            return response()->json([
                'status' => 'failed',
                'message' => 'Not Found !!!'
            ], 404);
        else {
            if ($detail->update(['BaoHanh' => $baohanh])) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Cập nhật thông tin bảo hành thành công!'
                ],200);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Lỗi khi thực hiện thao tác'
                ],500);
            }
        }
    }
}

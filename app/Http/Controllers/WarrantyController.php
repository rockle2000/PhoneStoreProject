<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarrantyController extends Controller
{
    //
    public function getAllWarranty()
    {
        $order = Order::where("TrangThai","=",1)->get();
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
            and `order`.SoHDB = :orderid",['orderid'=>$orderId]);      
            
        return view("Admin.warranty.detail",compact('order_detail','order'));
    }
}

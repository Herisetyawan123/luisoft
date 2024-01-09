<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use PDF;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', '=', 5)
            ->orderBy('updated_at', 'DESC')
            ->get();
        return view('admin.reports.index', ["orders" => $orders]);
    }

    public function stocks()
    {
        $products = Product::select('products.id', 'products.name', 'products.quantity', 'products.price', DB::raw('SUM(order_details.product_quantity) as total_sold'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', '5')
            ->groupBy('products.id', 'products.name', 'products.quantity', 'products.price')
            ->get();

        return view('admin.reports.stocks', ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePdf()
    {
        $orders = Order::where('status', '=', 5)
            ->orderBy('updated_at', 'DESC')
            ->get();
        $pdf = PDF::loadView('admin.reports.pdf.order-pdf', compact('orders'));

        $fileName = 'report_' . uniqid() . '.pdf'; // Nama file acak
        return $pdf->download($fileName);
    }

    public function generatePdfStock()
    {
        $products = Product::select('products.id', 'products.name', 'products.quantity', 'products.price', DB::raw('SUM(order_details.product_quantity) as total_sold'))
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', '5')
            ->groupBy('products.id', 'products.name', 'products.quantity', 'products.price')
            ->get();

        $pdf = PDF::loadView('admin.reports.pdf.stock-pdf', compact('products'));

        $fileName = 'report_' . uniqid() . '.pdf'; // Nama file acak
        return $pdf->download($fileName);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller {
    public function index() {
        $orders = Order::orderByDesc('created_at')->get();
        return view('admin.order.index')->with([
            'orders' => $orders
        ]);
    }

    public function detail($id) {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::with('product')->where('order_id', $id)->get();
        return view('admin.order.detail')->with([
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }

    public function handle($id, Request $request) {
        $data = $request->all();
        $order = Order::findOrFail($id);
        $order->update($data);

        return redirect()->back()->with([
            'message' => 'xử lí thành công'
        ]);

    }
}

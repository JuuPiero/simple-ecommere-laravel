<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller {

    public function index() {
        $users = User::all();
        $products = Product::all();
        $categories = Category::all();
        $orders = Order::where('status', 0)->get();
        return view('admin.index')->with([
            'users' => $users,
            'products' => $products,
            'categories' => $categories,
            'orders' => $orders
        ]);
    }

    public function login() {
        return view('admin.login');
    }

    public function checkLogin(Request $request) {
        $credentials  = $request->only('email', 'password');
        $remember = !empty($request->only('remember'));

        if(Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect(route('admin'));
        }
        
        return back()->withErrors([
            'error' => 'Thông tin đăng nhập không hợp lệ.',
        ]);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    public function user() {
        $users = User::with('orders')->get();
        return view('admin.user.index')->with([
            'users' =>$users
        ]);
    }

    public function statistical(Request $request) {
        $revenues = Order::selectRaw('DATE(created_at) as day, SUM(total_amount) as sum_amount')
        ->where('status', 1) 
        ->groupByRaw('DATE(created_at)') 
        ->orderByDesc('day') 
        ->get();
        
        $ordersByStatus = DB::table('orders')
        ->select('status', DB::raw('COUNT(*) as total_order'))
        ->groupBy('status')
        ->get();

        $ordersByUser = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id') // Nối bảng orders và users
        ->select(
            'users.email as email', 
            DB::raw('COUNT(orders.id) as total_order'), // Đếm số lượng đơn hàng
            DB::raw('SUM(orders.total_amount) as total_amount') // Tính tổng tiền
        )
        ->groupBy('users.id', 'users.email') // Nhóm theo user_id và tên user
        ->get();

        return view('admin.statistical.index')->with([
            // 'users' =>$users
            'revenues' => $revenues,
            'ordersByStatus' => $ordersByStatus,
            'ordersByUser' =>  $ordersByUser
        ]);
    }

    public function export() {
        return Excel::download(new OrdersExport(), 'orders_report.xlsx');
    }
}

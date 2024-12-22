<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersByUserSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Lấy dữ liệu người dùng và số lượng đơn hàng
        $ordersByUser = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select(
            'users.email as email',
            DB::raw('COUNT(orders.id) as total_order'),
            DB::raw('SUM(orders.total_amount) as total_amount')
        )
        ->groupBy('users.id', 'users.email')
        ->get();

        return $ordersByUser->map(function ($item, $index) {
            // // Thêm cột STT
            $item->stt = $index + 1;

            return [
                'stt' => $item->stt,       
                'email' => $item->email,   
                'total_order' => $item->total_order, 
                'total_amount' => $item->total_amount,
            ];
        });
    }

    public function headings(): array
    {
        return ['STT', 'Email', 'SL', 'Tổng'];
    }
}

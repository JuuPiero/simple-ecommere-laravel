<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RevenuesSheet implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        // Lấy dữ liệu tổng thu nhập theo ngày
        $revenues = Order::selectRaw('DATE(created_at) as day, SUM(total_amount) as sum_amount')
            ->where('status', 1)
            ->groupByRaw('DATE(created_at)')
            ->orderByDesc('day')
            ->get();

        return $revenues->map(function ($item, $index) {
            $item->stt = $index + 1;

            return [
                'stt' => $item->stt,        
                'day' => $item->day,     
                'sum_amount' => $item->sum_amount, 
            ];
        });
    }

    public function headings(): array
    {
        return ['STT', 'Day', 'Total Revenue'];
    }
}

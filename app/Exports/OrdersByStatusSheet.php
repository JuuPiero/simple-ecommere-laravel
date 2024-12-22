<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersByStatusSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Lấy dữ liệu số lượng đơn theo trạng thái
        $ordersByStatus = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as total_order'))
            ->groupBy('status')
            ->get();

        $statusLabels = [
            0 => 'PENDIND',
            1 => 'COMPLETED',
            2 => 'CANCEL',
        ];

        return $ordersByStatus->map(function ($item, $index) use ($statusLabels) {
            $item->stt = $index + 1;

            $item->status = $statusLabels[$item->status] ?? 'Không xác định';

            return [
                'stt' => $item->stt,       
                'status' => $item->status, 
                'total_order' => $item->total_order, 
            ];
        });
    }

    public function headings(): array
    {
        return ['STT', 'Status', 'Order(s)'];
    }
}

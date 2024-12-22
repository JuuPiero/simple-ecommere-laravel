<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class OrdersExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [
            new RevenuesSheet(),
            new OrdersByStatusSheet(),
            new OrdersByUserSheet(),
        ];

        return $sheets;
    }
}

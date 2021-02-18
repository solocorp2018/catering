<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */   
    public function map($order): array
    {	
    	return [
            $order->order_unique_id,            
            Date::dateTimeToExcel($order->order_date),
            'NULL',
            'NULL',
            'NULL',
            'NULL',
            'NULL',
        ];    	  
    }

    public function headings(): array
    {
        return [
            '#',
            'OrderId',
            'OrderDate',
            'Item',
            'Quantity',
            'Unit Price',
            'Quantity Price',            
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\User as Customer;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromQuery, WithMapping
{    
    /**
    * @var Invoice $invoice
    */
    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,
            $customer->contact_number,
            Date::dateTimeToExcel($customer->created_at),
        ];
    }
}

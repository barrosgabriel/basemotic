<?php
/**
 * Created by PhpStorm.
 * User: eduardo.dgi
 * Date: 20/07/2018
 * Time: 11:18
 */

namespace App\Exports;

use App\Audit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Audit::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'user_type',
            'user_id',
            'event',
            'auditable_id',
            'auditable_type',
            'old_values',
            'new_values',
            'url',
            'ip_address',
            'user_agent',
            'tags',
            'created_at',
            'updated_at',
        ];
    }
}
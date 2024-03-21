<?php
namespace App\Exports;

use App\Models\Stok;
use Maatwebsite\Excel\Concerns\FromCollection;

class StokExport implements FromCollection
{
    public function collection()
    {
        return Stok::all();
    }
}


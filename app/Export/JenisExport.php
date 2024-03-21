<?php
namespace App\Exports;

use App\Models\Jenis;
use Maatwebsite\Excel\Concerns\FromCollection;

class JenisExport implements FromCollection
{
    public function collection()
    {
        return Jenis::all();
    }
}


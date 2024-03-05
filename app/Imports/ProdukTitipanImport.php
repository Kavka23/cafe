<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProdukTitipanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Logika untuk menangani data dari file Excel
        foreach ($collection as $row) {
            // Proses penyimpanan atau manipulasi data di sini
        }
    }
}

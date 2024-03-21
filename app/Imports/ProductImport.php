<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'nama_produk' => $row['nama_produk'],
            'harga' => $row['harga'],
            'jenis_id' => $row['jenis_id'],
            'deskripsi' => $row['deskripsi'],
        ]);
    }
}

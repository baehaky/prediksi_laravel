<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'nama_barang'   => $row['nama_barang'],
            'modal'       => $row['modal'],
            'diskon'      => $row['diskon'],
            'harga_kelas' => $row['harga_kelas'],
            'sumber_data'   => 'train',
        ]);

    }
}

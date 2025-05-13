<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
    'nama_barang', 'modal', 'diskon', 'harga_kelas', 'sumber_data', 'prediksi', 
    ];

}

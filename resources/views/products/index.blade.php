@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Daftar Produk yang Sudah Diprediksi</h2>

    <table class="min-w-full table-auto border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Nama Barang</th>
                <th class="px-4 py-2">Modal</th>
                <th class="px-4 py-2">Diskon</th>
                <th class="px-4 py-2">Harga Kelas</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($products as $product)
                <tr>
                    <td class="px-4 py-2 text-center">{{ $product->nama_barang }}</td>
                    <td class="px-4 py-2 text-center">{{ $product->modal }}</td>
                    <td class="px-4 py-2 text-center">{{ $product->diskon }}</td>
                    <td class="px-4 py-2 font-semibold text-center text-blue-600">{{ strtoupper($product->harga_kelas) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

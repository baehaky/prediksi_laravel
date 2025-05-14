@extends('layouts.app')

@section('title', 'Prediksi Harga')

@section('content')
<div class="shadow-md bg-white rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Form Prediksi Harga Barang</h2>
        
        <form method="POST" action="{{ route('predict') }}" class="space-y-4">
            @csrf
            <input type="text" name="nama_barang" placeholder="Nama Barang" required class="w-full border-gray-300 rounded-lg p-2.5 shadow-sm">
            <input type="number" name="modal" step="0.01" placeholder="Modal" required class="w-full border-gray-300 rounded-lg p-2.5 shadow-sm">
            <input type="number" name="diskon" step="0.01" placeholder="Diskon" required class="w-full border-gray-300 p-2.5 rounded-lg shadow-sm">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Prediksi</button>
        </form>
    
    @if (isset($hasil))
    <div class="p-6">
        <hr class="m-5 border-t border-gray-300">
        <h3 class="text-lg font-semibold  mb-2">Hasil Prediksi</h3>
        <table class="table-auto w-full bg-gray-300/20 rounded-md overflow-hidden">
            <tbody class="divide-y divide-gray-200">
                <tr><td class="p-2 font-medium">Nama Barang</td><td class="p-2">{{ $input['nama_barang'] ?? '' }}</td></tr>
                <tr><td class="p-2 font-medium">Modal</td><td class="p-2">{{ $input['modal'] }}</td></tr>
                <tr><td class="p-2 font-medium">Diskon</td><td class="p-2">{{ $input['diskon'] }}</td></tr>
                <tr><td class="p-2 font-bold text-blue-700">Prediksi Harga</td><td class="p-2 font-bold text-blue-700">{{ strtoupper($hasil) }}</td></tr>
            </tbody>
        </table>
    </div>
    @endif

    @if ($errors->has('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first('error') }}
        </div>
    @endif

</div>

@endsection

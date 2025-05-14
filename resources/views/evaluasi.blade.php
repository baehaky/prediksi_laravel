@extends('layouts.app')

@section('title', 'Prediksi Harga')

@section('content')
<section class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-10">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-3xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">
            Evaluasi Model Naive Bayes
        </h1>

        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">
                Confusion Matrix
            </h2>
            <div class="overflow-x-auto">
                <table class="table-auto border-collapse w-full text-center">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="border px-4 py-2">Actual \ Predicted</th>
                            <th class="border px-4 py-2">Murah</th>
                            <th class="border px-4 py-2">Mahal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="border px-4 py-2 bg-gray-100">Murah</th>
                            <td class="border px-4 py-2 {{ $confusion['Murah']['Murah'] > 0 ? 'bg-green-100' : 'bg-red-100' }}">
                                {{ $confusion['Murah']['Murah'] }}
                            </td>
                            <td class="border px-4 py-2 {{ $confusion['Murah']['Mahal'] > 0 ? 'bg-red-100' : 'bg-green-100' }}">
                                {{ $confusion['Murah']['Mahal'] }}
                            </td>
                        </tr>
                        <tr>
                            <th class="border px-4 py-2 bg-gray-100">Mahal</th>
                            <td class="border px-4 py-2 {{ $confusion['Mahal']['Murah'] > 0 ? 'bg-red-100' : 'bg-green-100' }}">
                                {{ $confusion['Mahal']['Murah'] }}
                            </td>
                            <td class="border px-4 py-2 {{ $confusion['Mahal']['Mahal'] > 0 ? 'bg-green-100' : 'bg-red-100' }}">
                                {{ $confusion['Mahal']['Mahal'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">
                Akurasi Model
            </h2>
            <p class="text-3xl font-bold text-indigo-600">
                {{ $accuracy }}%
            </p>
        </div>
    </div>
</section>
@endsection
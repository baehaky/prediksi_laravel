<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\NaiveBayesService;

class PredictController extends Controller
{
    public function form()
    {
        return view('predict');
    }

    public function predict(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'modal' => 'required|numeric',
            'diskon' => 'required|numeric',
        ]);

        try {
            $service = new NaiveBayesService();
            $result = $service->predict(
                $request->modal,
                $request->diskon,
            );

            Product::create([
                'nama_barang'   => $request->nama_barang,
                'modal'         => $request->modal,
                'diskon'        => $request->diskon,
                'harga_kelas'   => $result,
                'sumber_data'   => 'test',
            ]);



            return view('predict', [
                'hasil' => $result,
                'input' => $request->only(['nama_barang','modal', 'diskon',]),
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}

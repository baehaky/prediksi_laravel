<?php

namespace App\Services;

use Phpml\Classification\NaiveBayes;
use Phpml\ModelManager;
use App\Models\Product;

class NaiveBayesService
{
    public function trainModel()
    {
        $products = Product::where('sumber_data', '!=', 'test')->get();
        $samples = [];
        $labels = [];

        foreach ($products as $product) {
            if (in_array($product->harga_kelas, ['Murah', 'Mahal'])) {
                $samples[] = [(float) $product->modal, (float) $product->diskon];
                $labels[] = $product->harga_kelas;
            }
        }

        // Debugging: Pastikan samples dan labels terisi
        if (empty($samples) || empty($labels)) {
            dd("Tidak ada data valid untuk training", $samples, $labels);
        }

        $classifier = new NaiveBayes();
        $classifier->train($samples, $labels);

        $modelManager = new ModelManager();
        $modelManager->saveToFile($classifier, storage_path('app/naive_bayes_model.yml'));
    }


    public function predict($modal, $diskon)
    {
        $path = storage_path('app/naive_bayes_model.yml');

        if (!file_exists($path)) {
            throw new \Exception("Model belum dilatih. Jalankan trainModel() terlebih dahulu.");
        }

        $modelManager = new ModelManager();
        $classifier = $modelManager->restoreFromFile($path);

        // Pastikan data input sesuai dengan yang digunakan saat training
        $sample = [(float)$modal, (float)$diskon];

        return $classifier->predict($sample);
    }

}

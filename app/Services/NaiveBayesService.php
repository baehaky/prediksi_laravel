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

    public function evaluateModel()
    {
        $path = storage_path('app/naive_bayes_model.yml');

        if (!file_exists($path)) {
            throw new \Exception("Model belum dilatih. Jalankan trainModel() terlebih dahulu.");
        }

        $modelManager = new ModelManager();
        $classifier = $modelManager->restoreFromFile($path);

        $testProducts = Product::where('sumber_data', 'test')->get();

        $trueLabels = [];
        $predictedLabels = [];

        foreach ($testProducts as $product) {
            if (in_array($product->harga_kelas, ['Murah', 'Mahal'])) {
                $sample = [(float) $product->modal, (float) $product->diskon];
                $trueLabels[] = $product->harga_kelas;
                $predicted = $classifier->predict($sample);
                $predictedLabels[] = $predicted;

                // Simpan hasil prediksi ke database
                $product->prediksi = $predicted;
                $product->save();
            }
        }

        // Hitung Confusion Matrix
        $confusion = [
            'Murah' => ['Murah' => 0, 'Mahal' => 0],
            'Mahal' => ['Murah' => 0, 'Mahal' => 0],
        ];

        $correct = 0;
        $total = count($trueLabels);

        for ($i = 0; $i < $total; $i++) {
            $actual = $trueLabels[$i];
            $predicted = $predictedLabels[$i];

            $confusion[$actual][$predicted]++;

            if ($actual === $predicted) {
                $correct++;
            }
        }

        $accuracy = $total > 0 ? $correct / $total : 0;

        return [
            'confusion_matrix' => $confusion,
            'accuracy' => round($accuracy * 100, 2)
        ];
    }
}

# 🧠 Prediksi Harga Barang Menggunakan Naive Bayes – Laravel

Sebuah aplikasi berbasis Laravel untuk memprediksi kelas harga barang (`Murah` atau `Mahal`) berdasarkan nilai `modal` dan `diskon` menggunakan algoritma **Naive Bayes**.

## 🚀 Fitur

- Import data dari file Excel (`DataSparePart.xlsx`)
- Klasifikasi harga barang menggunakan Naive Bayes
- Prediksi data baru secara real-time
- Evaluasi model dengan **confusion matrix** dan **akurasi**
- UI responsif menggunakan **Tailwind CSS**

---

## 🛠️ Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/baehaky/prediksi_laravel.git
cd prediksi_laravel
```

### 2. Install Dependency
```bash
composer install
npm install
npm run dev
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` dan sesuaikan database:

```env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & Seed Data
```bash
php artisan migrate
php artisan db:seed --class=ProductsSeeder
```

Pastikan file `DataSparePart.xlsx` berada di folder `storage/app/`.

---

## 🤖 Training Model

Model Naive Bayes hanya menggunakan data dengan `sumber_data = train`.

Jalankan perintah:

```bash
php artisan tinker
>>> (new \App\Services\NaiveBayesService)->trainModel();
```

Model akan disimpan di:  
```
storage/app/naive_bayes_model.yml
```

---

## 📊 Evaluasi Model

Jalankan route evaluasi untuk melihat confusion matrix dan akurasi:

```
GET /evaluasi
```

Atau buka di browser:  
`http://localhost:8000/evaluasi`

Route ini akan:
- Memuat data `sumber_data = test`
- Melakukan prediksi
- Menampilkan confusion matrix & akurasi

---

## 🔮 Prediksi Barang

Kunjungi halaman:

```
GET /predict
```

Masukkan:
- Nama barang
- Modal
- Diskon

Hasil prediksi akan disimpan ke database dengan `sumber_data = test`.

---

## 🧩 Struktur Penting

```text
├── app/
│   ├── Services/
│   │   └── NaiveBayesService.php  # Logika training & prediksi
│   ├── Models/
│   │   └── Product.php            # Model data barang
│   └── Http/
│       └── Controllers/
│           └── PredictController.php
├── resources/views/
│   ├── predict.blade.php          # Form prediksi
│   ├── evaluasi.blade.php         # Tampilan evaluasi
│   └── layouts/app.blade.php      # Template dengan navbar
├── database/
│   ├── migrations/
│   │   └── create_products_table.php
│   ├── seeders/
│   │   └── ProductsSeeder.php
│   └── imports/
│       └── ProductsImport.php
```

---

## 🧪 Tools Digunakan

- Laravel
- Phpml (Machine Learning PHP)
- Tailwind CSS
- Laravel Excel (Maatwebsite)
- Tinker

---

## 📄 Lisensi

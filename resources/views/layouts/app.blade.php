<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Prediksi Harga')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->

<nav class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <a href="{{ route('predict.form') }}" class="text-gray-800 text-lg font-semibold flex items-center px-3 hover:text-blue-600">Predict</a>
                <a href="{{ route('product.index') }}" class="text-gray-800 text-lg font-semibold 
            </div>
        </div>
    </div>
</nav>


    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4">
        @yield('content')
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg min-h-screen">
        <div class="p-6 text-xl font-bold border-b">UMKM APP</div>
        <nav class="mt-6">
            <a href="/products" class="block py-2.5 px-4 hover:bg-gray-200">Perhitungan HPP</a>
            <a href="/order-history" class="block py-2.5 px-4 hover:bg-gray-200">Riwayat Order</a>
            <a href="/sales" class="block py-2.5 px-4 hover:bg-gray-200">Target Penjualan</a>
            <form action="/logout" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full text-left py-2.5 px-4 hover:bg-gray-200 text-red-600">Logout</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>
</html>

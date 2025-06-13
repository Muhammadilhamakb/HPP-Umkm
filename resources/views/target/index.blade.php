<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Target Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex flex-col items-center p-6">

    <h1 class="text-2xl font-bold mb-6">Target Penjualan</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full max-w-md space-y-6">

        <!-- Form Target Keuntungan -->
        <form action="{{ route('target.storeTarget') }}" method="POST" class="bg-white text-black p-4 rounded-lg shadow space-y-4">
            @csrf
            <h2 class="font-semibold">Target Keuntungan Penjualan</h2>
            <input type="number" name="target_profit" placeholder="Masukan Target Keuntungan Penjualan Hari ini" class="w-full border p-2 rounded" required>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>

        <!-- Form Keuntungan Hari Ini -->
        <form action="{{ route('target.storeProfit') }}" method="POST" class="bg-white text-black p-4 rounded-lg shadow space-y-4">
            @csrf
            <h2 class="font-semibold">Keuntungan Hari Ini</h2>
            <input type="number" name="today_profit" placeholder="Masukan Keuntungan Penjualan Hari ini" class="w-full border p-2 rounded" required>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>

        <!-- Form Tambah Menu Terjual -->
        <form action="{{ route('target.storeMenu') }}" method="POST" class="bg-white text-black p-4 rounded-lg shadow space-y-4" id="menu-form">
            @csrf
            <h2 class="font-semibold">Menu Makanan dan Minuman yang Terjual</h2>
            <div id="menu-wrapper">
                <div class="menu-item mb-4">
                    <input type="text" name="menus[0][name]" placeholder="Nama Makanan/Minuman" class="w-full border p-2 rounded mb-2" required>
                    <input type="number" name="menus[0][price]" placeholder="Harga Makanan/Minuman" class="w-full border p-2 rounded mb-2" required>
                    <input type="number" name="menus[0][quantity]" placeholder="Jumlah yang terjual" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <button type="button" onclick="addMenu()" class="bg-blue-700 text-white px-4 py-2 rounded">+ Tambah Makanan/Minuman</button>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">Simpan</button>
        </form>

    </div>

    <script>
        let menuIndex = 1;

        function addMenu() {
            const wrapper = document.getElementById('menu-wrapper');
            const html = `
                <div class="menu-item mb-4">
                    <input type="text" name="menus[${menuIndex}][name]" placeholder="Nama Makanan/Minuman" class="w-full border p-2 rounded mb-2" required>
                    <input type="number" name="menus[${menuIndex}][price]" placeholder="Harga Makanan/Minuman" class="w-full border p-2 rounded mb-2" required>
                    <input type="number" name="menus[${menuIndex}][quantity]" placeholder="Jumlah yang terjual" class="w-full border p-2 rounded" required>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', html);
            menuIndex++;
        }
    </script>

</body>
</html>

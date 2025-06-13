<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UMKM APP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-start justify-center p-6">

    <div class="flex w-full max-w-7xl gap-8">

        <!-- Form Input -->
        <div class="w-1/2 bg-white text-black p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold mb-6 text-center">Kalkulator HPP Produk</h1>

            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Informasi Produk -->
                <div>
                    <h2 class="font-semibold mb-2">Informasi Produk</h2>
                    <input type="text" name="name" placeholder="Nama Produk" class="w-full border p-2 rounded" required>
                </div>

                <!-- Daftar Bahan -->
                <div id="materials-wrapper">
                    <h2 class="font-semibold mb-2">Daftar Bahan-bahan</h2>
                    <div class="material-item mb-4">
                        <input type="text" name="materials[0][name]" placeholder="Nama Bahan" class="w-full border p-2 rounded mb-2" required>
                        <input type="number" name="materials[0][price]" placeholder="Harga Bahan" class="w-full border p-2 rounded mb-2" required>
                        <input type="text" name="materials[0][unit]" placeholder="Jumlah Bahan (Buah/Gram/Kg)" class="w-full border p-2 rounded mb-2" required>
                        <input type="number" name="materials[0][quantity]" placeholder="Jumlah Kuantitas" class="w-full border p-2 rounded" required>
                    </div>
                </div>

                <button type="button" onclick="addMaterial()" class="bg-blue-700 text-white px-4 py-2 rounded">+ Tambah Bahan</button>

                <!-- Biaya Tambahan -->
                <div>
                    <h2 class="font-semibold mb-2">Biaya Tambahan</h2>
                    <input type="number" name="overhead_cost" placeholder="Biaya Overhead" class="w-full border p-2 rounded mb-2" required>
                    <input type="number" name="margin" placeholder="Target Margin (%)" class="w-full border p-2 rounded" required>
                </div>

                

                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded w-full">Hitung</button>
            </form>
        </div>

        <!-- Daftar Produk -->
        <div class="w-1/2">
            <h2 class="text-2xl font-bold mb-6">Daftar Produk</h2>

            @foreach ($products as $product)
                <div class="bg-white text-black p-4 rounded-lg shadow mb-4">
                    <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                    <p>Total HPP: Rp {{ number_format($product->total_hpp, 0, ',', '.') }}</p>
                    <p>Harga Jual yang Disarankan: Rp {{ number_format($product->suggested_price, 0, ',', '.') }}</p>

                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <script>
        let materialIndex = 1;

        function addMaterial() {
            const wrapper = document.getElementById('materials-wrapper');
            const html = `
                <div class="material-item mb-4">
                    <input type="text" name="materials[${materialIndex}][name]" placeholder="Nama Bahan" class="w-full border p-2 rounded mb-2" required>
                    <input type="number" name="materials[${materialIndex}][price]" placeholder="Harga Bahan" class="w-full border p-2 rounded mb-2" required>
                    <input type="text" name="materials[${materialIndex}][unit]" placeholder="Jumlah Bahan (Buah/Gram/Kg)" class="w-full border p-2 rounded mb-2" required>
                    <input type="number" name="materials[${materialIndex}][quantity]" placeholder="Jumlah" class="w-full border p-2 rounded" required>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', html);
            materialIndex++;
        }
    </script>

</body>
</html>

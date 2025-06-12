<h1>Detail Produk: {{ $product->name }}</h1>
<p>Total HPP: {{ number_format($total_hpp, 0, ',', '.') }}</p>

<h2>Bahan Baku</h2>
<ul>
    @foreach ($materials as $material)
        <li>{{ $material->name }} - {{ $material->quantity }} {{ $material->unit }} x {{ number_format($material->price, 0, ',', '.') }}</li>
    @endforeach
</ul>

<h3>Tambah Bahan</h3>
<form action="{{ route('materials.store') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <label>Nama Bahan:</label>
    <input type="text" name="name" required>
    <label>Jumlah:</label>
    <input type="number" step="0.01" name="quantity" required>
    <label>Satuan:</label>
    <input type="text" name="unit" required>
    <label>Harga:</label>
    <input type="number" step="0.01" name="price" required>
    <button type="submit">Simpan Bahan</button>
</form>

<br><a href="{{ route('products.index') }}">Kembali ke Daftar Produk</a>

<h1>Tambah Produk</h1>
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label>Nama Produk:</label>
    <input type="text" name="name" required>
    <button type="submit">Simpan</button>
</form>

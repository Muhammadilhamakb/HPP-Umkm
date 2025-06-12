<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-3xl font-bold mb-6 text-center text-purple-700">Login</h2>

        <!-- Tampilkan pesan error jika login gagal -->
        @if (session('error'))
            <div class="mb-4 text-red-600 text-sm text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                       placeholder="you@example.com" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                       placeholder="********" required>
            </div>

            <button type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg">
                Login
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-500">
            Belum punya akun? <a href="#" class="text-purple-600 hover:underline">Hubungi admin</a>
        </p>
    </div>

</body>
</html>

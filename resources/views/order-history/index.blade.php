<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-gray-400 text-xl font-semibold mb-2">Order History</h1>
        <h2 class="text-4xl font-bold mb-6 text-[#1E1B4B]">Order History</h2>

        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row md:items-center gap-3 mb-4">
            <input type="text" placeholder="Search"
                class="w-full md:w-1/3 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400">

            <div class="flex items-center gap-2">
                <button class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600">Date</button>
                <button class="px-2 py-2 border rounded-lg hover:bg-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v.01M12 12v.01M12 18v.01"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-2 mb-6">
            <button class="px-4 py-2 rounded-lg text-sm bg-blue-500 text-white">This month</button>
            <button class="px-4 py-2 rounded-lg text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">Last month</button>
            <button class="px-4 py-2 rounded-lg text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">This year</button>
            <button class="px-4 py-2 rounded-lg text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">Last Week</button>
            <button class="px-4 py-2 rounded-lg text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">Last Today</button>
            <button class="px-4 py-2 rounded-lg text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">This Week</button>
            <button class="px-4 py-2 rounded-lg text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">Today</button>
            <button class="px-4 py-2 rounded-lg text-sm bg-gray-100 text-gray-800 hover:bg-gray-200">Last 12 months</button>
        </div>

        <!-- Orders Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-sm">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                        <th class="px-4 py-3"><input type="checkbox"></th>
                        <th class="px-4 py-3">Nama Menu Makanan</th>
                        <th class="px-4 py-3">Order Date</th>
                        <th class="px-4 py-3">Jumlah yang terjual</th>
                        <th class="px-4 py-3">Keuntungan</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($orders as $order)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3"><input type="checkbox"></td>
                            <td class="px-4 py-3">{{ $order->product->name }}</td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($order->order_date)->format('n/j/y') }}</td>
                            <td class="px-4 py-3">{{ $order->quantity }}</td>
                            <td class="px-4 py-3">Rp{{ number_format($order->profit, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-right">
                                <button class="text-gray-500 hover:text-black">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v.01M12 12v.01M12 18v.01"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="mt-6 space-y-2 text-gray-800">
            <p class="text-lg"><strong>Total Keuntungan:</strong> Rp{{ number_format($totalProfit, 0, ',', '.') }}</p>
            <p class="text-lg"><strong>Target Keuntungan:</strong> Rp{{ number_format($targetProfit, 0, ',', '.') }}</p>
            <p class="text-lg"><strong>Presentase Keuntungan/Kerugian:</strong> Rp{{ number_format($totalProfit - $targetProfit, 0, ',', '.') }}</p>
        </div>
    </div>

</body>

</html>

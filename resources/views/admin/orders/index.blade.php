<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rekap Pesanan Masuk (Admin)</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('foods.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded shadow font-semibold">
                ? Kelola Master Data Makanan
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm rounded-lg border">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b text-gray-600 text-sm">
                        <th class="p-3">#ID</th>
                        <th class="p-3">Nama Pelanggan</th>
                        <th class="p-3 text-center">No Meja</th>
                        <th class="p-3">Detail Pesanan</th>
                        <th class="p-3">Total Harga</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-b text-sm hover:bg-gray-50">
                        <td class="p-3 font-bold text-gray-700">#{{ $order->id }}</td>
                        <td class="p-3 font-semibold">{{ $order->customer_name }}</td>
                        <td class="p-3 text-center font-semibold bg-gray-50">{{ $order->table_number }}</td>
                        <td class="p-3">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($order->orderDetails as $detail)
                                    <li>
                                        <span class="font-medium">{{ $detail->food->name ?? 'Item' }}</span>
                                        <span class="text-gray-500">x{{ $detail->quantity }}</span>
                                        <span class="text-xs text-gray-400">(Rp {{ number_format($detail->subtotal, 0, ',', '.') }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="p-3 font-bold text-green-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="p-3 text-center">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $order->status === 'Pending' ? 'bg-amber-100 text-amber-800' : ($order->status === 'Diproses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-3 text-center">
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="inline-flex items-center space-x-1">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="text-xs border-gray-300 rounded p-1">
                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="Selesai" {{ $order->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-2.5 py-1 rounded font-semibold">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">Belum ada pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $orders->links() }}</div>
    </div>
</x-app-layout>

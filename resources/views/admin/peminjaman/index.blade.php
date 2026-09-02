<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Transaksi Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('admin.peminjaman.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-md mb-4 inline-block shadow" style="background-color: #059669; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; display: inline-block;">+ Catat Peminjaman Baru</a>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4" style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 16px;">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4" style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 16px;">{{ session('error') }}</div>
                @endif

                <table class="w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700" style="background-color: #e5e7eb; color: #374151;">
                            <th class="border border-gray-300 p-2">No</th>
                            <th class="border border-gray-300 p-2">Nama Peminjam</th>
                            <th class="border border-gray-300 p-2">Judul Buku</th>
                            <th class="border border-gray-300 p-2">Tgl Pinjam</th>
                            <th class="border border-gray-300 p-2">Tgl Kembali</th>
                            <th class="border border-gray-300 p-2">Status</th>
                            <th class="border border-gray-300 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamans as $index => $p)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 p-2">{{ $p->user->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $p->buku->judul }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $p->tanggal_pinjam }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $p->tanggal_kembali }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $p->status === 'dipinjam' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }}" style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; background-color: {{ $p->status === 'dipinjam' ? '#fef3c7' : '#d1fae5' }}; color: {{ $p->status === 'dipinjam' ? '#b45309' : '#065f46' }};">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 p-2 text-center">
                                @if($p->status === 'dipinjam')
                                <form action="{{ route('admin.peminjaman.kembali', $p->id) }}" method="POST" class="inline-block" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-3 py-1 rounded text-sm shadow mb-1" style="background-color: #2563eb; color: #ffffff; padding: 4px 12px; border-radius: 4px; font-size: 14px; font-weight: 500; border: none; cursor: pointer; margin-bottom: 4px;">Kembalikan</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.peminjaman.destroy', $p->id) }}" method="POST" class="inline-block" style="display: inline-block;" onsubmit="return confirm('Yakin hapus data transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-medium px-3 py-1 rounded text-sm shadow" style="background-color: #e11d48; color: #ffffff; padding: 4px 12px; border-radius: 4px; font-size: 14px; font-weight: 500; border: none; cursor: pointer;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="border border-gray-300 p-4 text-center text-gray-500">Belum ada data peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

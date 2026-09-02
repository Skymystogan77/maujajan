<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-2">Selamat Datang, Admin!</h3>
                    <p class="text-gray-600 mb-6">Gunakan menu di bawah atau navigasi sistem untuk mengelola data buku, pengguna, dan transaksi peminjaman.</p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.buku.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm inline-block" style="background-color: #ffffff; color: #374151; border: 1px solid #d1d5db; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-block;">
                            Kelola Buku
                        </a>
                        <a href="{{ route('admin.user.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm inline-block" style="background-color: #ffffff; color: #374151; border: 1px solid #d1d5db; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-block;">
                            Kelola User
                        </a>
                        <a href="{{ route('admin.peminjaman.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 shadow-sm inline-block" style="background-color: #ffffff; color: #374151; border: 1px solid #d1d5db; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-block;">
                            Kelola Peminjaman
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

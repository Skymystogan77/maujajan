<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Data Buku') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kode Buku</label>
                        <input type="text" name="kode_buku" value="{{ old('kode_buku', $buku->kode_buku) }}" class="border-gray-300 rounded-md shadow-sm w-full" required style="width: 100%; border: 1px solid #d1d5db; padding: 8px; border-radius: 6px;">
                        @error('kode_buku')
                            <p class="text-red-500 text-xs mt-1" style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Judul Buku</label>
                        <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}" class="border-gray-300 rounded-md shadow-sm w-full" required style="width: 100%; border: 1px solid #d1d5db; padding: 8px; border-radius: 6px;">
                        @error('judul')
                            <p class="text-red-500 text-xs mt-1" style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Pengarang</label>
                        <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" class="border-gray-300 rounded-md shadow-sm w-full" required style="width: 100%; border: 1px solid #d1d5db; padding: 8px; border-radius: 6px;">
                        @error('pengarang')
                            <p class="text-red-500 text-xs mt-1" style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Penerbit</label>
                        <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" class="border-gray-300 rounded-md shadow-sm w-full" required style="width: 100%; border: 1px solid #d1d5db; padding: 8px; border-radius: 6px;">
                        @error('penerbit')
                            <p class="text-red-500 text-xs mt-1" style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Stok</label>
                        <input type="number" name="stok" value="{{ old('stok', $buku->stok) }}" class="border-gray-300 rounded-md shadow-sm w-full" required style="width: 100%; border: 1px solid #d1d5db; padding: 8px; border-radius: 6px;">
                        @error('stok')
                            <p class="text-red-500 text-xs mt-1" style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md" style="background-color: #3b82f6; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: 500; border: none; cursor: pointer;">Update</button>
                    <a href="{{ route('admin.buku.index') }}" class="ml-2 text-gray-600" style="color: #4b5563; margin-left: 8px; text-decoration: none;">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

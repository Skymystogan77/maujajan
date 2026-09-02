<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Anggota (User & Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('admin.user.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-md mb-4 inline-block shadow" style="background-color: #059669; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; display: inline-block;">+ Tambah Anggota</a>

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
                            <th class="border border-gray-300 p-2">Nama</th>
                            <th class="border border-gray-300 p-2">Email</th>
                            <th class="border border-gray-300 p-2">Role</th>
                            <th class="border border-gray-300 p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $usr)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 p-2">{{ $usr->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $usr->email }}</td>
                            <td class="border border-gray-300 p-2 text-center">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $usr->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}" style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; background-color: {{ $usr->role === 'admin' ? '#f3e8ff' : '#dbeafe' }}; color: {{ $usr->role === 'admin' ? '#7e22ce' : '#1d4ed8' }};">
                                    {{ ucfirst($usr->role) }}
                                </span>
                            </td>
                            <td class="border border-gray-300 p-2 text-center">
                                <a href="{{ route('admin.user.edit', $usr->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-medium px-3 py-1 rounded text-sm shadow inline-block" style="background-color: #f59e0b; color: #ffffff; padding: 4px 12px; border-radius: 4px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-block;">Edit</a>
                                <form action="{{ route('admin.user.destroy', $usr->id) }}" method="POST" class="inline-block" style="display: inline-block;" onsubmit="return confirm('Yakin hapus anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-medium px-3 py-1 rounded text-sm shadow" style="background-color: #e11d48; color: #ffffff; padding: 4px 12px; border-radius: 4px; font-size: 14px; font-weight: 500; border: none; cursor: pointer;">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

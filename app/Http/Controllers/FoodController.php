<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Menampilkan daftar semua data makanan (Halaman Index Admin Master Makanan).
     */
    public function index()
    {
        // Ambil data makanan terbaru dengan paginasi 10 item per halaman
        $foods = Food::latest()->paginate(10);
        return view('admin.foods.index', compact('foods'));
    }

    /**
     * Menampilkan form tambah makanan baru (Halaman Create Admin).
     */
    public function create()
    {
        return view('admin.foods.create');
    }

    /**
     * Menyimpan data makanan baru yang di-submit dari form (Action Store).
     */
    public function store(Request $request)
    {
        // Validasi input data dari form
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:Makanan,Minuman,Cemilan',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        // Cek apakah pengguna mengunggah berkas gambar
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder storage/app/public/foods
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        // Simpan data makanan baru ke database
        Food::create([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        // Redirect kembali ke halaman index master makanan dengan pesan sukses
        return redirect()->route('foods.index')->with('success', 'Data makanan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data makanan berdasarkan ID (Halaman Edit Admin).
     */
    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    /**
     * Memperbarui data makanan di database (Action Update).
     */
    public function update(Request $request, Food $food)
    {
        // Validasi input data dari form edit
        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:Makanan,Minuman,Cemilan',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $food->image; // Gunakan gambar lama jika tidak ada unggahan baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada di storage
            if ($food->image && Storage::disk('public')->exists($food->image)) {
                Storage::disk('public')->delete($food->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('foods', 'public');
        }

        // Update data makanan di database
        $food->update([
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('foods.index')->with('success', 'Data makanan berhasil diperbarui!');
    }

    /**
     * Menghapus data makanan dari database (Action Destroy).
     */
    public function destroy(Food $food)
    {
        // Hapus file gambar dari storage jika ada
        if ($food->image && Storage::disk('public')->exists($food->image)) {
            Storage::disk('public')->delete($food->image);
        }

        // Hapus record makanan dari database
        $food->delete();

        return redirect()->route('foods.index')->with('success', 'Data makanan berhasil dihapus!');
    }
}

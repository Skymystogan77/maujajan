<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar menu makanan untuk katalog pelanggan (Halaman Menu Customer).
     */
    public function index()
    {
        // Ambil semua data makanan untuk ditampilkan di form pemesanan customer
        $foods = Food::all();
        return view('customer.index', compact('foods'));
    }

    /**
     * Alias method checkout untuk memanggil fungsi store.
     */
    public function checkout(Request $request)
    {
        return $this->store($request);
    }

    /**
     * Memproses transaksi pesanan dari pelanggan (Checkout Pesanan).
     */
    public function store(Request $request)
    {
        // Validasi input pemesan dan daftar item yang dipilih
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'table_number'  => 'required',
            'items'         => 'required|array',
        ]);

        // Filter item pesanan: ambil hanya item dengan jumlah kuantitas lebih dari 0
        $orderedItems = array_filter($request->items, fn ($qty) => (int)$qty > 0);

        // Jika pelanggan tidak memilih menu sama sekali
        if (empty($orderedItems)) {
            return back()->with('error', 'Pilih minimal satu menu makanan dengan jumlah lebih dari 0!');
        }

        // Jalankan Database Transaction untuk menjaga konsistensi data multi-tabel
        DB::beginTransaction();
        try {
            // 1. Buat record transaksi utama di tabel 'orders'
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'table_number'  => $request->table_number,
                'total_price'   => 0, // Inisialisasi total harga 0
                'status'        => 'Pending', // Status awal pesanan baru
            ]);

            $totalPrice = 0; // Inisialisasi hitung total harga

            // 2. Loop setiap item makanan yang dipesan dan simpan ke 'order_details'
            foreach ($orderedItems as $foodId => $quantity) {
                $food = Food::findOrFail($foodId);
                $subtotal = $food->price * (int)$quantity; // Hitung subtotal per menu
                $totalPrice += $subtotal; // Akumulasi total pembayaran

                // Simpan rincian item ke tabel order_details
                OrderDetail::create([
                    'order_id' => $order->id,
                    'food_id'  => $food->id,
                    'quantity' => (int)$quantity,
                    'subtotal' => $subtotal,
                ]);
            }

            // 3. Update total tagihan pembayaran pada record order
            $order->update(['total_price' => $totalPrice]);

            // Commit transaksi jika seluruh proses berhasil
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Pesanan berhasil dibuat! Nomor Meja: ' . $order->table_number);
        } catch (\Exception $e) {
            // Rollback semua perubahan database jika terjadi kesalahan
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan rekap seluruh pesanan masuk untuk dashboard Admin.
     */
    public function adminDashboard()
    {
        // Ambil data order beserta detail item & informasi makanan secara Eager Loading
        $orders = Order::with('orderDetails.food')->latest()->get();
        return view('dashboard', compact('orders'));
    }

    /**
     * Alias method untuk admin orders index.
     */
    public function adminOrders()
    {
        return $this->adminDashboard();
    }

    /**
     * Memperbarui status pesanan dari dashboard admin (Action Update Status).
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate(['status' => 'required|string']);
        $order = Order::findOrFail($id);

        $statusInput = strtolower($request->status);
        // Konversi penulisan status ke format standar database
        if ($statusInput === 'completed' || $statusInput === 'selesai' || $statusInput === 'lunas') {
            $finalStatus = 'Selesai';
        } elseif ($statusInput === 'cancelled' || $statusInput === 'batalkan' || $statusInput === 'batal') {
            $finalStatus = 'Batalkan';
        } elseif ($statusInput === 'diproses') {
            $finalStatus = 'Diproses';
        } else {
            $finalStatus = 'Pending';
        }

        // Update status di database
        $order->update(['status' => $finalStatus]);

        return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui menjadi ' . $finalStatus . '!');
    }
}

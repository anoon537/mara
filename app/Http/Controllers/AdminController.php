<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PhotoPackage;
use App\Models\Galery;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\DirectOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingApproved;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function admindashboard()
    {
        $title = 'Dashboard';
        // Total pengguna dengan peran "user"
        $total_users = User::where('role', 'user')->count();
        $new_users = User::where('role', 'user')->where('created_at', '>=', now()->subMonth())->count();
        $total_photo_packages = PhotoPackage::count();
        $total_galery = Galery::count();
        $total_bookings = Booking::count();
        $total_direct_orders = DirectOrder::count();
        $total_all_orders = $total_bookings + $total_direct_orders;
        $pending_bookings = Booking::where('status', 'waiting for confirmation')->count(); // Booking yang masih pending
        $approved_bookings = Booking::where('status', 'confirmed')->count(); // Booking yang telah disetujui
        $completed_bookings = Booking::where('status', 'completed')->count(); // Booking yang telah selesai
        $completed_do = DirectOrder::where('status', 'completed')->count(); // Booking yang telah selesai
        $total_all_completed = $completed_bookings + $completed_do;
        $completedBookings = Booking::where('status', 'completed')->get();
        $completedDirectOrders = DirectOrder::where('status', 'completed')->get();
        $allCompletedOrders = $completedBookings->merge($completedDirectOrders);
        $total_revenue = $allCompletedOrders->sum(function ($order) {
            return $order->price ?? 0;
        });
        // Kirim data ke view
        return view('admin.index', compact(
            'title',
            'total_users',
            'new_users',
            'total_photo_packages',
            'total_galery',
            'total_all_orders',
            'pending_bookings',
            'approved_bookings',
            'total_all_completed',
            'total_revenue'
        ));
    }

    // USER SETTINGS
    public function indexUsers(Request $request)
    {
        $title = 'User Data';
        $users = User::query();

        if ($request->has('search')) {
            $search = $request->search;
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
                // Add more fields as needed for searching
            });
        }

        $users = $users->get();

        return view('admin.users.index', compact('title', 'users'));
    }

    public function createUser()
    {
        $title = 'Add New User';
        return view('admin.users.create', compact('title'));
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']),
            'role' => 'user', // Pastikan Anda menambahkan kolom 'role' pada model User
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User added successfully');
    }

    public function editUser($id)
    {
        $title = 'Edit User';
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('title', 'user'));
    }

    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    // BOOKINGS
    public function indexBookings(Request $request)
    {
        $title = 'Bookings';
        $query = Booking::query();

        // Memeriksa apakah ada parameter pencarian
        if ($request->has('search') && $request->search !== null) {
            $search = $request->search;

            // Menambahkan kondisi pencarian berdasarkan booking ID, nama pengguna, atau tanggal booking
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereDate('booking_date', 'like', '%' . $search . '%');
            });
        }

        // Mengambil data bookings sesuai dengan query yang sudah dibuat, dengan pengurutan custom
        $bookings = $query->with(['user', 'photo_package', 'payments'])
            ->orderByRaw("FIELD(status, 'waiting for confirmation', 'confirmed', 'completed')")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings', 'title'));
    }

    public function approve($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->save();

        $booking = Booking::findOrFail($payment->booking_id);
        $booking->status = 'confirmed';
        $booking->save();

        // Kirim email persetujuan ke pengguna
        Mail::to($booking->user->email)->send(new BookingApproved($booking));

        return redirect()->route('admin.bookings.index', $booking->id)
            ->with('success', 'Pembayaran disetujui, status pemesanan diperbarui, dan email persetujuan telah dikirim.');
    }

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);

        // Simpan harga asli dari paket foto
        $originalPrice = $booking->photo_package->price;

        // Jika status booking adalah 'completed', kembalikan harga booking ke harga asli paket foto
        if ($booking->status === 'completed') {
            $booking->price = $originalPrice;
        }

        // Ubah status booking menjadi 'completed'
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking marked as completed'); // Redirect
    }


    public function markPending($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'waiting for confirmation';
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking marked as pending'); // Redirect
    }

    public function destroyBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'User deleted successfully');
    }

    public function printInvoice($id)
    {
        $booking = Booking::with('user', 'photo_package')->findOrFail($id);

        // Mengembalikan tampilan invoice dengan data booking
        return view('admin.bookings.invoice', compact('booking'));
    }

    // REPORTS
    public function indexReport()
    {
        $title = 'Report';
        return view('admin.reports.index', compact('title'));
    }

    public function generateReport(Request $request)
    {
        $title = 'Detail Report';

        // Validasi tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Ambil data Booking yang selesai
        $completedBookings = Booking::where('status', 'completed')
            ->whereBetween('booking_date', [$start_date, $end_date])
            ->get();

        // Ambil data Direct Order yang selesai
        $completedDirectOrders = DirectOrder::where('status', 'completed')
            ->whereBetween('booking_date', [$start_date, $end_date])
            ->get();

        // Gabungkan dua koleksi menjadi satu
        $allCompletedOrders = $completedBookings->merge($completedDirectOrders);

        // Hitung total pendapatan
        $total_revenue = $allCompletedOrders->sum(function ($order) {
            return $order->price ?? 0;
        });

        // Tampilkan laporan
        return view('admin.reports.show', compact('allCompletedOrders', 'start_date', 'end_date', 'total_revenue', 'title'));
    }

    public function generatePdfReport(Request $request)
    {
        // Validasi tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Ambil data Booking yang selesai dalam rentang tanggal
        $completedBookings = Booking::where('status', 'completed')
            ->whereBetween('booking_date', [$start_date, $end_date])
            ->get();

        // Ambil data Direct Order yang selesai dalam rentang tanggal
        $completedDirectOrders = DirectOrder::where('status', 'completed')
            ->whereBetween('booking_date', [$start_date, $end_date])
            ->get();

        // Gabungkan dua koleksi menjadi satu
        $allCompletedOrders = $completedBookings->merge($completedDirectOrders);

        // Hitung total pendapatan dari kedua koleksi
        $total_revenue = $allCompletedOrders->sum(function ($order) {
            return $order->price ?? 0;
        });

        // Kirim data ke tampilan PDF
        return view('admin.reports.pdf', compact('allCompletedOrders', 'start_date', 'end_date', 'total_revenue'));
    }

    // DIRECT ORDER
    public function createDO()
    {
        $title = 'Direct Order';
        return view('admin.do.create', compact('title'));
    }

    public function storeDO(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'paket' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'extra_person' => 'required|integer|min:0',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'payment_type' => 'required|string|in:full,dp_30,dp_50',
        ]);

        $basePrice = $validatedData['harga'];
        $extraPersonCount = $validatedData['extra_person'];
        $extraPersonCost = 20000; // Cost per extra person
        $totalPrice = $basePrice + ($extraPersonCost * $extraPersonCount);

        $paymentType = $validatedData['payment_type'];
        switch ($paymentType) {
            case 'dp_30':
                $price = $totalPrice * 0.3;
                $status = 'dp';
                break;
            case 'dp_50':
                $price = $totalPrice * 0.5;
                $status = 'dp';
                break;
            default:
                $price = $totalPrice;
                $status = 'completed';
                break;
        }

        $directOrder = DirectOrder::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'paket' => $validatedData['paket'],
            'harga' => $basePrice,
            'extra_person' => $extraPersonCount,
            'booking_date' => $validatedData['booking_date'],
            'booking_time' => $validatedData['booking_time'],
            'price' => $price,
            'status' => $status,
        ]);

        return redirect()->route('admin.do.index')->with('success', 'Direct Order berhasil dibuat.');
    }

    public function completeDO($id)
    {
        $directOrder = DirectOrder::findOrFail($id);
        $basePrice = $directOrder->harga;
        $extraPersonCount = $directOrder->extra_person;
        $extraPersonCost = 20000; // Cost per extra person
        $totalPrice = $basePrice + ($extraPersonCost * $extraPersonCount);

        $directOrder->status = 'completed';
        $directOrder->price = $totalPrice; // Set the price to the full amount including extra person cost
        $directOrder->save();

        return redirect()->route('admin.do.index')->with('success', 'Order marked as completed.');
    }




    public function indexDO(Request $request)
    {
        $title = 'Direct Orders';
        $directOrders = DirectOrder::all();
        // Check if the request expects JSON
        if ($request->expectsJson()) {
            return response()->json($directOrders);
        }

        return view('admin.do.index', compact('directOrders', 'title'));
    }
    public function printInvoiceDo($id)
    {
        $do = DirectOrder::findOrFail($id);

        // Mengembalikan tampilan invoice dengan data booking
        return view('admin.do.invoice', compact('do'));
    }

    public function destroyDO($id)
    {
        // Cari DirectOrder dengan ID yang diberikan
        $directOrder = DirectOrder::findOrFail($id);

        // Menghapus DirectOrder
        $directOrder->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.do.index')->with('success', 'Direct Order berhasil dihapus.');
    }
}

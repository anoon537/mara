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
        $pending_bookings = Booking::where('status', 'pending')->count(); // Booking yang masih pending
        $approved_bookings = Booking::where('status', 'approved')->count(); // Booking yang telah disetujui
        $completed_bookings = Booking::where('status', 'completed')->count(); // Booking yang telah selesai
        $completed_do = DirectOrder::where('status', 'completed')->count(); // Booking yang telah selesai
        $total_all_completed = $completed_bookings + $completed_do;

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
            'total_all_completed'
        ));
    }

    // USER SETTINGS
    public function indexUsers()
    {
        $title = 'User Settings';
        $users = User::all();
        return view('admin.users.user-settings', compact('title', 'users'));
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

        return redirect()->route('admin.users.user-settings')->with('success', 'User added successfully');
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

        return redirect()->route('admin.users.user-settings')->with('success', 'User updated successfully');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.user-settings')->with('success', 'User deleted successfully');
    }

    // BOOKINGS
    public function indexBookings()
    {
        $title = 'Bookings';

        // Pastikan menggunakan with() untuk mengambil relasi `payments`
        $bookings = Booking::with(['user', 'photo_package', 'payments'])
            ->orderBy('created_at', 'desc')
            ->paginate(3); // Menggunakan pagination

        return view('admin.bookings.index', compact('bookings', 'title'));
    }


    public function approve($payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $payment->save();

        $booking = Booking::findOrFail($payment->booking_id);
        $booking->status = 'approved';
        $booking->save();

        // Kirim email persetujuan ke pengguna
        Mail::to($booking->user->email)->send(new BookingApproved($booking));

        return redirect()->route('admin.bookings.index', $booking->id)
            ->with('success', 'Pembayaran disetujui, status pemesanan diperbarui, dan email persetujuan telah dikirim.');
    }

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking marked as completed'); // Redirect
    }

    public function markPending($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'pending';
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
        $photoPackages = PhotoPackage::all();
        return view('admin.do.create', compact('photoPackages', 'title'));
    }

    public function storeDO(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'booking_date' => 'required|date',
            'booking_time' => 'required|date_format:H:i',
            'photo_package_id' => 'required|exists:photo_packages,id',
            'extra_person' => 'required|integer|min:0', // Validasi extra person
        ]);

        $photoPackage = PhotoPackage::findOrFail($request->photo_package_id);
        $extraPersonCount = $validatedData['extra_person'];
        $extraPersonCost = 15000; // Biaya untuk setiap extra person

        $price = $photoPackage->price + ($extraPersonCost * $extraPersonCount); // Total harga termasuk extra person

        // Simpan data ke Direct Order dengan harga yang diperbarui
        $directOrder = DirectOrder::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'photo_package_id' => $validatedData['photo_package_id'],
            'booking_date' => $validatedData['booking_date'],
            'booking_time' => $validatedData['booking_time'],
            'extra_person' => $extraPersonCount, // Simpan jumlah extra person
            'price' => $price, // Total harga
            'status' => 'completed',
        ]);

        return redirect()->route('admin.do.index')->with('success', 'Direct Order berhasil dibuat.');
    }

    public function indexDO()
    {
        $title = 'Direct Orders';
        // Mengambil DirectOrder dengan relasi PhotoPackage
        $directOrders = DirectOrder::with('photo_package')->get();
        return view('admin.do.index', compact('directOrders', 'title'));
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

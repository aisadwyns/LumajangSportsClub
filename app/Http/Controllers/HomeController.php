<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $roleName = $user->role->role_name;
        if ($roleName === 'user') {
            // 1. Ambil 5 Top Player berdasarkan Poin tertinggi
            // withCount('bookings') akan otomatis membuat variabel 'bookings_count'
            $topPlayers = User::withCount('bookings')
                ->orderBy('points', 'desc')
                ->take(5)
                ->get();

            // 2. Hitung progres Active Challenges untuk user yang login

            // Challenge 1: Join 3 Komunitas
            $joinedCommunitiesCount = DB::table('join_komunitas')
                ->where('user_id', $user->id)
                ->where('status_pembayaran', 'success')
                ->count();
            $progressKomunitas = ($joinedCommunitiesCount / 3) * 100;

            // Challenge 2: Weekly Booking (1/5)
            $weeklyBookingCount = Booking::where('user_id', $user->id)
                ->where('status', 'success')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count();
            $progressBooking = ($weeklyBookingCount / 5) * 100;

            return view('home', compact(
                'topPlayers',
                'joinedCommunitiesCount',
                'progressKomunitas',
                'weeklyBookingCount',
                'progressBooking'
            ));

        } elseif ($roleName == 'superadmin') {
            // 1. Data Pengguna (Total User Aktif)
            $totalPengguna = \App\Models\User::whereHas('role', function($query) {
                $query->where('role_name', 'user');
            })->count();

            // 2. Data Komunitas
            // Sesuaikan nama tabel 'komunitas' jika berbeda di database
            $totalKomunitas = \Illuminate\Support\Facades\DB::table('komunitas')->count();

            // 3. Total Pemasukan Keseluruhan (Dari pendaftaran komunitas yang sukses)
            $totalPemasukan = \Illuminate\Support\Facades\DB::table('join_komunitas')
                ->join('komunitas', 'join_komunitas.komunitas_id', '=', 'komunitas.id')
                ->where('join_komunitas.status_pembayaran', 'success')
                ->sum('komunitas.harga_per_sesi');

            // 4. Pendapatan Minggu Ini (Untuk Ikhtisar Pendapatan)
            $pendapatanMingguIni = \Illuminate\Support\Facades\DB::table('join_komunitas')
                ->join('komunitas', 'join_komunitas.komunitas_id', '=', 'komunitas.id')
                ->where('join_komunitas.status_pembayaran', 'success')
                ->whereBetween('join_komunitas.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->sum('komunitas.harga_per_sesi');

            // 5. Pemesanan Terbaru (Ambil 4 data terakhir untuk tabel)
            $pemesananTerbaru = \App\Models\Booking::with('court')
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();

            // 6. Riwayat Transaksi (Ambil 3 data terakhir untuk sidebar)
            $riwayatTransaksi = \App\Models\Booking::orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            return view('home', compact(
                'totalPengguna',
                'totalKomunitas',
                'totalPemasukan',
                'pendapatanMingguIni',
                'pemesananTerbaru',
                'riwayatTransaksi'
            ));

        } elseif ($roleName === 'venue') {
            $hariIni = Carbon::today();

            // 1. Total Lapangan
            $totalLapangan = Court::count();

            // // 2. Total Member (Role User)
            // $totalMember = User::where('role_name', 'user')->count();

            // 3. Slot Booking & Total Booking Hari Ini
            // Menghitung jumlah booking yang masuk untuk tanggal hari ini
            $bookingHariIni = Booking::whereDate('booking_date', $hariIni)->count();

            // 4. Total Pemasukan Hari Ini (Hanya dari status success)
            $pemasukanHariIni = Booking::whereDate('created_at', $hariIni)
                ->where('status', 'success')
                ->sum('total_price');

            // 5. Booking Terbaru (Ambil 5 transaksi terakhir beserta relasi lapangan)
            $bookingTerbaru = Booking::with('court')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // 6. Hitung persentase slot terisi (Contoh Asumsi: 1 Lapangan = 10 Slot/Jam per hari)
            $totalKapasitasHarian = $totalLapangan * 10;
            $slotTerisi = $totalKapasitasHarian > 0 ? round(($bookingHariIni / $totalKapasitasHarian) * 100) : 0;

            return view('home', compact(
                'totalLapangan',
                // 'totalMember',
                'bookingHariIni',
                'pemasukanHariIni',
                'bookingTerbaru',
                'slotTerisi'
            ));
        }

        return view('home');
    }
}

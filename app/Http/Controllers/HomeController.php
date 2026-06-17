<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use App\Models\JoinKomunitas;
use App\Models\Member;
use App\Models\User;
use App\Models\Challenge;
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
            $topPlayers = User::where('role_id', 9)
                ->withCount('bookings', 'komunitas as communities_count')
                ->orderBy('points', 'desc')
                ->take(3)
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

            $books = Booking::with('court')
                ->where('user_id', $user->id)
                ->orderBy('booking_date', 'desc')
                ->orderBy('start_time', 'desc')
                ->get();

            $komunitas = JoinKomunitas::with('komunitas')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $activeChallenges = Challenge::with(['participants'])
                ->where('status', 'active')
                ->get();

            return view('home', compact(
                'topPlayers',
                'joinedCommunitiesCount',
                'progressKomunitas',
                'weeklyBookingCount',
                'progressBooking',
                'books',
                'komunitas',
                'activeChallenges'
            ));

        } elseif ($roleName == 'superadmin') {
            // 1. Data Ringkasan Dashboard
            $totalPengguna = \App\Models\User::whereHas('role', function($query) {
                $query->where('role_name', 'user');
            })->count();

            $totalKomunitas = \Illuminate\Support\Facades\DB::table('komunitas')->count();

            $totalPemasukan = \Illuminate\Support\Facades\DB::table('join_komunitas')
                ->join('komunitas', 'join_komunitas.komunitas_id', '=', 'komunitas.id')
                ->where('join_komunitas.status_pembayaran', 'success')
                ->sum('komunitas.harga_per_sesi');

            $pendapatanMingguIni = \Illuminate\Support\Facades\DB::table('join_komunitas')
                ->join('komunitas', 'join_komunitas.komunitas_id', '=', 'komunitas.id')
                ->where('join_komunitas.status_pembayaran', 'success')
                ->whereBetween('join_komunitas.created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->sum('komunitas.harga_per_sesi');


            $riwayatTransaksi = JoinKomunitas::orderBy('created_at', 'desc')->take(3)->get();

            // ========================================================
            // ---- LOGIKA GRAFIK MINGGUAN REAL (SENIN s/d MINGGU) ----
            // ========================================================
            $chartWeekLabels = [];
            $visitorWeekPageViews = [];
            $visitorWeekSessions = [];
            $incomeWeekData = [];

            $startOfWeek = \Carbon\Carbon::now()->startOfWeek(); // Mengunci hari Senin di minggu ini

            for ($i = 0; $i < 7; $i++) {
                $date = $startOfWeek->copy()->addDays($i);
                $chartWeekLabels[] = $date->translatedFormat('D'); // Sen, Sel, Rab, Kam, Jum, Sab, Min
                $dateStr = $date->format('Y-m-d');

                // Hitung real Page Views harian
                $visitorWeekPageViews[] = \App\Models\WebVisitor::whereDate('created_at', $dateStr)->count();

                // Hitung real Sessions harian (menggunakan distinct session_id)
                $visitorWeekSessions[] = \App\Models\WebVisitor::whereDate('created_at', $dateStr)
                    ->distinct('session_id')
                    ->count('session_id');

                // Hitung real Pendapatan harian dari pendaftaran sukses
                $incomeWeekData[] = JoinKomunitas::whereDate('join_komunitas.created_at', $dateStr)
                    ->join('komunitas', 'join_komunitas.komunitas_id', '=', 'komunitas.id')
                    ->where('join_komunitas.status_pembayaran', 'success')
                    ->sum('komunitas.harga_per_sesi');
            }

            // ========================================================
            // ---- LOGIKA GRAFIK BULANAN REAL (DIKELOMPOKKAN PER MINGGU) ----
            // ========================================================
            $chartMonthLabels = [];
            $visitorMonthPageViews = [];
            $visitorMonthSessions = [];

            for ($i = 4; $i >= 0; $i--) {
                $startOfWeekLabel = \Carbon\Carbon::now()->subWeeks($i)->startOfWeek();
                $endOfWeekLabel = \Carbon\Carbon::now()->subWeeks($i)->endOfWeek();

                // Menghasilkan Label seperti: "11 May - 17 May"
                $chartMonthLabels[] = $startOfWeekLabel->format('d M') . ' - ' . $endOfWeekLabel->format('d M');

                // Hitung real Page Views mingguan
                $visitorMonthPageViews[] = \App\Models\WebVisitor::whereBetween('created_at', [
                    $startOfWeekLabel->format('Y-m-d 00:00:00'),
                    $endOfWeekLabel->format('Y-m-d 23:59:59')
                ])->count();

                // Hitung real Sessions mingguan
                $visitorMonthSessions[] = \App\Models\WebVisitor::whereBetween('created_at', [
                    $startOfWeekLabel->format('Y-m-d 00:00:00'),
                    $endOfWeekLabel->format('Y-m-d 23:59:59')
                ])->distinct('session_id')->count('session_id');
            }

            // chart aktivitas
            $chartAktivitasLabels = [];
            $dataBooking = [];
            $dataKomunitas = [];

            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $chartAktivitasLabels[] = $month->translatedFormat('M'); // Jan, Feb, dst

                // Hitung Booking Sukses
                $dataBooking[] = Booking::where('status', 'success')
                    ->whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();

                // Hitung Join Komunitas Sukses
                $dataKomunitas[] = JoinKomunitas::where('status_pembayaran', 'success')
                    ->whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
            }

            $totalAktivitas = array_sum($dataBooking) + array_sum($dataKomunitas);

            return view('home', compact(
                'totalPengguna',
                'totalKomunitas',
                'totalPemasukan',
                'pendapatanMingguIni',

                'riwayatTransaksi',
                'chartWeekLabels',
                'visitorWeekPageViews',
                'visitorWeekSessions',
                'chartMonthLabels',
                'visitorMonthPageViews',
                'visitorMonthSessions',
                'incomeWeekData',
                'chartAktivitasLabels',
                'dataBooking',
                'dataKomunitas',
                'totalAktivitas',

            ));

        } elseif ($roleName === 'venue') {
            $hariIni = Carbon::today();

            // 1. Total Lapangan
            $totalLapangan = Court::count();

            // 3. Slot Booking & Total Booking Hari Ini
            // Menghitung jumlah booking yang masuk untuk tanggal hari ini
            $bookingHariIni = Booking::whereDate('booking_date', $hariIni)->count();

            // 4. Total Pemasukan Hari Ini (Hanya dari status success)
            $pemasukanHariIni = Booking::whereDate('created_at', $hariIni)
                ->where('status', 'success')
                ->sum('total_price');

            // 5. Booking Terbaru (Ambil 5 transaksi terakhir beserta relasi lapangan)
            $venueAdminId = Auth::user()->venueAdmin->id;
            // 2. Ambil booking khusus untuk lapangan yang dimiliki venue admin ini
            // Asumsi: tabel 'courts' memiliki foreign key 'venue_admin_id'
            $bookingTerbaru = Booking::whereHas('court', function ($query) use ($venueAdminId) {
                $query->where('venue_admin_id', $venueAdminId);
            })->with(['user', 'court'])->latest()->get();
            // // 2. Total Member (Role User)
            $totalMember = Member::where('venue_admin_id', $venueAdminId)
            ->count();

            // 6. Hitung persentase slot terisi (Contoh Asumsi: 1 Lapangan = 10 Slot/Jam per hari)
            $totalKapasitasHarian = $totalLapangan * 10;
            $slotTerisi = $totalKapasitasHarian > 0 ? round(($bookingHariIni / $totalKapasitasHarian) * 100) : 0;

            return view('home', compact(
                'totalLapangan',
                'totalMember',
                'bookingHariIni',
                'pemasukanHariIni',
                'bookingTerbaru',
                'slotTerisi'
            ));
        }

        return view('home');
    }
}

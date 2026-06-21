<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use App\Models\JoinKomunitas;
use App\Models\Member;
use App\Models\User;
use App\Models\Challenge;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
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

            $activeChallenges = Auth::user()->challenges()
                ->where('challenges.status', 'active') // Status global tantangan harus aktif
                ->withPivot('progress', 'status', 'completed_at') // Memastikan kolom status milik pivot ikut terambil
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
            $venueAdminId = Auth::user()->venueAdmin->id;
            $hariIni = Carbon::today();

            // 1. Total Lapangan
            $totalLapangan = Court::where('venue_admin_id', $venueAdminId)->count();

            // 3. Slot Booking & Total Booking Hari Ini
            // Menghitung jumlah booking yang masuk untuk tanggal hari ini
            $bookingHariIni = Booking::whereHas('court', function ($query) use ($venueAdminId) {
                $query->where('venue_admin_id', $venueAdminId);
            })->whereDate('booking_date', $hariIni)->count();

            // 4. Total Pemasukan Hari Ini (Hanya dari status success)
            $pemasukanHariIni = Booking::whereDate('created_at', $hariIni)
                ->where('status', 'success')->whereHas('court', function ($query) {
                    $query->where('venue_admin_id', Auth::user()->venueAdmin->id);
                })
                ->sum('total_price');

            // 5. Booking Terbaru (Ambil 5 transaksi terakhir beserta relasi lapangan)

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

            // ========================================================
            // ---- LOGIKA GRAFIK BOOKING KHUSUS VENUE INI (BULANAN) ----
            // ========================================================
            $venueChartLabels = [];
            $venueBookingData = [];

            // 1. Ambil ID Venue milik admin yang sedang login
            $currentVenueId = $venueAdminId;
            // 2. Lakukan perulangan mundur dari 5 bulan lalu sampai 0 (bulan ini)
            for ($i = 5; $i >= 0; $i--) {
                // subMonths($i) akan menghitung mundur berdasarkan bulan berjalan saat ini
                $date = \Carbon\Carbon::now()->subMonths($i);

                // Label grafik: Jan, Feb, Mar... (dinamis mengikuti bulan sekarang)
                $venueChartLabels[] = $date->translatedFormat('M');

                // 3. Hitung jumlah booking khusus venue ini pada bulan tersebut
                $bookingCount = \App\Models\Booking::whereHas('court', function ($query) use ($currentVenueId) {
                    $query->where('venue_admin_id', $currentVenueId);
                })
                    // ->where('status_pembayaran', 'success') // Aktifkan jika hanya ingin yang sukses
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count();

                $venueBookingData[] = $bookingCount;
            }


            return view('home', compact(
                'totalLapangan',
                'totalMember',
                'bookingHariIni',
                'pemasukanHariIni',
                'bookingTerbaru',
                'slotTerisi',
                'venueChartLabels',
                'venueBookingData'
            ));
        }

        return view('home');
    }

    public function exportPdf()
    {
        // Pastikan hanya role superadmin yang bisa mengakses
        if (Auth::user()->role->role_name !== 'superadmin') {
            abort(403, 'Akses tidak sah.');
        }

        $currentYear = \Carbon\Carbon::now()->year;
        $currentMonth = \Carbon\Carbon::now()->month;

        // ========================================================
        // 1. DATA METRIK UTAMA (BULAN INI)
        // ========================================================
        $totalPageViews = \App\Models\WebVisitor::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->count();

        $totalSessions = \App\Models\WebVisitor::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->distinct('session_id')->count('session_id');

        // Total seluruh pengguna terdaftar sampai bulan ini
        $totalPengguna = \App\Models\User::whereHas('role', function($query) {
            $query->where('role_name', 'user');
        })->count();


        // ========================================================
        // 2. DATA AGREGASI & TREN (6 BULAN TERAKHIR)
        // ========================================================
        $reportData = [];
        $grandTotalPenghasilan = 0; // Untuk menampung total penghasilan 6 bulan

        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $monthStr = $date->month;
            $yearStr = $date->year;

            // A. Hitung Jumlah Booking Lapangan (Venue)
            $bookingCount = \App\Models\Booking::whereYear('created_at', $yearStr)
                ->whereMonth('created_at', $monthStr)->count();

            // B. Hitung Jumlah Transaksi Komunitas (Join Komunitas Sukses)
            $komunitasCount = \Illuminate\Support\Facades\DB::table('join_komunitas')
                ->where('status_pembayaran', 'success')
                ->whereYear('created_at', $yearStr)
                ->whereMonth('created_at', $monthStr)->count();

            // C. Hitung Nominal Pemasukan Komunitas di Bulan Tersebut
            $pemasukanBulanIni = \Illuminate\Support\Facades\DB::table('join_komunitas')
                ->join('komunitas', 'join_komunitas.komunitas_id', '=', 'komunitas.id')
                ->where('join_komunitas.status_pembayaran', 'success')
                ->whereYear('join_komunitas.created_at', $yearStr)
                ->whereMonth('join_komunitas.created_at', $monthStr)
                ->sum('komunitas.harga_per_sesi');

            // Akumulasikan ke Grand Total
            $grandTotalPenghasilan += $pemasukanBulanIni;

            $reportData[] = [
                'bulan' => $date->translatedFormat('F Y'),
                'booking_count' => $bookingCount,
                'komunitas_count' => $komunitasCount,
                'pemasukan' => $pemasukanBulanIni
            ];
        }

        // 3. Render HTML ke DomPDF dengan Kertas A4 Portrait
        $pdf = Pdf::loadView('admin.reports.executive_summary', compact(
            'totalPageViews', 'totalSessions', 'totalPengguna',
            'reportData', 'grandTotalPenghasilan'
        ));

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('LSC_Superadmin_Executive_Summary_'.now()->format('M_Y').'.pdf');
    }
}

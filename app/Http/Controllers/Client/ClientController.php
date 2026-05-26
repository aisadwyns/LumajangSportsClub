<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Komunitas;
use App\Models\Court;
use App\Models\Schedule;
use App\Models\Jersey;
use App\Models\Booking;
use App\Models\Role;
use App\Models\User;
use App\Models\JenisKomunitas;
use App\Models\Review;
use App\Models\JoinKomunitas;

class ClientController extends Controller
{
    public function index(Request $request)
    {
       $jenisKomunitas = JenisKomunitas::all();

        // 2. Siapkan query dasar untuk komunitas beserta jumlah anggotanya
        $query = Komunitas::withCount(['joinKomunitas' => function ($q) {
            $q->where('status_pembayaran', 'success');
        }]);

        // 3. Filter berdasarkan input teks (Nama Komunitas)
        if ($request->filled('nama')) {
            $query->where('nama_komunitas', 'like', '%' . $request->nama . '%');
        }

        // 4. Filter berdasarkan dropdown (Jenis Olahraga)
        if ($request->filled('jenis')) {
            $query->where('jenis_komunitas_id', $request->jenis);
        }

        // 5. Eksekusi query (bisa menggunakan ->paginate(10) jika data sudah banyak)
        $komunitas = $query->latest()->get();
        return view('client.index', compact('komunitas', 'jenisKomunitas'));
    }

    public function publicBlogIndex() {
        $blogs = Blog::with('author')->where('status', 'published')->latest()->paginate(9);
        return view('client.blog', compact('blogs'));
    }
    public function publicBlogShow($slug)
    {
        $blog = Blog::with('author')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('client.detailblog', compact('blog'));
    }

    public function publicEventIndex(){
        $events = Event::with('author')->where('status', 'published')->latest()->paginate(9);
        return view('client.event', compact('events'));
    }

    public function publicKomunitasIndex(){
        $komunitas = Komunitas::with('jenis')->latest()->get();
        return view('client.komunitas', compact('komunitas'));
    }
    public function publicKomunitasShow($id)
    {
        $komunitas = Komunitas::with(['jenis', 'reviews.user'])->findOrFail($id);

        $canReview = false;
        if (Auth::check()) {
            $hasJoinedAndPaid = JoinKomunitas::where('user_id', Auth::id())
                ->where('komunitas_id', $id)
                ->where('status_pembayaran', 'lunas')
                ->exists();

            if ($hasJoinedAndPaid) {
                $canReview = true;
            }
        }

        return view('client.detailkomunitas', compact('komunitas', 'canReview'));
    }
    public function publicLeaderboard(){
        $clientRoleId = Role::where('role_name', 'user')->value('id');

        // 2. Ambil top 10 user berdasarkan poin tertinggi
        $leaderboard = User::where('role_id', $clientRoleId)
            ->orderBy('points', 'desc') // Urutkan dari yang terbesar
            ->take(10) // Ambil 10 orang saja (Top 10)
            ->get();

        return view('client.leaderboard', compact('leaderboard'));
    }
    public function publicReview(){
        $reviews = Review::where('type', 'aplikasi')->where('is_active', true)->latest()->get();
        return view('client.testimoni', compact('reviews'));
    }
    public function publicLapanganIndex(){
        $courts = Court::where('status', 'active')->get();
        return view('client.lapangan', compact('courts'));
    }

    public function publicLapanganShow($id, Request $request) {
        $court = Court::with('images','venueAdmin', 'reviews.user')->findOrFail($id);

        $tanggal = $request->tanggal ?? now()->toDateString();

        $schedules = Schedule::where('court_id', $id)
            ->where('schedule_date', $tanggal)
            ->get();

        $bookings = Booking::where('court_id', $id)
            ->whereDate('booking_date', $tanggal)
            ->get();


        $bookedSlots = collect()
            ->merge($schedules->pluck('start_time'))
            ->merge($bookings->pluck('start_time'))
            ->map(fn($time) => substr($time, 0, 5))
            ->unique()
            ->toArray();

        $canReview = false;

        if (Auth::check()) {
            // Cek data di tabel bookings berdasarkan user_id, lapangan_id, dan status transaksinya
            $hasBooked = Booking::where('user_id', Auth::id())
                                ->where('court_id', $court->id)
                                ->whereIn('status', ['success', 'completed'])
                                ->exists();

            if ($hasBooked) {
                $canReview = true;
            }
        }

        // $isMember = $schedules->pluck('start_time')->contains($jam);
        // $isUserBooking = $bookings->pluck('start_time')->contains($jam);
        return view('client.detaillapangan', compact(
            'court',
            'schedules',
            'bookedSlots',
            'tanggal',
            'canReview'
        ));
    }

    public function publicJersey() {
        $jerseys = Jersey::all();
        return view('client.jersey', compact('jerseys'));
    }

    public function publicMeschandise() {}


}

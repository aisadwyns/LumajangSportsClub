<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Komunitas;
use App\Models\Court;
use App\Models\Schedule;


class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
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
        $komunitas = Komunitas::with('jenis')->findOrFail($id);
        return view('client.detailkomunitas', compact('komunitas'));
    }
     public function publicLeaderboard()
    {
        return view('client.leaderboard');
    }
    public function publicReview(){
        return view('client.testimoni');
    }
    public function publicLapanganIndex(){
        $courts = Court::where('status', 'active')->get();
        return view('client.lapangan', compact('courts'));
    }

    public function publicLapanganShow($id)
    {
        $court = Court::findOrFail($id);

        $schedules = Schedule::where('court_id', $id)
            ->orderBy('start_time')
            ->get();

        return view('client.detaillapangan', compact('court','schedules'));
    }


}

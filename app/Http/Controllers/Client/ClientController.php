<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Komunitas;


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

    public function publicEventIndex(){
        $events = Event::with('author')->where('status', 'published')->latest()->paginate(9);
        return view('client.event', compact('events'));
    }

    public function publicKomunitasIndex(){
       $komunitas = Komunitas::with('jenis')->latest()->get();
        return view('client.komunitas', compact('komunitas'));
    }


}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }

    public function publicBlogIndex()
    {
        $blogs = Blog::with('author')
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('client.blog', compact('blogs'));
    }



}

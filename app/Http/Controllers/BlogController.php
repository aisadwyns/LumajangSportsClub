<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
    $blogs = Blog::with('author')->latest()->get();
    return view('blog.index', compact('blogs'));
    }

    public function create() {
        return view('blog.create');
    }
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'excerpt'   => 'nullable|string',
            'content'   => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'    => 'required|in:draft,published',
        ]);

        $thumbnailName = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = Str::uuid() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('blogs', $thumbnail, $thumbnailName);
        }

        Blog::create([
            'user_id'   => auth('')->id(),
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'excerpt'   => $request->excerpt,
            'content'   => $request->content,
            'thumbnail' => $thumbnailName,
            'status'    => $request->status,
        ]);

        Alert::success('Sukses', 'Blog berhasil ditambahkan');
        return redirect()->route('blog.index');
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'excerpt'   => 'nullable|string',
            'content'   => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'    => 'required|in:draft,published',
        ]);

        // kalau upload thumbnail baru
        if ($request->hasFile('thumbnail')) {

            // hapus thumbnail lama (kalau ada)
            if ($blog->thumbnail && Storage::disk('public')->exists('blogs/' . $blog->thumbnail)) {
                Storage::disk('public')->delete('blogs/' . $blog->thumbnail);
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = Str::uuid() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('blogs', $thumbnail, $thumbnailName);

            $blog->thumbnail = $thumbnailName;
        }

        $blog->update([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'status'  => $request->status,
        ]);

        Alert::success('Sukses', 'Blog berhasil diperbarui');
        return redirect()->route('blog.index');
    }

    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        // hapus thumbnail kalau ada
        if ($blog->thumbnail) {
            Storage::disk('public')->delete('blogs/' . $blog->thumbnail);
        }

        $blog->delete();

        Alert::success('Sukses', 'Blog berhasil dihapus');
        return redirect()->route('blog.index');
    }

}

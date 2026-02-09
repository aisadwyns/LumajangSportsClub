<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Event;
use App\Models\JenisKomunitas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('jenisKomunitas')->get();
        return view('event.index', compact('events'));
    }

    public function create()
    {
        $jenisKomunitas = JenisKomunitas::all();
        return view('event.create', compact('jenisKomunitas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_komunitas_id' => 'required|exists:jenis_komunitas,id',
            'title'              => 'required|string|max:255',
            'description'        => 'nullable|string',
            'thumbnail'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'event_date'         => 'required|date',
            'start_time'         => 'nullable',
            'end_time'           => 'nullable',
            'location'           => 'nullable|string|max:255',
            'registration_link'  => 'nullable|url',
            'status'             => 'required|in:draft,published',
        ]);

        $fileName = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $fileName = Str::uuid() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('thumbnail_event', $thumbnail, $fileName);
        }

        $data = $request->all();
        $data['thumbnail'] = $fileName;
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        Event::create($data);

        Alert::success('sukses', 'data event berhasil ditambahkan');
        return redirect()->route('event.index');
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $jenisKomunitas = JenisKomunitas::all();

        return view('event.edit', compact('event', 'jenisKomunitas'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'jenis_komunitas_id' => 'required|exists:jenis_komunitas,id',
            'title'              => 'required|string|max:255',
            'description'        => 'nullable|string',
            'thumbnail'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'event_date'         => 'required|date',
            'start_time'         => 'nullable',
            'end_time'           => 'nullable',
            'location'           => 'nullable|string|max:255',
            'registration_link'  => 'nullable|url',
            'status'             => 'required|in:draft,published',
        ]);

        $fileName = $event->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($fileName) {
                Storage::disk('public')->delete('thumbnail_event/' . $fileName);
            }

            $thumbnail = $request->file('thumbnail');
            $fileName = Str::uuid() . '.' . $thumbnail->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('thumbnail_event', $thumbnail, $fileName);
        }

        $data = $request->all();
        $data['thumbnail'] = $fileName;
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        $event->update($data);

        Alert::success('sukses', 'data event berhasil diupdate');
        return redirect()->route('event.index');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        if ($event->thumbnail) {
            Storage::disk('public')->delete('thumbnail_event/' . $event->thumbnail);
        }

        $event->delete();

        Alert::success('sukses', 'data event berhasil dihapus');
        return redirect()->route('event.index');
    }
}

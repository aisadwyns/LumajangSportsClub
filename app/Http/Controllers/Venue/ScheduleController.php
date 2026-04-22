<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Member;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $schedules = Schedule::with(['member', 'court'])
            ->whereHas('court', function ($q) use ($venue) {
                $q->where('venue_admin_id', $venue->id);
            })
            ->orderBy('schedule_date')
            ->orderBy('start_time')
            ->get();

        $members = Member::all();
        $courts = Court::where('venue_admin_id', $venue->id)->get();

        return view('venue.schedule.index', compact('schedules', 'members', 'courts'));
    }

    public function create()
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $members = Member::all();
        $courts = Court::where('venue_admin_id', $venue->id)->get();

        return view('venue.schedule.create', compact('members', 'courts'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            abort(403);
        }

        $venue = $user->venueAdmin;

        $request->validate([
            'member_id' => 'required|exists:members,id',
            'court_id' => 'required|exists:courts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $court = Court::where('venue_admin_id', $venue->id)
            ->where('id', $request->court_id)
            ->firstOrFail();

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $count = 0;
        $duplicate = 0;

        while ($start <= $end) {

            $exists = Schedule::where('court_id', $court->id)
                ->where('schedule_date', $start->format('Y-m-d'))
                ->where(function ($q) use ($request) {
                    $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
                })
                ->exists();

            if (!$exists) {
                Schedule::create([
                    'member_id' => $request->member_id,
                    'court_id' => $court->id,
                    'schedule_date' => $start->format('Y-m-d'),
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'type' => 'routine',
                ]);
                $count++;
            } else {
                $duplicate++;
            }

            $start->addWeek();
        }

        if ($duplicate > 0) {
            Alert::warning('Sebagian Gagal', "$duplicate jadwal sudah terisi, $count berhasil ditambahkan");
        } else {
            Alert::success('Berhasil', "$count jadwal berhasil ditambahkan");
        }

        return redirect()->route('venue.schedule.index');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        // 🔥 Hapus semua jadwal dengan pola yang sama (semua minggu)
        Schedule::where('court_id', $schedule->court_id)
            ->where('member_id', $schedule->member_id)
            ->where('start_time', $schedule->start_time)
            ->where('end_time', $schedule->end_time)
            ->delete();

        Alert::success('Berhasil', 'Semua jadwal berhasil dihapus');

        return back();
    }

    public function getSchedulesJson()
    {
        $user = Auth::user();

        if (!$user || !$user->venueAdmin) {
            return response()->json([]);
        }

        $venue = $user->venueAdmin;

        $schedules = Schedule::with(['member', 'court'])
            ->whereHas('court', function ($q) use ($venue) {
                $q->where('venue_admin_id', $venue->id);
            })
            ->get();

        return response()->json(
            $schedules->map(function ($item) {

                // 🎨 WARNA
                if ($item->type == 'routine') {
                    $color = '#0d6efd'; // biru
                } elseif ($item->type == 'member_only') {
                    $color = '#ffc107'; // kuning
                } else {
                    $color = '#6c757d'; // abu
                }

                return [
                    'id' => $item->id,
                    'title' => ($item->member?->nama_club ?? 'Member')
                            . ' - ' . ($item->court->name ?? 'Court'),
                    'start' => $item->schedule_date . 'T' . $item->start_time,
                    'end' => $item->schedule_date . 'T' . $item->end_time,
                    'color' => $color,
                ];
            })
        );
    }
}

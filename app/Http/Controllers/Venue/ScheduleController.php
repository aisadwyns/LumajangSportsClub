<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Member;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venueId = auth()->user()->venue_id;

        $schedules = Schedule::with(['member', 'court'])
            ->whereHas('court', function ($q) use ($venueId) {
                $q->where('venue_id', $venueId);
            })
            ->orderBy('schedule_date')
            ->orderBy('start_time')
            ->get();

        $members = Member::all();
        $courts = Court::where('venue_id', $venueId)->get();

        return view('venue.schedule.index', compact('schedules', 'members', 'courts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'court_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $count = 0;

        while ($start <= $end) {

            $exists = Schedule::where('court_id', $request->court_id)
                ->where('schedule_date', $start->format('Y-m-d'))
                ->where(function ($q) use ($request) {
                    $q->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
                })
                ->exists();

            if (!$exists) {
                Schedule::create([
                    'member_id' => $request->member_id,
                    'court_id' => $request->court_id,
                    'schedule_date' => $start->format('Y-m-d'),
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'type' => 'routine',
                ]);
                $count++;
            }

            $start->addWeek(); // tiap minggu
        }

        return back()->with('success', "Berhasil tambah $count jadwal");
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }

    public function getSchedulesJson()
    {
        $venueId = auth()->user()->venue_id;

        $schedules = Schedule::with(['member', 'court'])
            ->whereHas('court', function ($q) use ($venueId) {
                $q->where('venue_id', $venueId);
            })
            ->get();

        return response()->json(
            $schedules->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->member->nama_member . ' - ' . $item->court->name,
                    'start' => $item->schedule_date . 'T' . $item->start_time,
                    'end' => $item->schedule_date . 'T' . $item->end_time,
                    'color' => '#0d6efd',
                ];
            })
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FlightSchedule;
use Illuminate\Http\Request;

class FlightScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('view_flightSchedule')->with(compact('flightSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $flightSchedule = null;

        return view('create_flightSchedule')->with(compact('flightSchedule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => '',
            'body' => '',
        ]);
        $flightSchedule = FlightSchedule::create($data);
        return redirect()->route('flightSchedule.show', ['id' => $flightSchedule->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(FlightSchedule $flightSchedule)
    {
        return view('view_flightSchedule')->with(compact('flightSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(FlightSchedule $flightSchedule)
    {
        return view('create_flightSchedule')->with(compact('flightSchedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlightSchedule $flightSchedule)
    {
        $data = $request->validate([
            'title' => '',
            'body' => '',
        ]);
        FlightSchedule::find($flightSchedule->id)->update($data);
        return redirect()->route('flightSchedule.show', ['id' => $flightSchedule->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlightSchedule  $flightSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlightSchedule $flightSchedule)
    {
           return $flightSchedule->delete();
    }
}

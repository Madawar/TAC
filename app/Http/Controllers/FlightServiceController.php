<?php

namespace App\Http\Controllers;

use App\Models\FlightService;
use Illuminate\Http\Request;

class FlightServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('view_flightService')->with(compact('flightServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $flightService = null;

        return view('create_flightService')->with(compact('flightService'));
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
        $flightService = FlightService::create($data);
        return redirect()->route('flightService.show', ['id' => $flightService->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlightService  $flightService
     * @return \Illuminate\Http\Response
     */
    public function show(FlightService $flightService)
    {
        return view('view_flightService')->with(compact('flightService'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlightService  $flightService
     * @return \Illuminate\Http\Response
     */
    public function edit(FlightService $flightService)
    {
        return view('create_flightService')->with(compact('flightService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlightService  $flightService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlightService $flightService)
    {
        $data = $request->validate([
            'title' => '',
            'body' => '',
        ]);
        FlightService::find($flightService->id)->update($data);
        return redirect()->route('flightService.show', ['id' => $flightService->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlightService  $flightService
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlightService $flightService)
    {
           return $flightService->delete();
    }
}

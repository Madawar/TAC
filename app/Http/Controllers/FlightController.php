<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\Flight;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('flight.view_flights');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $flight = null;
        $carriers = Carrier::all()->pluck('id', 'carrier_code');
        return view('flight.create_flight')->with(compact('flight', 'carriers'));
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
            'arrival' => 'required'

        ]);
        $flight = Flight::create($data);
        return redirect()->route('flight.show', ['id' => $flight->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show($flight)
    {
        $flight = Flight::with('carrier', 'services')->find($flight);

/*
        $pdf = PDF::setOptions(['dpi' => 150, 'defaultPaperSize' => 'a4', 'isRemoteEnabled' => true])
            ->loadView('reports.charge_sheet', compact('flight', 'image'));
        return $pdf->download('invoice.pdf');
        */
        return view('flight.view_flight')->with(compact('flight'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function edit(Flight $flight)
    {
        $carriers = Carrier::all()->pluck('carrier_code', 'id');
        return view('flight.create_flight')->with(compact('flight', 'carriers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flight $flight)
    {
        $data = $request->validate([
            'title' => '',
            'body' => '',
        ]);
        Flight::find($flight->id)->update($data);
        return redirect()->route('flight.show', ['id' => $flight->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flight $flight)
    {
        return $flight->delete();
    }
}

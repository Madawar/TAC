<?php

namespace App\Http\Controllers;

use App\Mail\FlightCompleted;
use App\Models\Carrier;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use Auth;
use Illuminate\Support\Facades\Storage;
use Haruncpi\LaravelIdGenerator\IdGenerator;

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
        $carriers = Carrier::all()->pluck('carrier_code', 'id');
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
            'arrival' => 'required',
            'STD' => 'required',
            'STA' => 'required',
            'flight_date' => 'required',
            'turnaround_type' => 'required',
            'aircraft_type' => 'required',
            'flight_type' => 'required',
            'destination' => 'required',
            'origin' => 'required',
            'flight_no' => 'required',
            'carrier_id' => 'required',
            'flight_no' => [
                function ($attribute, $value, $fail) use ($request) {
                    $existing_flights = Flight::where('flight_no', $request->flight_no)->where('flight_date', $request->flight_date)->count();
                    if ($existing_flights > 0) {
                        $fail('This Flight has already been created, please recheck');
                    }
                },
            ]

        ]);
        $flight = Flight::create($request->all());
        return redirect()->route('flight.show', ['flight' => $flight->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $flight)
    {
        $flight = Flight::with('carrier', 'services')->find($flight);
        $pdf = Storage::url('pdf/' . $flight->pdf);
        $carrier_email = $flight->carrier->carrier_email;
        if ($request->has('email')) {
            if ($request->mm != null and $request->mm != '') {
                $to = [$carrier_email, $request->mm];
            } else {
                $to = [$carrier_email];
            }

            Mail::to($to)->send(new FlightCompleted($flight));
        }
        if ($flight->pdf != null) {
            $user = Auth::user();
            $pdf_doc = PDF::setOptions(['dpi' => 150, 'defaultPaperSize' => 'a4', 'isRemoteEnabled' => true])
                ->loadView('reports.charge_sheet', compact('flight', 'user'));
            $pdf_doc->save(storage_path('app/public/pdf/' . $flight->pdf));
        }


        return view('flight.view_flight')->with(compact('flight', 'pdf'));
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
            'arrival' => 'required',
            'STD' => 'required',
            'STA' => 'required',
            'flight_date' => 'required',
            'turnaround_type' => 'required',
            'aircraft_type' => 'required',
            'flight_type' => 'required',
            'destination' => 'required',
            'origin' => 'required',
            'flight_no' => 'required',
            'carrier_id' => 'required',
        ]);
        Flight::find($flight->id)->update($request->all());
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

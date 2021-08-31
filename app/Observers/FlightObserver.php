<?php

namespace App\Observers;

use App\Models\Flight;

class FlightObserver
{
    /**
     * Handle the Flight "created" event.
     *
     * @param  \App\Models\Flight  $flight
     * @return void
     */
    public function created(Flight $flight)
    {
            /*
        if (stripos($flight->flightDate, '/') !== false) {
            $month = Carbon::createFromFormat('Y/m/d H:i', $flight->STA);
        } elseif ($flight->flightDate instanceof Carbon) {
            $month = $flight->flightDate;
        } else {
            $month = Carbon::createFromFormat('Y-m-d H:i', $flight->STA);
        }
        $startOfMonth = $month->copy()->startOfMonth();
        $count = Flight::where('flightDate', '>=', $startOfMonth)->where('flightDate', '<', $month->toDateTimeString())->where('carrier', $flight->carrier)->count();
        $sheetNo = $month->format('Ym') . str_pad($count + 1, 4, "0", STR_PAD_LEFT);
        $flight->serial = $sheetNo;
        $flight->save();
        */

    }

    /**
     * Handle the Flight "updated" event.
     *
     * @param  \App\Models\Flight  $flight
     * @return void
     */
    public function updated(Flight $flight)
    {
        //
    }

    /**
     * Handle the Flight "deleted" event.
     *
     * @param  \App\Models\Flight  $flight
     * @return void
     */
    public function deleted(Flight $flight)
    {
        //
    }

    /**
     * Handle the Flight "restored" event.
     *
     * @param  \App\Models\Flight  $flight
     * @return void
     */
    public function restored(Flight $flight)
    {
        //
    }

    /**
     * Handle the Flight "force deleted" event.
     *
     * @param  \App\Models\Flight  $flight
     * @return void
     */
    public function forceDeleted(Flight $flight)
    {
        //
    }
}

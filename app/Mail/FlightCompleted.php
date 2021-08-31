<?php

namespace App\Mail;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FlightCompleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path =  storage_path('app/public/pdf/' . $this->flight->pdf);
        //dd($path);
        $subject = 'ChargeSheet For ' . $this->flight->carrier->carrier_code . '-' . $this->flight->flight_no .' / '. Carbon::parse($this->flight->flight_date)->format('j-M-y');
        $flight = $this->flight;
        return $this->subject($subject)->view('reports.email_flight')->with(compact('flight'))->attach($path);
    }
}

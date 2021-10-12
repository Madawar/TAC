<?php

namespace App\Console\Commands;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;

class PushData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'afs:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->info('Clearing Interface Table');
        DB::connection('sqlsrv')->table('RMP_FLIGHT')->where('carrier',1)->where('flightDate', '>=', Carbon::today()->subMonth()->startOfMonth())->where('flightDate', '<=', Carbon::today()->subMonth()->endOfMonth())->delete();
        $this->info('Starting Import');
        $flights = $this->withProgressBar(Flight::with('services')->where('flight_date', '>=', Carbon::today()->subMonth()->startOfMonth())->where('flight_date', '<=', Carbon::today()->subMonth()->endOfMonth())->get(), function ($flight) {
            $this->info(' Flight' . ' ' . $flight->carrier->carrier_name . ' on ' . $flight->flight_date);
            $aircraftType = DB::connection('sqlsrv')->table('RMP_aircraftType')->where('aircraftType', $flight->aircraft_type)->first();
            if ($aircraftType) {
            } else {
                $aircraftType = DB::connection('sqlsrv')->table('RMP_aircraftType')->insertGetId(
                    array(
                        'aircraftType' => $flight->aircraft_type,
                    )
                );
            }

            $service = DB::connection('sqlsrv')->table('RMP_SERVICES')->where('description', $flight->turnaround_type)->first();
            if ($service) {
                $serviceId = $service->serviceId;
            } else {
                $service = DB::connection('sqlsrv')->table('RMP_SERVICES')->insertGetId(
                    array(
                        'description' => $flight->turnaround_type,
                    )
                );
                $serviceId = $service;
            }

            DB::connection('sqlsrv')->table('RMP_FLIGHT')->insert(
                array(
                    'carrier' => $flight->carrier->carrier_name,
                    'flightNumber' => $flight->flight_no,
                    'flightDate' => $flight->flight_date,
                    'aircraftType' => $flight->aircraft_type,
                    'serviceId' => $serviceId,
                    'org' => $flight->origin,
                    'dest' => $flight->destination,
                    'ATA' => $flight->arrival,
                    'ATD' => $flight->departure,
                    'STD' => $flight->STD,
                    'STA' => $flight->STA,
                    'aircraftRegistration' => $flight->aircraft_registration,
                    'source' => 'TAC TOOL',
                    'oper' => 'DWANYOIKE',
                    'SerialNo' => $flight->serial,
                    'datetime' => Carbon::now(),
                    'flightType' => $flight->flight_type
                )
            );

            foreach ($flight->services as $incidental) {
                $start = $incidental->start_time;
                $end = $incidental->end_time;
                if ($incidental->start == "") {
                    $start = null;
                }

                if ($incidental->end == "") {
                    $end = null;
                }
                $inc =  DB::connection('sqlsrv')->table('RMP_INCIDSERV')->where('description', $incidental->service)->first();
                DB::connection('sqlsrv')->table('RMP_ICIDSERVOFFERED')->insert(
                    array(
                        'INCid' => $inc->INCid,
                        'flightId' => $flight->id,
                        'qty' => $incidental->qty,
                        'startT' => $start,
                        'EndT' => $end,

                    )
                );
            }
        });

        return 0;
    }
}

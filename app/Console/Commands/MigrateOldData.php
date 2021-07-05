<?php

namespace App\Console\Commands;

use App\Models\Carrier;
use App\Models\Flight;
use App\Models\ServiceList;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prod:fetch';

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
        $flights =  DB::connection('prod')->table('flights')->get();
        $carriers =  DB::connection('prod')->table('carriers')->get();
        $services =  DB::connection('prod')->table('incidental_service_lists')->get();

        foreach ($carriers as $entry) {
            Carrier::create(array(
                'carrier_name' => $entry->carrier,
                'carrier_code' => $entry->carrier,
            ));
        }
        foreach ($services as $entry) {
            ServiceList::create(array(
                'description' => $entry->description,
                'remarks' => '',
                'billing_description' => $entry->REMARKS,
                'uom' => $entry->uom,
            ));
        }
        foreach ($flights as $entry) {
            Flight::create(array(
                'carrier_id' => $entry->carrier,
                'flight_no' => $entry->flightNo,
                'origin' => $entry->orig,
                'destination' => $entry->dest,
                'flight_type' => $entry->flightType,
                'aircraft_type' => $entry->aircraftType,
                'aircraft_registration' => $entry->aircraftRegistration,
                'turnaround_type' => $entry->turnaroundType,
                'flight_date' => $entry->flightDate ?? Carbon::today(),
                'arrival' => $entry->arrival,
                'departure' => $entry->departure,
                'STA' => $entry->STA ?? Carbon::today(),
                'STD' => $entry->STD ?? Carbon::today(),
                'delay_code' => $entry->delayCode,
                'remarks' => $entry->remarks,
                'serial' => $entry->serial,
            ));
        }
        return 0;
    }
}

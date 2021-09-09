<?php

namespace App\Console\Commands;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use File;
class CopySignedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flight:copy';

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
        $flights = Flight::with('carrier')->whereNotNull('signature')
            ->whereNotNull('signature_name')
            ->where('flight_date', '>=', Carbon::today()->startOfMonth()->subMonth())
            ->where('flight_date', '<=', Carbon::today())
            ->get();
        foreach ($flights as $flight) {
            $date = Carbon::parse($flight->flight_date);
            Storage::disk('shared')->makeDirectory($flight->carrier->carrier_code . '/' . $date->format('my'));
            $new_path = $flight->carrier->carrier_code . '/' . $date->format('my') . '/' . $flight->pdf;
            $copy_from = 'public/pdf/' . $flight->pdf;
            $pathSource = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($copy_from);
            $destinationPath = Storage::disk('shared')->getDriver()->getAdapter()->applyPathPrefix($new_path);
            File::copy($pathSource, $destinationPath);
        }
        return 0;
    }
}

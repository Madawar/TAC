<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Flight extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $connection = "mysql";
    use SearchTrait;

    protected $casts = [

        'signature' => 'array', // Will convarted to (Array)
    ];
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'password',
    ];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $month = Carbon::parse($model->flight_date);
            $serial = $month->format('Ym') . '/' . $model->carrier->carrier_code . '/' . $model->flight_type . '/';
            $model->serial = '';
            $model->pdf = $model->carrier->carrier_code.'_'.$model->flight_no.'_'.$month->format('md') .'_'. Str::random(4) . '.pdf';
            $cc = Counter::firstOrCreate([
                'month' => $month->month,
                'year' => $month->year,
                'carrier_id'=>$model->carrier_id
            ]);
            $cc->increment('serial');
            $model->serial = $serial.str_pad($cc->serial + 1, 4, "0", STR_PAD_LEFT);
        });
        self::retrieved(function ($model) {
            if($model->pdf == null){
                $month = Carbon::parse($model->flight_date);
                $model->pdf = $model->carrier->carrier_code.'_'.$model->flight_no.'_'.$month->format('md') .'_'. Str::random(4) . '.pdf';
                $model->save();
            }

        });
    }
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function getFlightNumberAttribute()
    {
        $date = \Carbon\Carbon::parse($this->flight_date)->format('jMy');

        return "{$this->carrier->carrier_code} {$this->flight_no} - $date";
    }
    public function services()
    {
        return $this->hasMany(FlightService::class);
    }
    /*


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


*/
}

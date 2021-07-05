<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\SearchTrait;

class Flight extends Model
{
    use HasFactory;
    use SoftDeletes;

    use SearchTrait;
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'password',
    ];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
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

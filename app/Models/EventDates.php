<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDates extends Model
{
    use HasFactory;

    protected $fillable =[
        'event_id' ,
        'time',
    ];

    public function event()
    {
        return $this->belongsTo(EventDates::class , 'event_id');
    }
}

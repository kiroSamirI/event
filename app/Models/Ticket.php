<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_number',
        'event_date_id',
        'status'
    ];

    public function eventDate()
    {
        return $this->belongsTo(EventDates::class , 'event_date_id');
    }
}

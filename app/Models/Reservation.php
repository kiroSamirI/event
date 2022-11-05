<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'age',
        'type',
        'ticket_id',
        'event_date_id',
        'refnumber',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class , 'reservation_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class , 'ticket_id');
    }
}

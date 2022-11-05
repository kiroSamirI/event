<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable =[
        'name' ,
        'date',
        'price',
        'address'
    ];

    public function eventDates(){
        return $this->hasMany(EventDates::class , 'event_id');
    }
}

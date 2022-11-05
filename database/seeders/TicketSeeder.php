<?php

namespace Database\Seeders;

use App\Models\EventDates;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = EventDates::all();
        $tikets = [];
        foreach ($events as $event){
            for ($i =1 ; $i <= 600 ;$i++){
                $tikets[] = [
                    'seat_number' => $i,
                    'event_date_id' => $event->id,

                ];
            }
        }
        Ticket::insert($tikets);

    }
}

<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventDates;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = Event::insert([[
                'name' => 'اغلي الحاجات من غير فلوس' ,
                'date' => now(),
                'price' => 60,
                'address' => 'lorem Epslom'
            ],
            [
                'name' => 'اغلي الحاجات من غير فلوس' ,
                'date' => now(),
                'price' => 60,
                'address' => 'lorem Epslom'
            ]]);

        EventDates::insert([[
            'time' => 7,
            'event_id' => 1
        ],[
            'time' => 9,
            'event_id' => 1
        ],[
            'time' =>7,
            'event_id' => 2
        ],[
            'time' =>9,
            'event_id' => 2
        ]]);
    }
}

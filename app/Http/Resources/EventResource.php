<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => str_replace( ' ' , '-' , $this->name ) . random_int(10 , 999),
            'title' => $this->name,
            "location"=> [
                "place"=> "الكاتدرائية المرقسية بالعباسية ( مسرح الانبا رويس )",
                "city"=> "العباسية، القاهرة",
                    "link"=> "https://www.google.com/maps/place/%D8%A7%D9%84%D9%83%D8%A7%D8%AA%D8%AF%D8%B1%D8%A7%D8%A6%D9%8A%D8%A9+%D8%A7%D9%84%D9%85%D8%B1%D9%82%D8%B3%D9%8A%D8%A9+%D8%A8%D8%A7%D9%84%D8%B9%D8%A8%D8%A7%D8%B3%D9%8A%D8%A9%E2%80%AD/@30.0723333,31.2776271,17z/data=!3m1!4b1!4m5!3m4!1s0x14583f9adf8a3ec9:0x56c16c299e2af96c!8m2!3d30.0723379!4d31.2749655"
                ],
            'date' => [
                'month' => "نوفمبر",
                'dayNum' => $this->id == 1 ? '10' : 11  ,
                'day' => $this->id == 1 ? 'الخميس' : "الجمعة"

            ],
            'price' => $this->price,
            'image' => "https://events.lovesoldiers.net/main.jpg",
            'shows' => EventDateResource::collection($this->eventDates)

        ];
    }
}

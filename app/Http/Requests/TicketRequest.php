<?php

namespace App\Http\Requests;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $max = $this->getTicketCount();
//        dd($max);
        return [
            'show_id' => 'required',
            'quantity' => 'required|numeric|min:1|max:' . $max,
            "tickets.name.*"=> 'required',
            "tickets.email.*"=> 'required',
            "tickets.phone.*"=> 'required',
            "tickets.age.*"=> 'required',
            "type"=> 'required',
        ];
    }

    public function getTicketCount(){
//        dd($this->show_id);
        return $max = Ticket::where( ['event_date_id'=> $this->show_id , 'status' => TicketStatus::PENDING])->count();
    }
}

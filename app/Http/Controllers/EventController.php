<?php

namespace App\Http\Controllers;

use App\Enums\PaymentMethods;
use App\Enums\TicketStatus;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\EventResource;
use App\Mail\Ticket;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket as ModelsTicket;
use App\Services\Payment\Paymob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\ExpressCheckout;

class EventController extends Controller
{
    public function index(){
        $events = Event::all();
        return EventResource::collection($events);
    }

    public function show($id){
        $event = Event::find($id);
        return new EventResource($event);
    }

    public function store(TicketRequest $request){

        $refNumber = rand(100000 , 999999999);
        info($request );
        info($refNumber);
        $tickets = DB::table('tickets')->where('status' , TicketStatus::PENDING )
            ->where('event_date_id' , $request->show_id)
            ->limit($request->quantity);//->get();

        $tickets->update(['status' => TicketStatus::UNPAIED] );
        $reservations = $this->mangeData($request->all() , $tickets->get() , $refNumber);

        $token = app(Paymob::class)->authenticate()
            ->registerOrder($refNumber , $request->amount ,$request->all() )
            ->generatePaymentKey(2984049)
            ->getPaymentKey();
      $token  = $token;
       $iframe = 694570;
      $link = "https://accept.paymob.com/api/acceptance/iframes/" .$iframe ."?payment_token=".$token;
        return response()->json([
            'link' => $link,//route('pa' ,['amount' => $request->amount]),
            200
        ]);

    }

    public function paymentSuccess(Request $request)
    {
        $request->validate([
            'marchent_order_id' => 'required'
        ]);
        info($request->marchent_order_id);

        $reservations = Reservation::where('refnumber' , $request->marchent_order_id)->get();
        foreach($reservations as $res ){
            $data = $res->toArray();
            $data['ticket'] = $res->ticket->toArray();
            $data['event_date'] = $res->ticket->eventDate->toArray();
            $data['event'] = $res->ticket->eventDate->event->toArray();
            $pdf = \PDF::loadView('ticket-mail' , $data);
            Mail::to($res->email)->send(new Ticket($pdf , $data));
        }

        return response()->json([
            null,//route('pa' ,['amount' => $request->amount]),
            200
        ]);
    }

    public function paymentFaild()
    {
        info('Your payment is canceled.');
    }

    public function success(Request $request)
    {
        $provider = new ExpressCheckout();
        $response = $provider->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Your payment was successfully.');
        }

        dd('Please try again later.');
    }

    public function paymob($amount){


        $token = app(Paymob::class)->authenticate()
            ->registerOrder(rand(100000 , 999999999) , $amount )
            ->generatePaymentKey(2984049)
            ->getPaymentKey();

//        $order->delete();

//        $order->orders()->delete();

        return view('payment', [
            'token'  => $token,
            'iframe' => 672269,//dd(PaymentMethods::iframe(672269)),
        ]);
    }


    private function mangeData($data , $tickets , $refnumber)
    {
        $reservation = [];
        foreach($data['tickets'] as $key=> $ticket){

            $ticket['type'] = $data['type'];
            $ticket['refnumber'] = $refnumber;
            $ticket['name'] = $ticket['firstName'] . $ticket['lastName'];
            $ticket['ticket_id'] = $tickets[$key]->id;
            $ticket['event_date_id'] = $data['show_id'];
            //  $ticket;
            $reser =Reservation::create($ticket);
            $reservation[] = $reser;
            $newTicket = ModelsTicket::find($tickets[$key]->id);
            $newTicket->reservation_id = $reser->id;
            $newTicket->save();
        }
        return $reservation;
    }
}

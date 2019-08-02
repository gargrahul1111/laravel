<?php

namespace App\Listeners;

use App\Events\ProductAdd;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class SendConfirmationEmail
{

    

    /**
     * Handle the event.
     *
     * @param  ProductAdd  $event
     * @return void
     */
    public function handle(ProductAdd $event)
    {

        $data = array('name' => 'Rahul Garg', 'email' => 'rgarg@practicebuilders.com', 'body' => "A new product with name $event->product->name) has been added");
        
 
        Mail::send('mails.product', $data, function($message) use ($data) {
            $message->to($data['email'])
                    ->subject('Welcome to our Website');
            $message->from('mdt@practicebuilders.com');
        });
    }
}

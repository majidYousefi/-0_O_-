<?php

namespace App\Listeners;

use App\Events\SomeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(SomeEvent $event)
    {
     //   dd($event->x);
      //mail("ochiha.itachi.mahv@gmail.com","My subject","First line of text");

        
        Mail::send('email', ['key' => 'value'], function($message) {
            $message->to('ochiha.itachi.mahv@gmail.com', 'John Smith')->subject('Welcome!');
        });


/*
 *     Mail::raw('متن ی', function($message) {
            $message->to('ochiha.itachi.mahv@gmail.com', 'John Smith')->subject('Welcome!');
        });


 * 
 * 
 */
        return -1;
    }
}

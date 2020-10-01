<?php

namespace App\Listeners;

use App\Events\PusherEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendChatEvent
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
     * @param  PusherEvent  $event
     * @return void
     */
    public function handle(PusherEvent $event)
    {
        //
    }
}

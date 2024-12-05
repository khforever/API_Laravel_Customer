<?php

namespace App\Listeners;
use App\Events\UserLoggedEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class SendWelcomeEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedEvent $event)
     {
        $user = $event->user;
      //  $details = [ 'name' => $user->name, 'email' => $user->email, ];

        Mail::to($user->email)->send(new WelcomeMail($user));



        }
}

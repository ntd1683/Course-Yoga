<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailUserRegisterNotification implements shouldQueue
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
    public function handle(UserRegisterEvent $event): void
    {
        $user = $event->user;
        Mail::send('email.register', compact('user'), function ($email) use ($user) {
            $email->subject('Manage Events - Create Account Successfully');
            $email->to($user->email, $user->name);
        });
    }
}

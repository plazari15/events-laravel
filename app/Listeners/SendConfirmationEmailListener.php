<?php

namespace App\Listeners;

use App\Events\SomeEvent;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmationEmailListener implements ShouldQueue
{
    private $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(SomeEvent $event)
    {
        $message = sprintf('Hello, %s! Sua conta foi criada com sucesso', $event->user->name);
        $this->mailer->raw($message, function ($m) use ($event){
            $m->from('falecom@pedrolazari.com');
            $m->to($event->user->email, $event->user->name);
        });
    }
}

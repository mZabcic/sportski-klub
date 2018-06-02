<?php

namespace App\Listeners;

use Brexis\LaravelWorkflow\Events\GuardEvent;
use App\Mail\ToReview;
use App\Mail\Approve;
use App\Mail\Reject;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Team;

class TransitionSubscriber
{
    /**
     * Handle workflow guard events.
     */
    public function onGuard(GuardEvent $event) {
       
    }

    /**
     * Handle workflow leave event.
     */
    public function onLeave($event) {}

    /**
     * Handle workflow transition event.
     */
    public function onTransition($event) {
        $originalEvent = $event->getOriginalEvent();
        $team = $originalEvent->getSubject();
        $transition = $originalEvent->getTransition()->getName();
        if ($transition == 'to_review') {
            Mail::to('mislav.zabcic@gmail.com')->send(new ToReview($team));
        }
        if ($transition == 'accept') {
            Mail::to('mislav.zabcic@gmail.com')->send(new Approve($team));
        }
        if ($transition == 'reject') {
            Mail::to('mislav.zabcic@gmail.com')->send(new Reject($team));
        }
    }

    /**
     * Handle workflow enter event.
     */
    public function onEnter($event) {}

    /**
     * Handle workflow entered event.
     */
    public function onEntered($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Brexis\LaravelWorkflow\Events\GuardEvent',
            'App\Listeners\TransitionSubscriber@onGuard'
        );

        $events->listen(
            'Brexis\LaravelWorkflow\Events\LeaveEvent',
            'App\Listeners\TransitionSubscriber@onLeave'
        );

        $events->listen(
            'Brexis\LaravelWorkflow\Events\TransitionEvent',
            'App\Listeners\TransitionSubscriber@onTransition'
        );

        $events->listen(
            'Brexis\LaravelWorkflow\Events\EnterEvent',
            'App\Listeners\TransitionSubscriber@onEnter'
        );

        $events->listen(
            'Brexis\LaravelWorkflow\Events\EnteredEvent',
            'App\Listeners\TransitionSubscriber@onEntered'
        );
    }

}
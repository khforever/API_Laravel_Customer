<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserLoginObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
  use App\Events\UserLoggedEvent;
  use App\Listeners\SendWelcomeEmailListener;
//use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     protected $listen = [ UserLoggedEvent::class => [ SendWelcomeEmailListener::class, ], ];



    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

      parent::boot();

    }




}

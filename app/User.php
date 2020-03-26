<?php

namespace App;

use App\Events\UserEvent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => UserEvent::class
    ];
}

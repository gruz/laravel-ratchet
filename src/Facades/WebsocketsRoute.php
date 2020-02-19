<?php

namespace Askedio\LaravelRatchet\Facades;

use Illuminate\Support\Facades\Facade;

class WebSocketsRoute extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ratchet.router';
    }
}

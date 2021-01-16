<?php

namespace Askedio\LaravelRatchet\Facades;

use Illuminate\Support\Facades\Facade;

class WebsocketsRoute extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ratchet.router';
    }
}

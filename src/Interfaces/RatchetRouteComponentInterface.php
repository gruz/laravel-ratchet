<?php

namespace Askedio\LaravelRatchet\Interfaces;

use Ratchet\WebSocket\MessageComponentInterface;

interface RatchetRouteComponentInterface extends MessageComponentInterface {

	function onEntry($entry);

	function boot();

	function setConsole($console);
}
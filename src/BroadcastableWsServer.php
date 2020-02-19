<?php

namespace Askedio\LaravelRatchet;

use Ratchet\WebSocket\WsServer;
use Ratchet\ComponentInterface;

class BroadcastableWsServer extends WsServer
{
	private $component;

	public function __construct(ComponentInterface $component) {
		parent::__construct($component);
		$this->component = $component;
	}

	public function onEntry($entry)
	{
		$this->component->onEntry($entry);
	}
}
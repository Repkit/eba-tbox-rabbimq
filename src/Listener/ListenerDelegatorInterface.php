<?php

namespace TBoxRabbitMQ\Listener;

interface ListenerDelegatorInterface
{
	public function delegate($e);
	public function getSupervisedEventsName($target);
    public function getBlacklistedControllers();
}
<?php

namespace TBoxRabbitMQ\Message;

class AMQPMessageBodyContent extends AbstractEntity
{
	public function __construct($Data)
	{
		$this->hydrate($Data);
	}
}
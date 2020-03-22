<?php
namespace TBoxRabbitMQ\Message;

class AMQPMessageFactory
{
	public function __invoke($services)
    {
        // get config
    	/*$config = $services->get('config');

    	$settings = array();
    	if(!empty($config['rabbitmq_strategy'])){
    		$settings = $config['rabbitmq_strategy'];
    	}*/

        return new AMQPMessage();
    }
}
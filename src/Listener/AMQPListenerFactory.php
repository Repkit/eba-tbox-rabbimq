<?php
namespace TBoxRabbitMQ\Listener;

class AMQPListenerFactory
{
	public function __invoke($services)
    {
        // get config
    	$config = $services->get('config');

    	$settings = array();
    	if(!empty($config['rabbitmq_strategy'])){
    		$settings = $config['rabbitmq_strategy'];
    	}

        $connection = $services->get('TBoxRabbitMQ\Connection\AMQPConnection');

        return new AMQPListener($connection, $settings);
    }
}
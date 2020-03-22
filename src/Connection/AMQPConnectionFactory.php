<?php
namespace TBoxRabbitMQ\Connection;

class AMQPConnectionFactory
{
	public function __invoke($services)
    {
        // get config
    	$config = $services->get('config');

    	$settings = array();
    	if(!empty($config['tbox_amqp'])){
    		$settings = $config['tbox_amqp'];
    	}

    	if(!empty($settings['server'])){
            $cdata = $settings['server'];
        }elseif(!empty($config['amqp']['server'])){
            $cdata = $config['amqp']['server'];
        }else{
            throw new \Exception("Could not gather rabbitmq connection data", 1);
        }
        

        return new AMQPConnection($cdata['host'], $cdata['port'], $cdata['username'], $cdata['password']);
    }
}
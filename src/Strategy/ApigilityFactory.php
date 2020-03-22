<?php
namespace TBoxRabbitMQ\Strategy;

class ApigilityFactory
{
    public function __invoke($services)
    {
        // get config
        /*$config = $services->get('config');

        $settings = array();
        if(!empty($config['rabbitmq_strategy'])){
            $settings = $config['rabbitmq_strategy'];
        }*/

        $listener = $services->get('TBoxRabbitMQ\Listener\ListenerDelegator');
        $listener->setType(\TBoxRabbitMQ\Listener\ListenerDelegator::TYPE_APIGILITY);

        return new Apigility($listener);
    }
}

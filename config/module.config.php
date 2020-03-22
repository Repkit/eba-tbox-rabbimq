<?php
return [
    'service_manager' => [
        'factories' => [
            \TBoxRabbitMQ\Strategy\Strategy::class => \TBoxRabbitMQ\Strategy\ApigilityFactory::class,
            \TBoxRabbitMQ\Listener\AMQPListener::class => \TBoxRabbitMQ\Listener\AMQPListenerFactory::class,
            \TBoxRabbitMQ\Listener\ListenerDelegator::class => \TBoxRabbitMQ\Listener\ListenerDelegatorFactory::class,
            \TBoxRabbitMQ\Connection\AMQPConnection::class => \TBoxRabbitMQ\Connection\AMQPConnectionFactory::class,
            \TBoxRabbitMQ\Message\AMQPMessage::class => \TBoxRabbitMQ\Message\AMQPMessageFactory::class,
        ],
    ],
];
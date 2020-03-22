<?php
namespace TBoxRabbitMQ\Listener;

use PhpAmqpLib\Connection\AbstractConnection;
use PhpAmqpLib\Channel\AbstractChannel;
use TBoxRabbitMQ\Message\AMQPMessage as AMQPMessage;


class AMQPListener
{
	private $_connection;
	private $_settings;

	public function __construct(AbstractConnection $Connection, $Settings = array())
	{
		$this->_connection = $Connection;
		$this->_settings = $Settings;
	}

	public function emit(AMQPMessage $Message)
	{
		$namespace = $Message->body->getHead()->getNamespace();
		$channel = $this->declareExchange($this->_connection->channel(), $namespace);

		$messageBody = $Message->body;
		$amqpcfg = $messageBody->getHead()->getAMQPCofig();
		$message = $Message;
		$message->body = json_encode($messageBody);
		$routingkey = $amqpcfg->getRoutingKey();
        $mandatory = $amqpcfg->getMandatory();
        $immediate = $amqpcfg->getImmediate();
        $ticket = $amqpcfg->getTicket();

		$channel->basic_publish($message, $namespace, $routingkey, $mandatory, $immediate, $ticket);
		$channel->close();
		$this->_connection->close();
	}

	private function declareExchange(AbstractChannel $channel, $ExchangeName)
	{
		$exchangeSettings = $this->_settings['exchanges']['default'];
		if( !empty($this->_settings['exchanges']['namespaces'][$ExchangeName]) ){
			$exchangeSettings = array_merge($exchangeSettings, $this->_settings['exchanges']['namespaces'][$ExchangeName]);
		}
		$channel->exchange_declare(
			$ExchangeName,
			$exchangeSettings['type'], 
			$exchangeSettings['passive'], 
			$exchangeSettings['durable'], 
			$exchangeSettings['auto_delete'], 
			$exchangeSettings['internal'], 
			$exchangeSettings['nowait'], 
			$exchangeSettings['arguments'], 
			$exchangeSettings['ticket']
		);

		return $channel;
	}
	
}
<?php
namespace TBoxRabbitMQ\Message;

interface AMQPMessageBodyInterface
{
	public function getHead();
	public function setHead(AMQPMessageBodyHead $Head);
	
	public function getContent();
	public function setContent(AMQPMessageBodyContent $Content);

}
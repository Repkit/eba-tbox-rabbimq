<?php
namespace TBoxRabbitMQ\Message\Apigility;

use TBoxRabbitMQ\Message\AMQPMessageBodyContent;
use JsonSerializable;

class MessageBodyContent extends AMQPMessageBodyContent
{

	private $_ignoredKeys = array('resource', 'collection', 'options');
    private $_ignoredValueTypes = array('ZF\Hal\Collection');

	public function __construct($Data)
	{
        //var_dump(get_class($Data));
		$this->hydrate($Data);
	}

	public function exchangeArray(array $Input)
	{
		$data = array();
		foreach ($Input as $key => $value) 
		{
			if(in_array($key, $this->_ignoredKeys) || is_object($value) && in_array(get_class($value), $this->_ignoredValueTypes)) {
				continue;
			} elseif('entity' == $key) {
				// TODO: get an array from the entity depending on which method is avail
				$entity = $value->getEntity();
				if( is_object($entity) )
				{
			        if ($entity instanceof JsonSerializable) {
			            $entity = $entity->jsonSerialize();
			        }else{
			        	$entity = get_object_vars($entity);
			        }
				}
				$data[$key] = $entity;
			}else {
				// usually post/put data parameter
				$data[$key] = $value;
			}
		}

		parent::exchangeArray($data);
        return $this;
	}
}
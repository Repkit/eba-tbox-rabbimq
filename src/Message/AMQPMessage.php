<?php
namespace TBoxRabbitMQ\Message;

use PhpAmqpLib\Message\AMQPMessage as lib_AMQPMessage;

class AMQPMessage extends lib_AMQPMessage implements \JsonSerializable
{

	/*protected static $PROPERTIES = array(
        "content_type" => "shortstr",
        "content_encoding" => "shortstr",
        "application_headers" => "table",
        "delivery_mode" => "octet",
        "priority" => "octet",
        "correlation_id" => "shortstr",
        "reply_to" => "shortstr",
        "expiration" => "shortstr",
        "message_id" => "shortstr",
        "timestamp" => "timestamp",
        "type" => "shortstr",
        "user_id" => "shortstr",
        "app_id" => "shortstr",
        "cluster_id" => "shortstr"
    );*/

	/**
     * @param event $e
     * @param array $properties
     */
    public function __construct($e, $properties = array(), $body = null)
    {  
        if( empty($body) )
        {
            $ename = $e->getName();
            $app = new AMQPMessageBodyHeadApplication($ename);
            $config = new AMQPMessageBodyHeadConfig($ename);

            $head = new AMQPMessageBodyHead($ename, $ename, $ename, $ename, $app, $config);

            $content = new AMQPMessageBodyContent();
        	$body = new AMQPMessageBody($head, $content);
        }

    	parent::__construct($body, $properties);
    }

    /**
     * Return json representation
     * @return string
     */
    public function jsonSerialize()
    {
        $array = array(
            'properties' => $this->get_properties(),
            'body' => $this->getBody(),
            'body_size' => $this->getBodySize(),
            'is_truncated' => $this->isTruncated(),
            'content_encoding' => $this->getContentEncoding(),
            'delivery_info' => $this->delivery_info,

        );
        
        return $array;
    }

}
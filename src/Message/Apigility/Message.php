<?php
namespace TBoxRabbitMQ\Message\Apigility;

use TBoxRabbitMQ\Message\AMQPMessage as lib_AMQPMessage;

class Message extends lib_AMQPMessage
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
    public function __construct($e, $properties = array())
    {
        $ename = $e->getName();
        $target = $e->getTarget();
        $route = $target->getEvent()->getRouteMatch()->getMatchedRouteName();
        $routeParams = $target->getEvent()->getRouteMatch()->getParams();
        $microice = explode('.', $route);
        $ns = reset($microice);
        $version = $routeParams['version'] ? $routeParams['version'] : 0;
        $type = $microice[1];
        //$service = reset($microice);
        $service = $microice[2];

        $app = new MessageBodyHeadApplication($ns, $version, $type, $service, $routeParams);

        $mandatory = false;
        $immediate = false;
        $ticket = null;
        $name = $route.'_'.$ename;
        $config = new MessageBodyHeadConfig($name, $mandatory, $immediate, $ticket);

        $head = new MessageBodyHead($name, $route, $ename, $ns, $app, $config);

        $head->setServer($_SERVER);
        if(!empty($target))
        {
            $request = $target->getRequest();
            $http = array(
                'headers' => $request->getHeaders()->toArray(),
                'method'  => $request->getMethod(),
                'uri'     => $request->getUriString(),
                'query'   => $request->getQuery()->toArray(),
                'files'   => $request->getFiles()->toArray(),
            );
            $head->setHttp($http);
            
        }

        $content = new MessageBodyContent($e->getParams());

        $body = new MessageBody($head, $content);
    	parent::__construct($e, $properties, $body);
    }

}
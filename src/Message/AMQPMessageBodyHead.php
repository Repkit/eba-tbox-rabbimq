<?php

namespace TBoxRabbitMQ\Message;

class AMQPMessageBodyHead extends AbstractEntity
{

    /*mandatories*/
	protected $Name;
	protected $Route;
	protected $Event;
    protected $Namespace;
    protected $Application;
    protected $AMQPCofig;

    /*optionals*/
	public $Http;
	public $Server;
    
    public function __construct($Name, $Route, $Event, $Namespace, AMQPMessageBodyHeadApplication $Application, AMQPMessageBodyHeadConfig $AMQPCofig)
    {
        $this->Name = $Name;
        $this->Route = $Route;
        $this->Event = $Event;
        $this->Namespace = $Namespace;
        $this->Application = $Application;
        $this->AMQPCofig = $AMQPCofig;
    }

    public function getArrayCopy()
    {
        return array(
            'Name' => $this->Name,
            'Route' => $this->Route,
            'Event' => $this->Event,
            'Namespace' => $this->Namespace,
            'Application' => $this->Application->getArrayCopy(),
            'AMQPCofig' => $this->AMQPCofig->getArrayCopy(),
            'Http' => $this->Http,
            'Server' => $this->Server
        );
    }

    /**
    * Gets the value of Name.
    *
    * @return mixed
    */
    public function getName()
    {
        return $this->Name;
    }
 
    /**
    * Sets the value of Name.
    *
    * @param mixed $Name the name
    *
    * @return self
    */
    public function setName($Name)
    {
        $this->Name = $Name;
    }
 
    /**
    * Gets the value of Route.
    *
    * @return mixed
    */
    public function getRoute()
    {
        return $this->Route;
    }
 
    /**
    * Sets the value of Route.
    *
    * @param mixed $Route the route
    *
    * @return self
    */
    public function setRoute($Route)
    {
        $this->Route = $Route;
    }
 
    /**
    * Gets the value of Event.
    *
    * @return mixed
    */
    public function getEvent()
    {
        return $this->Event;
    }
 
    /**
    * Sets the value of Event.
    *
    * @param mixed $Event the event
    *
    * @return self
    */
    public function setEvent($Event)
    {
        $this->Event = $Event;
    }
 
    /**
    * Gets the value of Http.
    *
    * @return mixed
    */
    public function getHttp()
    {
        return $this->Http;
    }
 
    /**
    * Sets the value of Http.
    *
    * @param mixed $Http the http
    *
    * @return self
    */
    public function setHttp($Http)
    {
        $this->Http = $Http;
    }
 
    /**
    * Gets the value of Server.
    *
    * @return mixed
    */
    public function getServer()
    {
        return $this->Server;
    }
 
    /**
    * Sets the value of Server.
    *
    * @param mixed $Server the server
    *
    * @return self
    */
    public function setServer($Server)
    {
        $this->Server = $Server;
    }
 
    /**
    * Gets the value of Namespace.
    *
    * @return mixed
    */
    public function getNamespace()
    {
        return $this->Namespace;
    }
 
    /**
    * Sets the value of Namespace.
    *
    * @param mixed $Namespace the namespace
    *
    * @return self
    */
    public function setNamespace($Namespace)
    {
        $this->Namespace = $Namespace;
    }
 
    /**
    * Gets the value of Application.
    *
    * @return mixed
    */
    public function getApplication()
    {
        return $this->Application;
    }
 
    /**
    * Sets the value of Application.
    *
    * @param mixed $Application the application
    *
    * @return self
    */
    public function setApplication(AMQPMessageBodyHeadApplication $Application)
    {
        $this->Application = $Application;
    }
 
    /**
    * Gets the value of AMQPCofig.
    *
    * @return mixed
    */
    public function getAMQPCofig()
    {
        return $this->AMQPCofig;
    }
 
    /**
    * Sets the value of AMQPCofig.
    *
    * @param mixed $AMQPCofig the pcofig
    *
    * @return self
    */
    public function setAMQPCofig(AMQPMessageBodyHeadConfig $AMQPCofig)
    {
        $this->AMQPCofig = $AMQPCofig;
    }
}
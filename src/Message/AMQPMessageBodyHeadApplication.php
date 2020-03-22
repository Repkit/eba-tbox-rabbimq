<?php

namespace TBoxRabbitMQ\Message;

class AMQPMessageBodyHeadApplication extends AbstractEntity
{
    public $Name;// application name
    public $Version;// application version
    public $Type;// application type rest, rpc etc...
    public $Service; // service or module
    public $RouteMatchedParams; // route matched params

    public function __construct($Name, $Version = null, $Type = null, $Service = null, $RouteMatchedParams = array())
    {
        $this->Name = $Name;
        $this->Version = $Version;
        $this->Type = $Type;
        $this->Service = $Service;
        $this->RouteMatchedParams = $RouteMatchedParams;
    }
    
    public function getArrayCopy()
    {
        return array(
            'Name' => $this->Name,
            'Version' => $this->Version,
            'Type' => $this->Type,
            'Service' => $this->Service,
            'RouteMatchedParams' => $this->RouteMatchedParams,
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
    * Gets the value of Version.
    *
    * @return mixed
    */
    public function getVersion()
    {
        return $this->Version;
    }
 
    /**
    * Sets the value of Version.
    *
    * @param mixed $Version the version
    *
    * @return self
    */
    public function setVersion($Version)
    {
        $this->Version = $Version;
    }
 
    /**
    * Gets the value of Type.
    *
    * @return mixed
    */
    public function getType()
    {
        return $this->Type;
    }
 
    /**
    * Sets the value of Type.
    *
    * @param mixed $Type the type
    *
    * @return self
    */
    public function setType($Type)
    {
        $this->Type = $Type;
    }
 
    /**
    * Gets the value of Service.
    *
    * @return mixed
    */
    public function getService()
    {
        return $this->Service;
    }
 
    /**
    * Sets the value of Service.
    *
    * @param mixed $Service the service
    *
    * @return self
    */
    public function setService($Service)
    {
        $this->Service = $Service;
    }
 
    /**
    * Gets the value of RouteMatchedParams.
    *
    * @return mixed
    */
    public function getRouteMatchedParams()
    {
        return $this->RouteMatchedParams;
    }
 
    /**
    * Sets the value of RouteMatchedParams.
    *
    * @param mixed $RouteMatchedParams the route matched params
    *
    * @return self
    */
    public function setRouteMatchedParams($RouteMatchedParams)
    {
        $this->RouteMatchedParams = $RouteMatchedParams;

        return $this;
    }
}
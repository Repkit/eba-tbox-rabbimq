<?php

namespace TBoxRabbitMQ\Message;

class AMQPMessageBodyHeadConfig extends AbstractEntity
{
	public $RoutingKey;
    public $Mandatory = false;
    public $Immediate = false;
    public $Ticket = null;

    public function __construct($RoutingKey, $Mandatory = false, $Immediate = false, $Ticket = null)
    {
        $this->RoutingKey = $RoutingKey;
        $this->Mandatory = $Mandatory;
        $this->Immediate = $Immediate;
        $this->Ticket = $Ticket;
    }
 
    public function getArrayCopy()
    {
        return array(
            'RoutingKey' => $this->RoutingKey,
            'Mandatory' => $this->Mandatory,
            'Immediate' => $this->Immediate,
            'Ticket' => $this->Ticket
        );
    }

    /**
    * Gets the value of RoutingKey.
    *
    * @return mixed
    */
    public function getRoutingKey()
    {
        return $this->RoutingKey;
    }
 
    /**
    * Sets the value of RoutingKey.
    *
    * @param mixed $RoutingKey the routing key
    *
    * @return self
    */
    public function setRoutingKey($RoutingKey)
    {
        $this->RoutingKey = $RoutingKey;
    }
 
    /**
    * Gets the value of Mandatory.
    *
    * @return mixed
    */
    public function getMandatory()
    {
        return $this->Mandatory;
    }
 
    /**
    * Sets the value of Mandatory.
    *
    * @param mixed $Mandatory the mandatory
    *
    * @return self
    */
    public function setMandatory($Mandatory)
    {
        $this->Mandatory = $Mandatory;
    }
 
    /**
    * Gets the value of Immediate.
    *
    * @return mixed
    */
    public function getImmediate()
    {
        return $this->Immediate;
    }
 
    /**
    * Sets the value of Immediate.
    *
    * @param mixed $Immediate the immediate
    *
    * @return self
    */
    public function setImmediate($Immediate)
    {
        $this->Immediate = $Immediate;
    }
 
    /**
    * Gets the value of Ticket.
    *
    * @return mixed
    */
    public function getTicket()
    {
        return $this->Ticket;
    }
 
    /**
    * Sets the value of Ticket.
    *
    * @param mixed $Ticket the ticket
    *
    * @return self
    */
    public function setTicket($Ticket)
    {
        $this->Ticket = $Ticket;
    }
}
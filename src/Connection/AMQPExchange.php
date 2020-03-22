<?php
namespace TBoxRabbitMQ\Connection;

use PhpAmqpLib\Channel\AbstractChannel;

class AMQPExchange
{
	private $_channel;

	public $Name;
	public $Type = 'topic';
	public $Passive = false;
    public $Durable = false;
    public $AutoDelete = true;
    public $Internal = false;
    public $NoWait = false;
    public $Arguments = array();
    public $Ticket = null;


    public function __construct(AbstractChannel $Channel, $Config = array())
    {
    	$this->_channel = $Channel;

    }

    public function basicPublish($msg,
        $exchange = '',
        $routing_key = '',
        $mandatory = false,
        $immediate = false,
        $ticket = null)
    {
    	$this->_channel->basic_publish($msg, $this->Name);
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
    * Gets the value of Passive.
    *
    * @return mixed
    */
    public function getPassive()
    {
        return $this->Passive;
    }
 
    /**
    * Sets the value of Passive.
    *
    * @param mixed $Passive the passive
    *
    * @return self
    */
    public function setPassive($Passive)
    {
        $this->Passive = $Passive;
    }
 
    /**
    * Gets the value of Durable.
    *
    * @return mixed
    */
    public function getDurable()
    {
        return $this->Durable;
    }
 
    /**
    * Sets the value of Durable.
    *
    * @param mixed $Durable the durable
    *
    * @return self
    */
    public function setDurable($Durable)
    {
        $this->Durable = $Durable;
    }
 
    /**
    * Gets the value of AutoDelete.
    *
    * @return mixed
    */
    public function getAutoDelete()
    {
        return $this->AutoDelete;
    }
 
    /**
    * Sets the value of AutoDelete.
    *
    * @param mixed $AutoDelete the auto delete
    *
    * @return self
    */
    public function setAutoDelete($AutoDelete)
    {
        $this->AutoDelete = $AutoDelete;
    }
 
    /**
    * Gets the value of Internal.
    *
    * @return mixed
    */
    public function getInternal()
    {
        return $this->Internal;
    }
 
    /**
    * Sets the value of Internal.
    *
    * @param mixed $Internal the internal
    *
    * @return self
    */
    public function setInternal($Internal)
    {
        $this->Internal = $Internal;
    }
 
    /**
    * Gets the value of NoWait.
    *
    * @return mixed
    */
    public function getNoWait()
    {
        return $this->NoWait;
    }
 
    /**
    * Sets the value of NoWait.
    *
    * @param mixed $NoWait the no wait
    *
    * @return self
    */
    public function setNoWait($NoWait)
    {
        $this->NoWait = $NoWait;
    }
 
    /**
    * Gets the value of Arguments.
    *
    * @return mixed
    */
    public function getArguments()
    {
        return $this->Arguments;
    }
 
    /**
    * Sets the value of Arguments.
    *
    * @param mixed $Arguments the arguments
    *
    * @return self
    */
    public function setArguments($Arguments)
    {
        $this->Arguments = $Arguments;
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
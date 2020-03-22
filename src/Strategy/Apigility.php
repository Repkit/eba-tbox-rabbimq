<?php
namespace TBoxRabbitMQ\Strategy;

use TBoxRabbitMQ\Strategy\Listener\AMQPListener;
use TBoxRabbitMQ\Listener\ListenerDelegatorInterface;

class Apigility extends Strategy
{

	private $_delegator;
    private $_listeners = array();

    protected $target = 'ZF\Rest\RestController';
	protected $priority = PHP_INT_MIN; //lowest priority possible


	public function __construct(ListenerDelegatorInterface $ListenerDelegator)
	{
		$this->_delegator = $ListenerDelegator;
	}

	public function attach($e, $RouteController)
	{
        try 
        {
            $blacklist = $this->_delegator->getBlacklistedControllers();
            if (!empty($blacklist) && is_array($blacklist) && in_array($RouteController, $blacklist)) {
                return;
            }
            
            $events = $this->_delegator->getSupervisedEventsName($this->target);
            if(!empty($events))
            {
                $sharedManager = $e->getSharedManager();
                foreach ($events as $key => $event) {
                    $this->_listeners[] = $sharedManager->attach($this->target, $event, array($this->_delegator,'delegate'), $this->priority);
                } 
            }

        } 
        catch (\Exception $finalex) 
        {
            // TODO: add logger
            return;
        }
        
	}

    public function detach($e)
    {
        if(!empty($this->_listeners))
        {
            $sharedManager = $e->getSharedManager();

            foreach ($this->_listeners as $index => $listener) {
                $sharedManager->detach($listener);
                unset($this->listeners[$index]);
            }
        }
    }

    
    /**
    * Sets the value of target.
    *
    * @param mixed $target the target
    *
    * @return self
    */
    public function setTarget($target)
    {
        $this->target = $target;
    }
 
    /**
    * Sets the value of event.
    *
    * @param mixed $event the event
    *
    * @return self
    */
    public function setEvents($events)
    {
        $this->events = $events;
    }
 
    /**
    * Sets the value of priority.
    *
    * @param mixed $priority the priority
    *
    * @return self
    */
    public function setPriority($priority)
    {
        $this->priority = intval($priority);
    }
}
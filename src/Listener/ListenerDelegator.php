<?php
namespace TBoxRabbitMQ\Listener;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

use TBoxRabbitMQ\Message\AMQPMessage;
use TBoxRabbitMQ\Message\Apigility\Message as ApigilityMessage;
use TBoxRabbitMQ\Message\Expressive\Message as ExpressiveMessage;

class ListenerDelegator implements ListenerDelegatorInterface
{

	const TYPE_APIGILITY = 'apigility';
	const TYPE_EXPRESSIVE = 'expresive';

	private $_config;
	private $_container;
	private $_logger;

	protected $Type;

	public function __construct(ContainerInterface $container, array $config)
	{
		$this->_config = $config;
		$this->_container = $container;
	}
	
	public function delegate($e)
	{
		try 
		{
			$start = microtime(true);
			$listeners = $this->getListeners($e);
			if(empty($listeners)){
				return;
			}
			foreach ($listeners as $listener => $lconfig) 
			{
				$callback = $lconfig['callback'];
				if(empty($callback)){
					continue;
				}

				if(!$lconfig['async'])
				{
					if(!$this->_container->has($listener)){
						continue;
					}
					$lclass = $this->_container->get($listener);

					// initiate new AMQP message
					$message = $this->getMessage($e);
					if(!empty($message))
					{
						$message = $this->domainName($message);

						//config msg
						if(!empty($lconfig['publish'])){
							$message = $this->updateMessagePublishConfig($message, $lconfig['publish']);
						}

						try {
							call_user_func_array(array($lclass, $callback), array($message));
						} catch (\Exception $ex) {
							$this->getLogger()->error($ex->getMessage());
							continue;
						}
					}
				}
				else
				{
					//TODO: 
					/*
					* - write to disk message
					* - generate config file for connection / channel settings / routing key
					*/
				}
			}
			$end = microtime(true);
		} 
		catch (\Exception $finalex) 
		{
			$this->getLogger()->error($finalex->getMessage());
			return;
		}
		
	}

	public function getSupervisedEventsName($target)
	{
		$events = array();
		if(!empty($target))
		{
			$supervisedEvents = $this->getSupervisedEvents($target);

			if(!empty($supervisedEvents) && is_array($supervisedEvents)){
				$events = array_keys($supervisedEvents);
			}
		}

		return $events;
	}
    
    public function getBlacklistedControllers()
    {
		$strategy = $this->_config[$this->Type];
		if(empty($strategy)){
			throw new \Exception("Invalid strategy", 1);
		}
		$blacklist = $strategy['black_list'];
        return $blacklist;
    }

	protected function getListeners($e)
	{
		$events = array();
		$supervisedEvents = $this->getSupervisedEvents($e->getTarget());

		if(!empty($supervisedEvents) && is_array($supervisedEvents))
		{
			$events = $supervisedEvents[$e->getName()];
			if(empty($events)){
				throw new \Exception("Invalid event", 1);
			}
			// sort by priority
			uasort($events,function ($a ,$b){
				$x = $a['priority'];
				$y = $b['priority'];
				if ( $x == $y) {
			        return 0;
			    }
			    // return ($x < $y) ? -1 : 1;
			    return ($x < $y) ? 1 : -1; // order in reverse order higher to lower
			});
		}
		
		return $events;

	}

	protected function getSupervisedEvents($target)
	{
		if( is_object($target) ){
			$target = get_class($target);
		}
		if(empty($this->Type)){
			throw new \Exception("Invalid type", 1);
		}

		$strategy = $this->_config[$this->Type];
		if(empty($strategy)){
			throw new \Exception("Invalid strategy", 1);
		}

		$strategyTarget = $strategy['target'][$target];
		if(empty($strategyTarget)){
			throw new \Exception("Invalid target", 1);
		}

		// validate if it's excluded target
		//TODO:

		$events = $strategyTarget['events'];

		return $events;
	}

	protected function getMessage($e)
	{
		switch ($this->Type) 
		{
			case self::TYPE_APIGILITY:
				$msg = new ApigilityMessage($e);
				break;

			/*case self::TYPE_EXPRESSIVE:
				$msg = new ExpressiveMessage($e);
				break;*/
			
			default:
				$msg = new AMQPMessage($e);
				break;
		}

		return $msg;
	}

	// give a domain driven desing name
	public function domainName(AMQPMessage $Message)
	{
		// if( !empty( $this->_config[$this->Type] ) )
		// {
		// 	$cfg = $this->_config[$this->Type];
			$cfg = $this->_config;
			$route = $Message->getBody()->getHead()->getRoute();
			if(!empty($route))
			{
				$eventName = $Message->getBody()->getHead()->getEvent();
				if(!empty($eventName))
				{
					if(!empty($cfg['ddd_route_event_names']))
					{
						if(!empty($cfg['ddd_route_event_names'][$route]))
						{
							if(!empty($cfg['ddd_route_event_names'][$route][$eventName]))
							{
								$dname = $cfg['ddd_route_event_names'][$route][$eventName];
								$Message->getBody()->getHead()->setName($dname);
							}
						}
					}
				}
			}
		// }

		return $Message;
	}

	public function updateMessagePublishConfig($Message, $Config)
	{
		$amqpcfg = $Message->getBody()->getHead()->getAMQPCofig();

		$mandatory = $Config['mandatory'] ? $Config['mandatory'] : null;
		if(null != $mandatory){
			$amqpcfg->setMandatory(boolval($mandatory));
		}

		$immediate = $Config['immediate'] ? $Config['immediate'] : null;
		if(null != $immediate){
			$amqpcfg->setImmediate(boolval($immediate));
		}

		$ticket = $Config['ticket'] ? $Config['ticket'] : null;
		if(null != $immediate){
			$amqpcfg->setTicket($ticket);
		}

		$Message->getBody()->getHead()->setAMQPCofig($amqpcfg);
		
		return $Message;
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
    * Gets the value of _logger.
    *
    * @return mixed
    */
    public function getLogger()
    {
    	if(!isset($this->_logger)){
    		$this->_logger = new NullLogger(); 
    	}
        return $this->_logger;
    }
 
    /**
    * Sets the value of _logger.
    *
    * @param mixed $_logger the logger
    *
    * @return self
    */
    public function setLogger(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }
}
<?php
namespace TBoxRabbitMQ\Message;


class AMQPMessageBody extends AbstractEntity implements AMQPMessageBodyInterface
{

    private $Head;
    private $Content;

	public function __construct(AMQPMessageBodyHead $Head, AMQPMessageBodyContent $Content)
	{
        $this->Head = $Head;
		$this->Content = $Content;
	}

    public function getArrayCopy()
    {
        return array(
            'Head' => $this->Head->getArrayCopy(),
            'Content' => $this->Content->getArrayCopy()
        );
    }

	/*public function hydrate($e)
    {
        $head = new AMQPMessageBodyHead();
        $head->Server = $_SERVER;
        $head->hydrate($e);
        $this->setHead($head);
        
    	$content = new AMQPMessageBodyContent($e);
    	$this->setContent($content);

        return $this;
    }*/

    /**
    * Gets the value of Head.
    *
    * @return mixed
    */
    public function getHead()
    {
        return $this->Head;
    }
 
    /**
    * Sets the value of Head.
    *
    * @param mixed $Head the head
    *
    * @return self
    */
    public function setHead(AMQPMessageBodyHead $Head)
    {
        $this->Head = $Head;
    }
 
    /**
    * Gets the value of Content.
    *
    * @return mixed
    */
    public function getContent()
    {
        return $this->Content;
    }
 
    /**
    * Sets the value of Content.
    *
    * @param mixed $Content the content
    *
    * @return self
    */
    public function setContent(AMQPMessageBodyContent $Content)
    {
        $this->Content = $Content;
    }
}
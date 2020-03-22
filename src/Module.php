<?php
namespace TBoxRabbitMQ;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
        // perform attachments at EVENT_ROUTE in order to retrieve the current controller to perform blacklisting
        $e->getApplication()->getEventManager()->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE,
            function($e) {
                $em = $e->getApplication()->getEventManager();
                $sm = $e->getApplication()->getServiceManager();
                $strategy = $sm->get(\TBoxRabbitMQ\Strategy\Strategy::class);
                $strategy->attach($em, $e->getRouteMatch()->getParam('controller'));
            }
         );
    }
}

<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SONRest;


use SONRest\Service\ProcessJson;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);



        $sharedEvents = $e->getApplication()->getEventManager()->getSharedManager();

        $sharedEvents->attach(
            'Zend\Mvc\Controller\AbstractRestfulController',
            MvcEvent::EVENT_DISPATCH,
            array($this, 'postProcess'), -100);
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'SONRest\Service\ProcessJson' => function ($sm) {
                    return new ProcessJson(null, null, $sm->get('jms_serializer.serializer'));

                }

            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
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

    public function postProcess(MvcEvent $e)
    {
        $processJson = $e->getTarget()->getServiceLocator()->get('SONRest\Service\ProcessJson');
        $data = $e->getResult();
        if (!$data instanceof \Zend\View\Model\ViewModel) {
            $response = new \Zend\Http\Response();

            $processJson->setResponse($response);
            $processJson->setData($data);

            return $processJson->process();
        }
    }
}
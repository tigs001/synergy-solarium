<?php

namespace SynergySolarium;

use Laminas\ModuleManager\Feature\AutoloaderProviderInterface;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\ModuleManagerInterface;

class Module implements InitProviderInterface, AutoloaderProviderInterface, ConfigProviderInterface
{
    public function init(ModuleManagerInterface $manager)
    {
        $eventManager = $manager->getEventManager();
        $eventManager->attach('profiler_init', function() use ($manager) {
            $manager->getEvent()->getParam('ServiceManager')->get('solarium.logger');
        });
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Laminas\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}

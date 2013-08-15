<?php

namespace EwgoSolarium\Service;

use Solarium\Client;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SolariumFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Configuration');
        $client = new Client(isset($config['solarium']) ? $config['solarium'] : array());
        $client->registerPlugin('solarium_logger', $serviceLocator->get('solarium.logger'));

        return $client;
    }
}

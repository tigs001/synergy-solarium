<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'Solarium\Client' =>   SynergySolarium\Service\SolariumFactory::class,
            'SynergySolarium\Collector\RequestCollector' => SynergySolarium\Service\RequestCollectorFactory::class,
            'SynergySolarium\Plugin\RequestLogger' => SynergySolarium\Service\RequestLoggerFactory::class
        ),
        'aliases' => array(
            'solarium' => Solarium\Client::class,
            'solarium.collector' => SynergySolarium\Collector\RequestCollector::class,
            'solarium.logger' => SynergySolarium\Plugin\RequestLogger::class
        )
    ),

    'view_manager' => array(
        'template_map' => array(
            'laminas-developer-tools/toolbar/solarium-requests' => __DIR__ . '/../view/laminas-developer-tools/toolbar/solarium-requests.phtml',
        ),
    ),

    'laminas-developer-tools' => array(
        'profiler' => array(
            'collectors' => array(
                'solarium' => 'solarium.collector',
            ),
        ),
        'toolbar' => array(
            'entries' => array(
                'solarium' => 'laminas-developer-tools/toolbar/solarium-requests',
            ),
        ),
    ),
);

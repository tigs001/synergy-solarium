<?php

namespace SynergySolarium\Collector;

use Laminas\DeveloperTools\Collector\AutoHideInterface;
use Laminas\DeveloperTools\Collector\CollectorInterface;
use SynergySolarium\Plugin\RequestLogger;
use Laminas\Mvc\MvcEvent;

/**
 * Zend Developer Toolbar collector for Solarium requests
 *
 * @license MIT
 * @package SynergySolarium
 */
class RequestCollector implements CollectorInterface, AutoHideInterface
{
    /**
     * Solarium request logger
     * @var RequestLogger
     */
    protected $logger;

    /**
     * Logged requests
     * @var array
     */
    protected $requests = array();

    /**
     * Total request duration
     * @var int
     */
    protected $totalRequestTime = 0;

    public function __construct(RequestLogger $logger)
    {
        $this->logger = $logger;
    }

    public function canHide()
    {
        return empty($this->requests);
    }

    public function collect(MvcEvent $mvcEvent)
    {
        foreach ($this->logger->getRequests() as $request) {
            $this->totalRequestTime += $request['duration'];
            $this->requests[] = array(
                'endpoint' => $request['endpoint']->getKey(),
                'handler' => $request['request']->getHandler(),
                'params' => $request['request']->getParams(),
                'duration' => $request['duration']
            );
        }
    }

    public function getName()
    {
        return 'solarium';
    }

    public function getPriority()
    {
        return 10;
    }

    public function getRequestCount()
    {
        return count($this->requests);
    }

    public function getRequestTime()
    {
        return $this->totalRequestTime;
    }

    public function getRequests()
    {
        return $this->requests;
    }
}

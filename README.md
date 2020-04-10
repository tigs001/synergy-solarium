[![Latest Stable Version](https://poser.pugx.org/synergy/solarium-module/v/stable)](https://packagist.org/packages/synergy/solarium-module)
[![Total Downloads](https://poser.pugx.org/synergy/solarium-module/downloads)](https://packagist.org/packages/synergy/solarium-module)
[![Build Status](https://travis-ci.org/odiaseo/synergy-solarium.svg?branch=master)](https://travis-ci.org/odiaseo/synergy-solarium)
[![Coverage Status](https://coveralls.io/repos/github/odiaseo/synergy-solarium/badge.svg?branch=master)](https://coveralls.io/github/odiaseo/synergy-solarium?branch=master)
[![composer.lock](https://poser.pugx.org/synergy/solarium-module/composerlock)](https://packagist.org/packages/synergy/solarium-module)

# SynergySolarium module

## About

The SynergySolarium module provides ZF3 integration with [Solarium](http://www.solarium-project.org) solr client.

It also integrates with [Zend Developer Tools](https://github.com/zendframework/Laminas\DeveloperTools).

Inspired by Ewgo/SolariumModule ZF2 module

## Installation

``` bash
$ php composer.phar require synergy/solarium-module
```

Add "SynergySolarium" to the list of loaded modules.

## Basic configuration

```php
array(
    'solarium' => array(
        'endpoint' => array(
            'default' => array(
                'host' => 'localhost',
                'port' => 8983,
                'path' => '/solr',
                'core' => 'default',
                'timeout' => 5
            )
            //...
        )
    )
)
```

## Usage

```php
$client = $serviceLocator->get('Solarium\Client'); // Or the 'solarium' alias
$query = $client->createSelect();
$resultset = $client->execute($query);
```

For more information see the [Solarium documentation](http://www.solarium-project.org/documentation/).

## Paginator adapter
This module also provides an adapter for Laminas\Paginator.
```php
$paginator = new \Laminas\Paginator\Paginator(
    new \SynergySolarium\Paginator\Adapter\SolariumPaginator($client, $query)
);
$paginator->setCurrentPageNumber($page);
$paginator->setItemCountPerPage($countPerPage);
```
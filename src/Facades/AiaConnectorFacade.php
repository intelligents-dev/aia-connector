<?php

namespace IntelligentsDev\AiaConnector\Facades;

use Illuminate\Support\Facades\Facade;
use IntelligentsDev\AiaConnector\AiaConnector;

/**
 * @mixin AiaConnector
 */
class AiaConnectorFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AiaConnector::class;
    }
}

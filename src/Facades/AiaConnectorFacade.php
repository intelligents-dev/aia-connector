<?php

namespace IntelligentsDev\AiaConnector\Facades;

use IntelligentsDev\AiaConnector\AiaConnector;
use Illuminate\Support\Facades\Facade;

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

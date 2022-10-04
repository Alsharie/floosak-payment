<?php

namespace Alsharie\FloosakPayment\Facade;

use Illuminate\Support\Facades\Facade;
use Alsharie\FloosakPayment\Floosak;

class FloosakPayment extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     */
    protected static function getFacadeAccessor()
    {
        return Floosak::class;
    }
}
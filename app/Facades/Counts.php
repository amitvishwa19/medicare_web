<?php

namespace App\Facades;

use Aws\AwsClientInterface;
use Illuminate\Support\Facades\Facade;


class Counts extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'menuCounts';
    }

}

<?php

namespace App\Facades;

use Aws\AwsClientInterface;
use Illuminate\Support\Facades\Facade;


class FyersFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fyers';
    }

}

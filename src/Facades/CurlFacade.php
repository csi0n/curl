<?php
namespace csi0n\Curl\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: csi0n
 * Date: 09/02/2017
 * Time: 7:00 AM
 */
class CurlFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'csi0n.laravel.curl';
    }
}

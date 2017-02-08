<?php
/**
 * Created by PhpStorm.
 * User: csi0n
 * Date: 08/02/2017
 * Time: 5:18 AM
 */

namespace csi0n\Curl\Repositories;

class CurlRepository
{
    protected $url;
    public function to($url = '')
    {
        $this->url = $url;
    }

    public function data()
    {
        # code...
    }

    public function post()
    {
        # code...
    }
    public function get()
    {
        # code...
    }
    public function send()
    {
        # code...
    }
}

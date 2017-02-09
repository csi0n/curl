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
    protected $ch;

    protected $content;

    protected $curl_options = [
        'URL'            => '',
        'RETURNTRANSFER' => 1,
        'HEADER'         => 0,
        'POST'           => 0,
        'POSTFIELDS'     => [],
    ];

    protected $custom_options = [
        'REQUEST_AS_JSON'  => false,
        'DATA'             => [],
        'RESPONSE_AS_JSON' => false,
    ];

    public function to($url = '')
    {
        $this->curl_options['URL'] = $url;
        return $this;
    }

    public function responseJson()
    {
        $this->custom_options['RESPONSE_AS_JSON'] = true;
        return $this;
    }

    public function data(array $attribute)
    {
        $this->custom_options['DATA'] = $attribute;
        return $this;
    }

    public function post()
    {
        $this->setPostParameters();
        return $this->send();
    }

//    public function put()
    //    {
    //        $this->setPostParameters();
    //        $this->curl_options['CUSTOMREQUEST'] = 'PUT';
    //    }
    //
    //    public function redirect($bool)
    //    {
    //
    //    }

    public function get()
    {
        $this->appendDataToURL();
        return $this->send();
    }

    public function send()
    {
        $this->ch = curl_init();
        $options  = $this->AllOptions();
        curl_setopt_array($this->ch, $options);
        $this->content = curl_exec($this->ch);
        curl_close($this->ch);
        if ($this->custom_options['RESPONSE_AS_JSON']) {
            return json_decode($this->content, true);
        }

        return $this->content;
    }

    protected function setPostParameters()
    {
        $this->curl_options['POST'] = 1;
        if (is_array($this->custom_options['DATA']) && sizeof($this->custom_options['DATA']) != 0) {
            if ($this->custom_options['REQUEST_AS_JSON']) {
                $this->curl_options['POSTFIELDS'] = json_encode($this->custom_options['DATA']);
            } else {
                $this->curl_options['POSTFIELDS'] = $this->custom_options['DATA'];
            }

        }
    }

    protected function AllOptions()
    {
        $result = array();
        foreach ($this->curl_options as $k => $v) {
            $result[constant(sprintf('CURLOPT_%s', $k))] = $v;
        }
        return $result;
    }

    protected function appendDataToURL()
    {
        $parameterString = '';
        if (is_array($this->custom_options['DATA']) && count($this->custom_options['DATA']) != 0) {
            $parameterString = '?' . http_build_query($this->custom_options['DATA'], null, '&');
        }
        return $this->curl_options['URL'] .= $parameterString;
    }
}

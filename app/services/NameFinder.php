<?php

namespace App\services;

/**
 * Created by Aliensdesign.
 * User: Aliensdesign
 * Date: 28/03/2017
 * Time: 14:38
 */

Class NameFinder {

    public $names;
    public $url;
    public $extension;
    public $data;
    public $register;

    public function __construct()
    {
        /**/
        $this->url       = 'https://registro.br/ajax/avail/';
        $this->register  = 'https://registro.br/cgi-bin/nicbr/documento?fqdn=';
        $this->data      = array();
        $this->extension = '.com.br';
    }

    public function callRegistroURL($names)
    {
        $this->names = $names;
        foreach($this->names as $name)
        {
            $this->data[] = $this->toJSON(file_get_contents($this->url.$name));
        }
        return $this->data;
    }

    public function toJSON($data)
    {
        return json_decode($data);
    }

    public function registerNameLink($fqdn)
    {
        return $this->register.$fqdn;
    }

}
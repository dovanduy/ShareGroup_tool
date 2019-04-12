<?php

class Proxy
{
    public $ip_address = "";
    public $port = NULL;
    public $username = "";
    public $password = "";

    /**
     * Proxy constructor.
     * @param null $ip_address
     * @param null $port
     * @param null $username
     * @param null $password
     */

    public function __construct(string $proxy)
    {
        if ($this->checkProxy($proxy)){
            $proxy = explode(":", $proxy);
            $this->ip_address = $proxy[0];
            $this->port = $proxy[1];
            $this->username = isset($proxy[2]) ? $proxy[2] : NULL;
            $this->password = isset($proxy[3]) ? $proxy[3] : NULL;
        }
    }

    private function checkProxy(string $proxy){
        preg_match("/^\d+\.\d+\.\d+\.\d+:\d+(:[0-9A-Za-z]+:[0-9A-Za-z]+$)|^\d+\.\d+\.\d+\.\d+:\d+$/",$proxy,$matches);
        if (empty($matches))
            return false;
        else
            return true;
    }

    public function to_string(){
        return $this->ip_address . ":" . $this->port . ":" . $this->username . ":" . $this->password;
    }

}
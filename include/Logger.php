<?php

class Logger
{
    private $destination;

    /**
     * Logger constructor.
     * @param $directory
     */
    public function __construct(string $filename)
    {
        $this->destination = $_SERVER['DOCUMENT_ROOT'] . "/" . FOLDER . "/" .$filename;
    }

    public function log(string $message){
        $message = date("d/m/Y h:i:sa") . "\n". $message . "\n\n";
        error_log($message, 3, $this->destination);
    }

}
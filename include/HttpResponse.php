<?php


class HttpResponse
{
    public $status;
    public $header;
    public $data;

    /**
     * HttpResponse constructor.
     * @param $header
     * @param $body
     */
    public function __construct($header, $data)
    {
        $this->header = $header;
        $this->data = $data;
    }

}
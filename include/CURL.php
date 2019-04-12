<?php
include_once "HttpResponse.php";

const HTTP = 0;
const HTTP1_0 = 1;
const HTTPS = 2;


class CURL
{
    private $curl = NULL;

    /**
     * CURL constructor.
     * @param null $curl
     */
    public function __construct(string $URL = NULL)
    {
        $this->curl = curl_init($URL);
        $this->setDefaultOption();
    }

    public function send()
    {
        $result = curl_exec($this->curl);

        $header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $header_size);
        $data = substr($result, $header_size);

        return new HttpResponse($header, $data);
    }

    public function close()
    {
        curl_close($this->curl);
    }

    public function setURL(string $URL)
    {
        curl_setopt($this->curl, CURLOPT_URL, $URL);
    }

    public function setOptions(array $options)
    {
        curl_setopt_array($this->curl, $options);
    }

    public function setReturnTransfer(bool $bool)
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, $bool);
    }

    public function setFollowLocation(bool $bool)
    {
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, $bool);
    }

    public function post(array $data)
    {
        curl_setopt($this->curl, CURLOPT_POST, TRUE);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
    }

    public function setProxy(Proxy $proxy)
    {
        curl_setopt($this->curl, CURLOPT_HTTPPROXYTUNNEL, true);
        curl_setopt($this->curl, CURLOPT_PROXY, $proxy->ip_address);
        curl_setopt($this->curl, CURLOPT_PROXYPORT, $proxy->port);
        curl_setopt($this->curl, CURLOPT_PROXYUSERNAME, $proxy->username);
        curl_setopt($this->curl, CURLOPT_PROXYPASSWORD, $proxy->password);
    }

    public function setProxyType(int $type)
    {
        curl_setopt($this->curl, CURLOPT_PROXYTYPE, $type);
    }

    public function setSSLVerify(bool $bool)
    {
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, $bool);
    }

    public function setSSLVerifyPeer(bool $bool)
    {
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, $bool);
    }

    public function setCookie(string $cookie)
    {
        curl_setopt($this->curl, CURLOPT_COOKIE, $cookie);
    }

    public function setConnectTimeOut(int $second)
    {
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $second);
    }

    public function setTimeOut(int $second)
    {
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $second);
    }

    public function setUserAgent(string $useragent)
    {
        curl_setopt($this->curl, CURLOPT_USERAGENT, $useragent);
    }

    private function setReturnHeader(bool $bool)
    {
        curl_setopt($this->curl, CURLOPT_HEADER, $bool);
    }

    public function setHttpHeader(array $header)
    {
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $header);
    }

    public function setProgress(bool $bool)
    {
        curl_setopt($this->curl, CURLOPT_NOPROGRESS, !$bool);
    }

    public function setAutoReferer(bool $bool)
    {
        return curl_setopt($this->curl, CURLOPT_AUTOREFERER, $bool);
    }

    public function setHeaderOut(bool $bool)
    {
        curl_setopt($this->curl, CURLINFO_HEADER_OUT, $bool);
    }

    public function getRequestHeader()
    {
        return curl_getinfo($this->curl, CURLINFO_HEADER_OUT);
    }

    private function setDefaultOption()
    {
        $this->setReturnHeader(true);
        $this->setSSLVerify(false);
        $this->setSSLVerifyPeer(false);
        $this->setReturnTransfer(true);
        $this->setFollowLocation(true);
        $this->setAutoReferer(true);
        $this->setProxyType(HTTP);
        $this->setHeaderOut(true);
        $this->setUserAgent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36");
        $this->setConnectTimeOut(10);
        $this->setTimeOut(30);
    }

}
<?php

class ProxyManager
{

    private function checkProxy(string $proxy)
    {
        preg_match("/^\d+\.\d+\.\d+\.\d+:\d+(:[0-9A-Za-z]+:[0-9A-Za-z]+$)|^\d+\.\d+\.\d+\.\d+:\d+$/", $proxy, $matches);
        if (empty($matches))
            return false;
        else
            return true;
    }

    public function getProxys()
    {
        $conn = getConnection();
        $stmt = $conn->query("SELECT proxy FROM list_proxy");

        $proxys = array();

        while ($row = $stmt->fetch_assoc()){
            $proxys[] = new Proxy($row['proxy']);
        }

        $stmt->close();
        $conn->close();

        return $proxys;
    }

    public function addProxys(string $list_proxy)
    {
        $conn = getConnection();

        $arr_proxy = explode("\n", $list_proxy);

        $sql = "INSERT INTO list_proxy (proxy) VALUES ";

        $added = 0;

        foreach ($arr_proxy as $proxy) {
            if ($this->checkProxy($proxy)) {
                if ($added == 0) {
                    $sql .= "($proxy) ";
                } else {
                    $sql .= "(, $proxy)";
                }
                $added++;
            }
        }

        $sql .= ";";

        $conn->query($sql);


        if ($added == 0) {
            return $conn->error;
        } else{
            return $added;
        }

        $conn->close();
    }

}
<?php
const ADMIN = 1;
const USER = 2;


class Authenticate
{
    private $uid;
    private $role;
    public $Connect;
//        $id,
//        $auth = '0';

    public function login(string $uname, string $pass)
    {
        setcookie("uid", 1099153, time()+3600*60);
        if ($uname == 'admin'){
            setcookie("uid", 1099152, time()+3600*60);
        }
    }

    public function checkAuth()
    {
        if (isset($_COOKIE['uid'])){
            if (intval($_COOKIE['uid']) != NULL){
                $this->uid = $_COOKIE['uid'];
                $this->role = USER;
            }
            if (intval($_COOKIE['uid']) == 1099152){
                $this->role = ADMIN;
            }
        }
    }

    /**
     * @return int
     */
    public function getUID()
    {
        return intval($this->uid);
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return intval($this->role);
    }

}
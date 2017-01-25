<?php

class Ip extends DbConect
{
    /*
     * Время между регистрациями
     */
    const DURATION_BETWEEN_REGISTRATIONS = 10;

    private $ip;
    public  $isNewRecord = false;

    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        parent::__construct();
    }

    public function tableName()
    {
        return '`ip`';
    }

    public function findByIp()
    {

        return $this->DB_CONECT->query("SELECT * FROM {$this->tableName()} WHERE `ip` = INET_ATON('{$this->ip}')")->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $this->DB_CONECT->query("INSERT INTO {$this->tableName()} SET `ip` =  INET_ATON('{$this->ip}'), `date_time` = UNIX_TIMESTAMP()");
    }

    public function updateDateTimeForIp()
    {
        $this->DB_CONECT->query("UPDATE {$this->tableName()} SET `date_time` = UNIX_TIMESTAMP() WHERE `ip` = INET_ATON('{$this->ip}')");
    }

    public function checkIp()
    {
        $ipInfo = $this->findByIp();

        if ($ipInfo) {
            if ($ipInfo['date_time'] + self::DURATION_BETWEEN_REGISTRATIONS < time()) {
                return true;
            } else {
                return false;
            }
        }
        $this->isNewRecord = true;

        return true;
    }
}
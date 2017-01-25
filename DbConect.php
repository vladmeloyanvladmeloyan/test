<?php


class DbConect
{
    const DB_USER = 'root';
    const DB_HOST = 'localhost';
    const DB_NAME = 'test';
    protected $DB_CONECT;


    public function __construct()
    {
        try {
            $this->DB_CONECT = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->DB_CONECT->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'No connection';
            die;
        }
    }
}
<?php

abstract class Connect
{
    private $host = "localhost";
    private $db_name = "blog";
    private $userName = "root";
    private $password = "";


    private static $bdd;


    private function getConnection()
    {
        try {
            self::$bdd = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ';charset=utf8',
                $this->userName,
                $this->password
            );

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getBDD(): PDO
    {
        if (self::$bdd === null) {
            self::getConnection();
        }
        return self::$bdd;
    }
}
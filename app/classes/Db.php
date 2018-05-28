<?php
namespace classes;

use PDO;

class Db
{

    const USER = "root";
    const PASS = "";
    const HOST = "localhost";
    const DB = "messwall";

    public static function connectDb()
    {
        $user = self::USER;
        $pass = self::PASS;
        $host = self::HOST;
        $db = self::DB;
        try {
            $connect = new PDO("mysql:dbname=$db;host=$host;", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (Exception $ex) {
            echo '<br>Подключить бд не удалось ' . $e->getMessage() . ' <br>';
        }

        return $connect;
    }
}

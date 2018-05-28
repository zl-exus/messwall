<?php

/**
 * Data base config
 *
 * @author zlexus
 */
class db {
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
                
                $connect = new PDO("mysql:dbname=$db;host=$host;", $user, $pass);
                return $connect;
            }
            
}

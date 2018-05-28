<?php
error_reporting(E_ALL);  //установливает уровень отслеживаемости ошибокинтерпиртатором
ini_set('display_errors', 1);  //выводить все ошибки в браузер

require_once ("../conf/config.php");
require_once ("../conf/autoload.php");

$db = new classes\Db();

$mess_header = $db->connectDb()->query("SELECT * FROM message_header");
var_dump($mess_header);
    
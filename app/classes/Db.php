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

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $connect = new PDO("mysql:dbname=$db;host=$host;", $user, $pass, $options);
        } catch (Exception $ex) {
            echo '<br>Подключить бд не удалось ' . $ex->getMessage() . ' <br>';
        }

        return $connect;
    }

    private function getTablesNames()
    {
        $tables = $this->connectDb()->query('SHOW TABLES from ' . self::DB)->fetchAll();
        foreach ($tables as $tables => $table_name) {
            foreach ($table_name as $name) {
                $tables_names[] = $name;
            }
        }
        return $tables_names;
    }

    private function buildQueryForTable($name)
    {
        $tables_names = $this->getTablesNames();
        foreach ($tables_names as $table_name) {
            if ($name === $table_name) {
                $table_name_for_query = $name;
            }
        }

        $query = "SELECT * FROM . $table_name_for_query";
        return $query;
    }

    public function getTable($name, $key = '')
    /*
     *  Returns the associative array formed from the table.
     * 
     *  @param $name string
     *  @return array <b>PDO::FETCH_ASSOC</b> returns an array containing
     *  all of the remaining rows in the result set.
     */
    {
        if (isset($name)) {
            try {
                $query = $this->buildQueryForTable($name);
                $table = $this->connectDb()->prepare($query);
                $table->bindValue(1, $name, PDO::PARAM_STR);
//                var_dump($table->bindParam(':table_name', $name, PDO::PARAM_STR));
//                die();
                $table->execute();
                $table_data = $table->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
                echo '<br>Возникла ошибка при попытке извлечь данные: ' . $ex->getMessage() . ' <br>';
            }
        }
        return $table_data;
    }

    public function getMessagesArray()   // перенести в модель
    {
        try {
            $mess_array = $this->connectDb()->query('SELECT * FROM message_header, message_body WHERE message_header.post_id = message_body.post_id')->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            echo '<br>Возникла ошибка при попытке извлечь данные: ' . $ex->getMessage() . ' <br>';
        }
        return $mess_array;
    }

    public function getAuthorId($param)
    {
        
    }

    public function addMessage($user_id, $text, $parent_post_id = 0, $has_children = 0)
    {
        try {
            $query = 'BEGIN; 
                  INSERT INTO message_header (parent_post_id, author_id, has_children)VALUES(?, ?, ?);
                  INSERT INTO message_body (post_id, post_text) VALUES(LAST_INSERT_ID(), ?);
                  COMMIT;';
            $addmess = $this->connectDb()->prepare($query);
            $addmess->bindValue(1, $parent_post_id);
            $addmess->bindValue(2, $user_id); // need get author_id!!!!
            $addmess->bindValue(3, $has_children);
            $addmess->bindValue(4, $text);
            $addmess->execute();
        } catch (Exception $ex) {
            echo '<br>Возникла ошибка при попытке добавить данные в БД: ' . $ex->getMessage() . ' <br>';
        }
    }
}

<?php
//This class describes connection to the database
class MySql extends mysqli
{
    public $isConnected; //признак, что есть соединение сервером БД

    public function __construct(array $mas)
    {   
        parent::__construct($mas['hostname'], $mas['username'], $mas['password'], $mas['database']);
        $this->isConnected = parent::ping(); //connection
    }

    public function myQuery(string $str) { //It sends requests to the database
        $res = $this->isConnected;


        if ($res) {
            $res = $this->query($str);
            if (!is_bool($res)) {
                $res = $res->fetch_all(MYSQLI_ASSOC);
            } 
        }
        return $res;
    }

    public function uniqueCheck($table, $field, $value) { //It checks if passed field already has passed value
        return empty($this->myQuery("SELECT * FROM $table WHERE $field = '$value'"))? true: false;
    }
}

?>

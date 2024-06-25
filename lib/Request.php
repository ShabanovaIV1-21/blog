
<?php

//This class describes site requests to the server
class Request
{
    public $isPost = false; //признак, что запрос был совершен методом POST
    public $isGet = false; //признак, что запрос был совершен методом GET
    public function __construct() 
    {
        $this->isGet = $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
        $this->isPost = $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }

    public function clearParameter ($parameter) //It clears the data passed from the form field 
    {
        return trim(strip_tags($parameter));
    }

    public function clearArray (array $mas) //It clears the data passed from all form fields
    {

        foreach ($mas as &$val) {
            $val = $this->clearParameter($val);
            if (is_array($val)) {
                $this->clearArray($val);
            }
        }
        unset($val);
        return $mas;
    }

    public function post($parameter = false) //It clears the data passed from all form fields by the POST-method
    {
        if ($parameter) {
            return $this->clearParameter($parameter);
        } else {
            return $this->clearArray($_POST);
        }
    }

    public function get($parameter = false) //It clears the data passed by the GET-method
    {
        if ($parameter) {
            if (array_key_exists($parameter, $_GET)) {
                return $this->clearParameter($_GET[$parameter]);
            } else {
                return null;
            } 
        } else {
            return $this->clearArray($_GET);
        }
    }

    public function getHost() //It returns request host
    {
        return $_SERVER['HTTP_HOST'];
    }
    

    
}

?>
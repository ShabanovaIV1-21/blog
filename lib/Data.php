<?php
class Data //UNIVERSAL WORK WITH DIFFERENT DATA 
{
    public function validateData() //It checks if the class' properties uploaded from the form meet the validation rules
    {
        foreach (get_object_vars($this) as $key => $val) {
            if (strpos($key, 'alidate') && $val) {
                return false; //валидация не сработала, validation didn't work
            }
        }
        return true;
    }
    
    public function loadData($mas) //It assigns values from the form fields to the class properties
    {
        if ($mas) {
            foreach ($mas as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
            return true;
        } else {
            return false;
        }
    }
    
    public function rnReplace(string $string) //It replaces all "\r\n" in the passed string with the HTML tag "<br/>"
    {
        return preg_replace('/\v+|\\\r\\\n/ui','<br/>', $string);
    }
    
    public function brReplace (string $string) //It replaces all HTML tags "<br/>" in the passed string with the "\r\n"
    {
        return str_replace('<br/>', "\r\n", $string);
    }
    
    public function changeDate(string $date) //It changes the passed date to the Russian date format
    {
        $date = new DateTimeImmutable($date);
        return $date->format('d.m.Y H:i:s');
    }

    public function sqlFormat(string $date) //It changes the passed date from Russian date format to the SQL date format
    {
        $date = new DateTimeImmutable($date);
        return $date->format('Y-m-d H:i:s');
    }

}
?>
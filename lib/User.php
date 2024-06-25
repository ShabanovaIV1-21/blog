<?php
//This class describes site user

class User extends Data
{
    public $tableName = 'user';
    
    public $name;
    public $validateName;
    
    public $surname;
    public $validateSurname;
    
    public $patronymic = null;
    
    public $login;
    public $validateLogin;
    
    public $email;
    public $validateEmail;
    
    public $password;
    public $validatePassword;
    
    public $password_repeat;
    public $validatePasswordRepeat;
    
    public $id; 
    public $token;
    public $is_block;
    public $validateBlock;
    public $block_time;
    public $role_id;
    public $isGuest = true;
    public $isAdmin;
    public $loginAdmin = 'admin';
    public $passwordAdmin = 'admin';
    public $request;
    public $mysql;

    public function __construct($mysql, $request) 
    {
        $this->mysql = $mysql;
        $this->request = $request;
        if ($this->request->get('token')) {
            $this->identity();
        }
        
    }

    public function load($mas) //It assigns values from the form fields to the class properties
    {
        $res = $this->loadData($mas);
        $this->isAdmin = $this->isAdmin();
        return $res;
    }

    public function validateRegister() //It checks if the class' properties uploaded from the registration form meet the validation rules
    {
        if (empty($this->name)) {
            $this->validateName = 'Имя пользователя не введено';
        }
        if (empty($this->surname)) {
            $this->validateSurname = 'Фамилия пользователя не введена';
        }
        if (empty($this->login)) {
            $this->validateLogin = 'Логин пользователя не введен';
        }
        if (!$this->mysql->uniqueCheck('user', 'login', $this->login)) {
            $this->validateLogin = 'Пользователь с таким логином уже существует';
        }
        if(empty($this->email)) {
            $this->validateEmail = 'Email пользователя не введен';
        }
        if (!$this->mysql->uniqueCheck('user', 'email', $this->email)) {
            $this->validateEmail = 'Пользователь с таким email уже существует';
        }
        if (empty($this->password)) {
            $this->validatePassword = 'Пароль пользователя не введен';
        }
        if (strlen($this->password) < 6) {
            $this->validatePassword = 'Пароль должен быть не менее 6 символов';
        }
        if ($this->password_repeat == null || $this->password_repeat == '') {
            $this->validatePasswordRepeat = 'Подтвердите введенный пароль';
        }
        if ($this->password !== $this->password_repeat) {
            $this->validatePasswordRepeat = 'Подтверждение пароля введено неверно';
        }
        
        return $this->validateData();
        
    }
    
    public function save() //It saves a new user in the database 
    {
        $pass = crypt($this->password, '984jekf');
        return $this->mysql->myQuery("INSERT INTO $this->tableName (name, surname, patronymic, login, email, password, role_id) VALUES ('$this->name', '$this->surname', '$this->patronymic', '$this->login', '$this->email', '$pass', 1)");
        
    }
    
    public function validateLogin() //It checks if the class' properties uploaded from the login form meet the validation rules
    {
        if ($this->mysql->uniqueCheck('user', 'login', $this->login)) {
            $this->validateLogin = 'Неправильно введён логин';
        }
        if (empty($this->login)) {
            $this->validateLogin = 'Логин пользователя не введен';
        }
        
        if (empty($this->password)) {
            $this->validatePassword = 'Пароль пользователя не введен';
        }
        return $this->validateData();
        
    }
    public function isAdmin() //It checks if the user is admin
    {
        if ($this->login == $this->loginAdmin && password_verify($this->passwordAdmin, $this->password)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function login() //It makes the user's authentication and uploads its token to the database
    {
        
        if (!password_verify($this->password, $this->mysql->myQuery("SELECT password FROM $this->tableName WHERE login = '$this->login'")[0]['password'])) {
            $this->validatePassword = "Пароль введён неверно";
            return false;
        } else {
            $this->load($this->mysql->myQuery("SELECT * FROM $this->tableName WHERE login = '$this->login'")[0]);
            if ($this->is_block) {
                $this->validateBlock = 'Пользователь заблокирован';
                return false;
            } else {
            $this->isGuest = false;
            $this->token = substr(str_shuffle("0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM"), 0, 14);
            $this->mysql->myQuery("UPDATE $this->tableName SET token = '$this->token' WHERE id=$this->id");
            return true;
            }
        }
    }
    
    public function identity($id = false) //It identifies the site user by its id or auth token from the database
    {
        
        if ($id) {
            $r = $this->mysql->myQuery("SELECT * FROM $this->tableName WHERE id = $id");
        } else {
            $t = $this->request->get('token');
            $r = $this->mysql->myQuery("SELECT * FROM $this->tableName WHERE token = '$t'");
        }
        if ($r) {
            $this->load($r[0]);
            $this->isGuest = false;
            return true;
        } else {
            return false;
        }
    }
    
    public function logout() //It makes the user log out
    {
        if (!$this->isGuest) {
            $this->mysql->myQuery("UPDATE $this->tableName SET token = NULL WHERE token = '$this->token'");
            $this->token = null;
            $this->isGuest = true;
            return true;
        } else {
            return false;
        }
    }
    
    public function unblock() //It cancels the user's block
    {
        $mas = $this->mysql->myQuery("SELECT id, block_time FROM $this->tableName WHERE is_block=1");
        foreach ($mas as $val) {
            $v = $val['id'];
            if ($val['block_time'] && (strtotime("now") >= strtotime($val['block_time']))) {
                return $this->mysql->myQuery("UPDATE $this->tableName SET is_block = 0, block_time = null WHERE id = $v");
            }
        }

        
    }
}

?>
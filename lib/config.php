<?php
$menu_conf = [
    0 => ["Главная" => "index.php"],
    1 => ["Блоги" => "posts.php"],
    2 => ["Вход" => "login.php",
        "Регистрация" => "register.php"],
    3 => ["О нас" => "about.php"],
    4 => ["Пользователи" => "users.php"],
    5 => ["Выход" => "logout.php"]
];

$sql_conf = [
    'hostname' =>'localhost',
    'username' => 'root',
    'password' => 'root', 
    'database' => 'blog',
];

?>
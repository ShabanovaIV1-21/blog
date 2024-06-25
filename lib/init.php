<?php
require_once "autoload.php";
require_once "config.php";


$request = new Request();
$sql = new MySql($sql_conf);
$user = new User($sql, $request);
$response = new Response($user);
$menu = new Menu($menu_conf, $response);
$post = new Post($user);
$comment = new Comment($post);
$admin = new Admin($sql, $request);
 ?>
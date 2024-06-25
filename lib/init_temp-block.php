<?php
require_once "init.php";
if ($user->isAdmin && $request->get('user') && $request->isPost) {
    $admin->block($request->get('user'), $user->sqlFormat($_POST['date_block']));
    $response->redirect('users.php', ['token' => $user->token]);
}
?>
<?php
require_once "init.php";
$user->unblock();
if ($user->isAdmin && $request->get('user')) {
    $admin->block($request->get('user'));
    $admin->userPostsDelete($request->get('user'));
    $response->redirect('users.php', ['token' => $user->token]);
}

?>
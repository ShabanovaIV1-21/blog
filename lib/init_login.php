<?php
require_once "init.php";
if ($request->isPost) {
    $user->load($request->post());
    if ($user->validateLogin()) {
        $user->unblock();
        if ($user->login()) {
            $response->redirect('index.php', ['token' => $user->token]);
            
             
        } 
        
    }
}
?>
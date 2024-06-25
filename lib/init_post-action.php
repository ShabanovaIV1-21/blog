<?php
require_once "init.php";
if ($request->get('post')) {
    $post->findOne($request->get('post'));
}
if ($request->isPost && !$user->isGuest && !$user->isAdmin) {
    $post->load($request->post());
    if ($post->validate()) {
        $post->save();
        if (!$post->id) {
            $post->load($post->user->mysql->myQuery("SELECT * FROM post ORDER BY id DESC LIMIT 1")[0]);
        }
        $response->redirect('post.php', ['token' => $user->token, 'post' => $post->id]);
    }
}
?>
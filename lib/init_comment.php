<?php
require_once "init.php";

if ($request->isPost && !$user->isGuest && !$user->isAdmin) {
    $comment->load($request->post());
    if ($comment->validate()) {
        $comment->save();
        $response->redirect('post.php', ['token' => $user->token, 'post' => $post->id]);
    }
}

if (!$user->isGuest && $user->isAdmin && $request->get('commentdelete')) {
    $admin->commentDelete($request->get('commentdelete'));
    $response->redirect('post.php', ['token' => $user->token, 'post' => $post->id]);
}

?>
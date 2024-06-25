<?php
require_once "init.php";
if ($user->request->get('post')) {
    $post->findOne($user->request->get('post'));
} else {
    if ($user->token) {
        $response->redirect('index.php', ['token' => $user->token]);
    } else {
        $response->redirect('index.php', []);
    }
}

if ($request->get('delete')) {
    if (!$user->isAdmin) {
        if ($post->commentAmount) {
            $post->delete = "Пост нельзя удалить, так как к нему оставлены комментарии";
        } else {
            $post->delete($post->id);
            $response->redirect('index.php', ['token' => $user->token]);
        }
    } else {
        $admin->postDelete($post->id);
        $response->redirect('index.php', ['token' => $user->token]);
    }
}
?>
<?php
//This class describes site admin
class Admin extends User
{
    //public $post;
    //public $comment;

    public function __construct($mysql, $request)
    {
        parent::__construct($mysql, $request);
    }

    public function block($id, $block_time = null)
    {
        if ($block_time) { //TEMPOPARY BLOCK OF THE USER
            return $this->mysql->myQuery("UPDATE $this->tableName SET is_block = 1, block_time = '$block_time' WHERE id = $id");
        } else { //PERMANENT BLOCK OF THE USER
            return $this->mysql->myQuery("UPDATE $this->tableName SET is_block = 1 WHERE id = $id");
        }
    }

    public function commentDelete($id)
    {
        $post = new Post(new User($this->mysql, $this->request));
        $comment = new Comment ($post);
        return $comment->delete($id);
    }

    public function postDelete($post_id)
    {
        $post = new Post(new User($this->mysql, $this->request));
        $comment = new Comment ($post);
        $t = $comment->tableName;
        $arr_com = $this->mysql->myQuery("SELECT id FROM $t WHERE post_id=$post_id");
        if ($arr_com) {
            foreach ($arr_com as $val) {
                $this->commentDelete($val['id']);
            }
        }
        return $post->delete($post_id);
    }

    public function userPostsDelete($user_id)
    {
        $post = new Post(new User($this->mysql, $this->request));
        $n = $post->tableName;
        $mas = $this->mysql->myQuery("SELECT id FROM $n WHERE user_id=$user_id");
        if ($mas) {
            foreach ($mas as $val) {
                $this->postDelete($val['id']);
            }
        }
    }
}
?>
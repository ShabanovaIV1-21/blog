<?php
//This class describes comments
class Comment extends Data
{
    public $post;
    public $comment;
    public $validateComment;
    public $id;
    public $parent_id;
    public $post_id;
    public $user_id;
    public $create_at;
    public $tableName = 'comment';

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function validate()
    {
        if (empty($this->comment)) {
            $this->validateComment = 'Текст комментария не введен';
        }
        return $this->validateData();
    }

    public function load($mas)
    {
        return $this->loadData($mas);
    }

    public function save()
    {
        $t = $this->rnReplace($this->comment);
        $u = $this->post->user->id;
        $p = $this->post->id;
        return $this->post->user->mysql->myQuery("INSERT INTO $this->tableName (post_id, user_id, comment) VALUES ('$p', '$u', '$t')");
        
    }

    public function dateAppear($date)
    {
        return $this->changeDate($date);
    }

    public function commentList($post_id) {
        $mas = $this->post->user->mysql->myQuery("SELECT * FROM $this->tableName WHERE post_id=$post_id ORDER BY create_at DESC");
        $res = [];
        foreach ($mas as $val) {
            $u = new User($this->post->user->mysql, $this->post->user->request);
            $u->identity($val['user_id']);
            $p = new Post($u);
            $p->findOne($val['post_id']);
            $c = new static($p);
            $c->load($val);
            $res[] = $c;
        }
        return $res;
    }

    public function delete($id)
    {
        return $this->post->user->mysql->myQuery("DELETE FROM $this->tableName WHERE id=$id");
    }

}
?>
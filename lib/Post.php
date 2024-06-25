<?php
//This class describes posts

class Post extends Data
{
    public $user;
    public $tableName = 'post';

    public $title;
    public $validateTitle;

    public $preview;
    public $validatePreview;

    public $content;
    public $validateContent;

    public $id;
    public $create_at;
    public $update_at;
    public $commentAmount;
    public $user_id;
    public $delete;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function validate() //It checks if the class' properties meet the validation rules
    {
        if (empty($this->title)) {
            $this->validateTitle = 'Тема поста не введена';
        }
        
        if (empty($this->preview)) {
            $this->validatePreview = 'Превью поста не введено';
        }
        if (empty($this->content)) {
            $this->validateContent = 'Текст поста не введен';
        }

        return $this->validateData();
    }

    public function load($mas) //It assigns values from the form fields to the class properties
    {
        return $this->loadData($mas);
    }

    public function save() //It saves a new post in the database or resaves edited post
    {
        $t = $this->rnReplace($this->content);
        $u = $this->user->id;
        
        if ($this->user->request->get('post')) {
            return $this->user->mysql->myQuery("UPDATE $this->tableName SET title = '$this->title', preview = '$this->preview', content = '$t' WHERE id=$this->id");
        } else {
            return $this->user->mysql->myQuery("INSERT INTO $this->tableName (title, preview, content, user_id) VALUES ('$this->title', '$this->preview', '$t', $u)");
        }
        
    }

    public function findOne(int $id) //It returns post with the passed id 
    {
        $res = $this->load($this->user->mysql->myQuery("SELECT * FROM $this->tableName WHERE id = $id")[0]);
        if ($res) {
            $this->commentAmount = $this->user->mysql->myQuery("SELECT count(*) FROM comment WHERE post_id=$this->id")[0]['count(*)'];
            return true;
        } else {
            return false;
        } 
    }

    public function dateAppear($date) //It changes the passed date to the Russian date format
    {
        return $this->changeDate($date);
    }

    public function postsList($limit = false) { //It returns a list of all posts or last posts in the passed amount
        if ($limit) {
            $mas = $this->user->mysql->myQuery("SELECT *, (SELECT count(*) FROM comment WHERE post_id=post.id) as commentAmount FROM $this->tableName ORDER BY create_at DESC LIMIT $limit");
        } else {
            $mas = $this->user->mysql->myQuery("SELECT *, (SELECT count(*) FROM comment WHERE post_id=post.id) as commentAmount FROM $this->tableName ORDER BY create_at DESC");
        }
        $res = [];
        foreach ($mas as $key => $val) {
            $u = new User($this->user->mysql, $this->user->request);
            $u->identity($val['user_id']);
            $p = new static($u);
            $p->load($val);
            $res[] = $p;
        }
        return $res;
    }

    public function list10() { //It returns a list of last ten posts 
        return $this->postsList(10);
    }

    public function delete($post_id) //It deletes the post
    {
        return $this->user->mysql->myQuery("DELETE FROM $this->tableName WHERE id=$post_id");
    }

}

?>
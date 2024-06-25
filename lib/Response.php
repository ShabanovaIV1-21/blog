<?php
//This class forms links and redirects users on them
class Response 
{
    public $user;
    
    public function __construct($user)
    {
        $this->user = $user;
        if ($this->user->request->get('token') && !$this->user->token) {
            $this->redirect('index.php', []);
        }
    }
    
    public function getLink(string $url, array $mas) //It forms links for user redirection
    {
        if (!$this->user->isGuest && !array_key_exists('token', $mas)) {
            //var_dump($this->user->isGuest);
            $mas['token'] = $this->user->token;
        }
        if ($mas !== []) {
            //var_dump($mas);
            $url = substr_replace(rtrim($url, "?"), "?", strlen($url), 0);
            foreach ($mas as $key => $val) {
                if (substr($url, strlen($url) - 1) !== '?') {
                    $url .= '&';
                }

                $url .= "$key=$val";
            }
        }
        return $url;
    }
    
    public function redirect(string $url, array $mas) //It redirects user
    {
        $f = $this->user->request->getHost();
        $e = $this->getLink($url, $mas);
        header("Location: http://$f/site/$e");
    }
}
?>
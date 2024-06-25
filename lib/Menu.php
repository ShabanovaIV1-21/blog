<?php
//This class creates the site menu
class Menu 
{
    public $mas;
    public $response;

    public function __construct(array $mas, $response) 
    {
        $this->mas = $mas;
        $this->response = $response;
    }

    public function appear(string $name)
    {
        $start = '<aside id="colorlib-aside" role="complementary" class="js-fullheight"><nav id="colorlib-main-menu" role="navigation"><ul>';
        $end = '</ul></nav></aside>';
        $aside = "";
        foreach ($this->mas as $key => $val) {
            foreach ($val as $k => $v) {
                if ((!$this->response->user->isGuest && $key == 2) || ($this->response->user->isGuest && $key == 5) || (!$this->response->user->isAdmin && $key == 4)) {
                    continue;
                }
                $l = ($this->response->user->isGuest)?$this->response->getLink($v, []):$this->response->getLink($v, ['token' => $this->response->user->token]);
                if ($key == 2) {
                    if ($v === end($val)) {
                        $li = "<a href='$l'>$k</a></li>";
                    } else {
                        $li = "<li><a href='$l'>$k</a> / ";
                    }
                } else {
                    $li = "<li><a href='$l'>$k</a></li>";
                }
                         
                if ($v === $name) { 
                    $li = substr_replace($li, "class='colorlib-active' ", strpos($li, 'a') + 2, 0);
                } 
                $aside .= $li;
            }
        }

        return $start . $aside . $end;
    } 
}
?>

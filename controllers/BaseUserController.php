<?php
class BaseUserController
{
    protected $folder = "user";
    protected $page;

    function render($file, $data = array())
    {
        $view_file = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($view_file)) {
            extract($data);
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            $page = $this->page;
            require_once('views/layouts/user_page.php');
        } else {
            header('Location: index.php');
        }
    }
}

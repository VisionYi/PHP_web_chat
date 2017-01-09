<?php

class Session
{
    public function __construct($lifetime = 0)
    {
        if ($lifetime != 0) {
            session_set_cookie_params($lifetime);
            session_start();

        } else {
            session_start();
        }
    }

    // 使用javascript href來轉跳
    private function change_page($url = '')
    {
        echo "<script type='text/javascript'>window.location.href='$url'</script>";
        exit();
    }

    public function cookies_verify_login($api_url = '')
    {
        if (!$this->is_Login() && isset($_COOKIE['password'])) {
            $this->change_page($api_url);

        } else if ($this->is_Login() && !isset($_COOKIE['login_time'])) {
            $this->Destroy();
        }
    }

    public function Destroy()
    {
        session_destroy();
        $_SESSION = [];
    }

    public function setLog_in()
    {
        $_SESSION['is_login'] = true;
    }

    public function is_Login()
    {
        return isset($_SESSION['is_login']) ? $_SESSION['is_login'] : false;
    }

    public function Require_login_page(array $pages_url = [], $login_url = '')
    {
        if (!$this->is_Login()) {
            foreach ($pages_url as $value) {
                if (preg_match("/$value/i", $_SERVER['REQUEST_URI'])) {
                    $this->change_page($login_url);
                }
            }
        }
    }

    public function Require_logout_page(array $pages_url = [], $logout_url = '')
    {
        if ($this->is_Login()) {
            foreach ($pages_url as $value) {
                if (preg_match("/$value/i", $_SERVER['REQUEST_URI'])) {
                    $this->change_page($logout_url);
                }
            }
        }
    }

    public function Create_variable(array $var = [], array $content = [])
    {
        if ($content != []) {
            foreach ($var as $value) {
                $_SESSION[$value] = $content[$value];
            }
        } else {
            foreach ($var as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
    }

    public function get_var($name = '')
    {
        return (isset($_SESSION[$name])) ? $_SESSION[$name] : '';
    }
}

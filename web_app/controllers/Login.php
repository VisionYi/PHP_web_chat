<?php

class Login extends Controller
{

    public function Index()
    {
        $data['title'] = 'Login';
        $this->set_js(['/web_app/public/lib/angular-cookies/angular-cookies.min.js',
                        '/web_app/public/js/login/app.js']);
        $this->View('login/Index.html', '_shared/Layout.php', $data);
    }

    public function Logout()
    {
        setcookie("login_time", "", time() - 1, '/');
        setcookie("password", "", time() - 1, '/');

        require_once 'session/libs/Session.php';
        $Ses = new Session();
        $Ses->Destroy();

        $this->View('login/Logout.html');
    }
}

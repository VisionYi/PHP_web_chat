<?php

class Home extends Controller
{
    private $layoutView = '_shared/Layout.php';

    public function Index()
    {
        $data['title'] = 'Index';
        $this->set_js(['/web_app/public/js/home/app.js',
            '/web_app/public/js/home/jquery_scrolls.js']);
        $this->View('home/Index.html', $this->layoutView, $data);
    }

    public function About()
    {
        $data['title'] = 'About';
        $this->View('home/About.html', $this->layoutView, $data);
    }

    public function Contact()
    {
        $data['title'] = 'Contact';
        $this->View('home/Contact.html', $this->layoutView, $data);
    }
}

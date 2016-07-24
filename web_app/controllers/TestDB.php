<?php

class TestDB extends Controller {

    public function Index() {
        $data['title'] = 'TestDB';
        $this->set_js([ '/web_app/public/lib/angular-route/angular-route.min.js',
                        '/web_app/public/js/testDB/app.js',
                        '/web_app/public/js/testDB/service.js',
                        '/web_app/public/js/testDB/controller.js']);

		$this->View('testDB/Index.html', '_shared/Layout.php',$data);
    }
}

?>

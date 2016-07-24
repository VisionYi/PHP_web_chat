<?php
/**
 * @dateTime: 2016-06-12 21:19:07
 * @description: Register
 */
class Register extends Controller {

	public function Index() {
        $data['title'] = 'Register';
        $this->set_js([ '/web_app/public/lib/angular-messages/angular-messages.min.js',
                        '/web_app/public/js/register/app.js']);

        $this->View('register/Index.html','_shared/Layout.php',$data);
	}
}
?>

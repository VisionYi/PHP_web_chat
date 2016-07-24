<?php
/**
 * @dateTime: 2016-06-20 19:01:24
 * @description: 個人資料管理
 */
class UserSetting extends Controller {

    public function Index(){
        $data['title'] = '個人資料Profile';

        $this->set_css(['/web_app/public/lib/ng-img-crop/compile/unminified/ng-img-crop.css']);

        $this->set_js([ '/web_app/public/lib/angular-route/angular-route.min.js',
                        '/web_app/public/lib/ng-file-upload/ng-file-upload.min.js',
                        '/web_app/public/lib/angular-messages/angular-messages.min.js',
                        '/web_app/public/lib/ng-img-crop/compile/unminified/ng-img-crop.js',
                        '/web_app/public/js/userSetting/App.js',
                        '/web_app/public/js/userSetting/controller.js']);

        $this->View('userSetting/Index.html','_shared/Layout.php',$data);
    }
}
 ?>

var LoginApp = angular.module('LoginApp', ['ngCookies']);

// cookies [email]      只看'記住帳號'是否選取而存在
// cookies [login_time] 只要登入就會存在,登出就是不存在,如過有過期就是登出
// cookies [password]   只有在選取自動登入後才會存在,會過期
//
LoginApp.controller('LoginCtrl', ['$http','$filter','$cookies', function($http,$filter,$cookies) {
    var self = this;
    self.init = function() {
        self.isload = false;
        self.member = {auto_login:false};

        if($cookies.get('email')){
            self.member.email = $cookies.get('email');
            self.member.remember = true;
        }
    };

    self.log_in = function(data) {
        self.isload = true;
        if(data.remember){
            SetCookies({'email':data.email} ,3*3600*24);
        }else{
            $cookies.remove('email');
        }

        data.last_datetime = $filter('date')(new Date(), 'yyyy-MM-dd HH:mm:ss');
        $http.post('/api/Log_in/member', data)
            .success(function(response) {
                if (response.code) {
                    alert("登入成功!\n歡迎 " + response.nickname + " 大人!!");

                    if(data.auto_login){
                        SetCookies({'login_time':data.last_datetime,'password':response.password},7*3600*24);
                    }else{
                        $cookies.put('login_time',data.last_datetime);
                    }
                    window.history.back();
                } else {
                    self.isload = false;
                    alert("登入失敗!\n 密碼或帳號有錯喔!!");
                }
            }).error(function(error) {
                alert("資料庫載入失敗!\n" + error);
            });
    };

    // 設置cookies過期時間,由現在秒數+Seconds
    var SetCookies = function(cookies_object ,time) {
        var expire = new Date();
        expire.setSeconds(expire.getSeconds() + time);

        for(var key in cookies_object){
            if (cookies_object.hasOwnProperty(key)) {
                $cookies.put(key,cookies_object[key], {'expires': expire});
            }
        }
    };
}]);

// var LogoutApp = angular.module('LogoutApp', []);
// LogoutApp.controller('LogoutCtrl', ['$http', function($http) {
//     $http.get('/api/Log_out/member').success(function(response) {
//         if (response.code) alert("登出成功!");
//         window.history.back();
//     });
// }]);

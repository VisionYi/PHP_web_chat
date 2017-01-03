var registerApp = angular.module('RegisterApp', ['ngMessages']);

registerApp.controller('RegisterCtrl', ['$filter', '$http', function($filter, $http) {
    var self = this;
    self.member = {};

    self.add = function(data) {
        if (self.agree) {
            data.identity = 'general';
            data.birthday = $filter('date')(data.birthday, 'yyyy-MM-dd');

            $http.post('/api/Register/member', data)
                .success(function(response) {
                    if (response.code) {
                        alert("註冊成功! 可進行登入");
                        window.location.href = '/login';
                    } else {
                        alert("有錯誤: " + response.error);
                    }
                }).error(function(error) {
                    alert("資料庫載入失敗!\n" + error);
                });
        }
    };
}]);

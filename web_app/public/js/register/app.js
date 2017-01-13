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
                        self.showDialog('提示', '註冊成功! 可進行登入');
                        window.location.href = '/login';
                    } else {
                        self.showDialog('錯誤', "有錯誤: " + response.error);
                    }
                }).error(self.showError);
        }
    };

    self.showError = function() {
        self.showDialog('錯誤', '資料庫載入失敗!');
    };

    self.showDialog = function(title, content) {
        $('#dialog-title').text(title);
        $('#dialog-content').text(content);
        $('#dialog').modal('show');
    };
}]);

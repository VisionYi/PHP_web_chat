var UserSettingApp = angular.module('UserSettingApp', ['ngRoute' ,'ngMessages','ngFileUpload', 'ngImgCrop']);

UserSettingApp.config(['$routeProvider',function($routeProvider) {
    var View_urlBace = 'web_app/views/userSetting/';
    $routeProvider
        .when('/profile', {
            templateUrl : View_urlBace + 'profile.html',
            controller : 'ProfileCtrl',
            controllerAs: 'P_ctrl',
        })
        .when('/p_pictice', {
            templateUrl : View_urlBace + 'p_picture.html',
            controller : 'P_pictureCtrl',
            controllerAs: 'Pi_ctrl',
        }).otherwise({
            redirectTo: '/profile'
        });
        // $locationProvider.html5Mode(true);
}]);

UserSettingApp.run(['$route', function($route)  {
  $route.reload();
}]);

var app = angular.module('TestDB_App', ['ngRoute']);

app.config(['$routeProvider',function($routeProvider) {
    var View_urlBace = 'web_app/views/testDB/';
    $routeProvider
        .when('/', {
            templateUrl : View_urlBace + 'search.html',
            controller : 'SearchCtrl',
            controllerAs: 'S_ctrl',
        })
        .when('/add', {
            templateUrl : View_urlBace + 'add.html',
            controller : 'AddCtrl',
            controllerAs: 'A_ctrl',
        })
        .when('/edit/:id', {
            templateUrl : View_urlBace + 'edit.html',
            controller : 'EditCtrl',
            controllerAs: 'E_ctrl',
        }).otherwise({
            redirectTo: '/'
        });
}]);

app.run(['$route', function($route)  {
  $route.reload();
}]);

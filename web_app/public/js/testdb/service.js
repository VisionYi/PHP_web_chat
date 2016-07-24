app.factory('dataFactory', ['$http', function($http) {
    var dataFactory = {};

    dataFactory.getAllData = function(table) {
        return $http.get('/api/Get/' + table);
    };
    dataFactory.getOneData = function(table, id) {
        return $http.get('/api/Get/' + table + '/' + id);
    };
    dataFactory.addData = function(table, data) {
        return $http.post('/api/Add/' + table, data);
    };
    dataFactory.updateData = function(table, data) {
        return $http.post('/api/Update/' + table, data);
    };
    dataFactory.deleteData = function(table, id) {
        return $http.delete('/api/Delete/' + table + '/' + id);
    };

    return dataFactory;
}]);

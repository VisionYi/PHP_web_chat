
app.controller('SearchCtrl',['$route','dataFactory',function($route,dataFactory) {
    var self = this;
    document.title = 'TestDB查詢資料';

    self.init = function() {
        self.caret = 'fa fa-caret-down';
        self.reverse = true;
        self.isload = true;
        dataFactory.getAllData('pdotest')
            .success(function(data) {
                self.isload = false;
                self.friends = data;
                self.number = data.length;
            }).error(function(error) {
                alert("資料庫載入失敗!\n" + error);
            });
    };

    self.orderBy = function(select) {
       self.order_by = select;
       self.reverse = !self.reverse;
       self.caret = self.reverse? 'fa fa-caret-up':'fa fa-caret-down';
    };

    self.delete = function(person) {
        dataFactory.deleteData('pdotest',person.id)
            .success(function(response) {
                if(response.code)  alert("編號:"+ person.id +" 刪除成功!! ");

                // 搜尋你刪除的那一個,不用再重新整理
                self.friends.splice(self.friends.indexOf(person) ,1);
                self.number--;
                // $route.reload();  //reload route page
            }).error(function(error) {
                alert("資料庫載入失敗!\n" + error);
            });
    };
}]);

app.controller('AddCtrl',['dataFactory','$location', function(dataFactory,$location){
    var self = this;
    document.title = 'TestDB新增資料';

    self.add = function(friend) {
        dataFactory.addData('pdotest',friend)
        .success(function(response) {
            if(response.code){
                alert('新增一筆資料\n id: '+ response.lastId +'\n name: '+friend.name);
                $location.path('/');
            }
        }).error(function(err) {
            alert("資料庫載入失敗!\n" + err);
        });
    };
}]);

app.controller('EditCtrl',['$routeParams','dataFactory','$location',function($routeParams,dataFactory,$location){
    var self = this;
    document.title = 'TestDB修改資料';

    self.init = function() {
        dataFactory.getOneData('pdotest',$routeParams.id)
            .success(function(data) {
                data.age = parseInt(data.age);
                self.friend = data;
            }).error(function(err) {
                alert("資料庫載入失敗!\n" + err);
            });
    };

    self.edit = function(person) {
        dataFactory.updateData('pdotest',person)
        .success(function(response) {
            if(response.code){
                alert('修改成功\n name:'+ person.name +'\n age:'+person.age +'\n skills:'+person.skills);
                $location.path('/');
            }
        }).error(function(err) {
            alert("資料庫載入失敗!\n" + err);
        });
    };
}]);

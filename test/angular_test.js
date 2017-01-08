
// /* Search query & Delete*/
// app.controller('SearchCtrl', ['$http','$route', function($http,$route) {
//     var self = this;
//     self.friends = "";
//     self.caret = 'fa fa-caret-down';
//     self.reverse = true;
//     self.orderBy = function(select) {
//        self.order_by = select;
//        self.reverse = !self.reverse;
//        self.caret = self.reverse? 'fa fa-caret-up':'fa fa-caret-down';
//     };
//     self.delete = function(_id) {
//         $http.post('database/deleteData.php', {id:_id})
//         .success(function(response) {
//             if(response.success)  alert("編號:"+_id+" 刪除成功!!");

//             $route.reload();    //reload route page
//         });
//     };
//     $http.get('database/getAllData.php')
//     .success(function(data) {
//         self.friends = data;
//         self.number = data.length;
//     });
// }]);

// /* Add insert */
// app.controller('AddCtrl', ['$http', function($http){
//     var self = this;

//     self.add = function() {
//         $http.post('database/addData.php', {name:self.name ,age:self.age ,skills:self.skills})
//         .success(function(response) {
//             if(response.success){
//                 alert('新增一筆資料\n id: '+ response.lastId +'\n name: '+self.name);
//             }
//         }).error(function(err) {
//             alert("失敗!\n" + err);
//         });
//     };
// }]);

// /* Edit update */
// app.controller('EditCtrl', ['$http','$routeParams', function($http,$routeParams){
//     var _id = $routeParams.id;
//     var self = this;
//     self.friend ={};

//     $http.post('database/searchData.php',{id:_id})
//         .success(function(data) {
//             self.friend = data;
//         });
//     self.edit = function() {
//         $http.post('database/editData.php', self.friend)
//         .success(function(response) {
//             if(response.success){
//                 alert('修改成功\n name:'+ self.friend.name +'\n age:'+self.friend.age +'\n skills:'+self.friend.skills);
//             }
//         });
//     };
// }]);

UserSettingApp.controller('ProfileCtrl', ['$http','$filter', function($http,$filter){
    var self = this;
    self.init = function() {
        $http.get('/api/Get/member/session_id')
            .success(function(data) {
                data.password = '';
                self.member = data;

            }).error(function(err) {
                alert("資料庫載入失敗!\n" + err);
            });
    };

    self.update = function(data) {
        if(data.password === ''){
            delete data.password;
        }
        $http.post('/api/Update/member', data)
            .success(function(response) {
                if(response.code) alert('修改成功');
                window.location.reload();
            }).error(function(err) {
                alert("資料庫載入失敗!\n" + err);
            });
    };
}]);


UserSettingApp.controller('P_pictureCtrl', ['Upload', function(Upload){
    var self = this;
    self.pictureFile = '';
    self.croppedImageUrl = '';

    self.sel_file = function(file, _error) {
        self.pictureFile = file;

        if (_error[0]) {
            self.errorFile = _error[0];
        } else
            self.errorFile = undefined;
    };

    self.submit = function(fileUrl, name) {
        var files = Upload.dataUrltoBlob(fileUrl, name);
        Upload.upload({
            url: '/api/UploadFile/member/session_id',
            file: files,
            fields: {
                data: [{'save_name':'profile_picture', 'save_path':'web_app/public/uploadFiles'}]
            }
        }).progress(function(evt) {
            self.progress = parseInt(100.0 * evt.loaded / evt.total);
        }).success(function(response) {
            if (response.code) {
                alert("頭貼設置成功!");
                window.location.reload();
                window.location.href = '/userSetting#/profile';
            }
        }).error(function(error) {
            alert("資料庫載入失敗!\n" + error);
        });
    };
}]);

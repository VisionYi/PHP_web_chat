<?php
/* 需要 待修改成 try {} */

class Api extends WebApi
{
    private $DB;
    private $SessionLib = 'session/libs/Session.php';

    public function __construct()
    {
        require_once 'database/libs/MyPDO.php';
        $this->DB = new MyPDO();

        // Debug: 檢測SQL的語法錯誤
        // $this->DB->debugDB_SQL = true;
    }

    public function __destruct()
    {
        $this->DB->closeDB();

        // Debug: 檢測印出的資訊是否符合JSON格式，使用JavaScript的console.error()
        // $this->check_json_error_log();

        // Debug: 檢測印出的資訊是否符合JSON格式，使用HTTP header顯示錯誤代碼與資訊
        // $this->check_json_error_header(500, "Internal Server Error!!");

        exit();
    }

    public function Get($table = '', $id = '')
    {
        if ($id == 'session_id') {
            require_once $this->SessionLib;
            $Ses = new Session();

            // 已存在session['id']
            $id = $Ses->get_var('id');

            $result = $this->DB->dbQuery("SELECT * FROM $table WHERE id=$id");
            $this->output($result[0]);

        } else if ($id == '') {
            $result = $this->DB->dbQuery("SELECT * FROM $table ");
            $this->output($result);
        } else {
            $result = $this->DB->dbQuery("SELECT * FROM $table WHERE id=$id");
            $this->output($result[0]);
        }
    }

    public function Add($table = '')
    {
        $data = $this->get_postData();
        $lastId = $this->DB->dbInsert($table, $data);

        $this->output(['code' => 1, 'lastId' => $lastId]);
    }

    public function Update($table = '')
    {
        $data = $this->get_postData();

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        if ($table == 'member') {
            require_once $this->SessionLib;
            $Ses = new Session();
            $Ses->Create_variable(['nickname' => $data['nickname']]);
        }

        $this->DB->dbUpdate($table, $data, "id = {$data['id']}");
        $this->output(['code' => 1]);
    }

    public function Delete($table = '', $id = '')
    {
        $this->DB->dbDelete($table, "id={$id}");
        $this->output(['code' => 1]);
    }

    public function Register($table = '')
    {
        $data = $this->get_postData();
        $isRepeat = $this->DB->dbQuery("SELECT id FROM $table WHERE email=:_email", [':_email' => $data['email']]);

        if (empty($isRepeat)) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            // 預設頭貼
            $data['profile_picture'] = "/web_app/public/uploadFiles/profile_picture-0.jpg";
            $lastId = $this->DB->dbInsert($table, $data);
            $this->output(['code' => 1, 'lastId' => $lastId]);
        } else {
            $this->output(['code' => 0, 'error' => "帳號已重複!!"]);
        }
    }

    public function Log_in($table = '')
    {
        $data = $this->get_postData();

        $sql = "SELECT * FROM $table WHERE email=:_email";
        $result = $this->DB->dbQuery($sql, [':_email' => $data['email']]);

        if (!empty($result)) {
            $result = $result[0];
            // password_verify 是Bcrypt加密密碼的驗證
            $is_conform = password_verify($data['password'], $result['password']);
        } else {
            $is_conform = false;
        }

        if ($is_conform) {
            $where = "id = {$result['id']}";
            // 更新登入最後時間
            $this->DB->dbUpdate($table, ['last_datetime' => $data['last_datetime']], $where);

            require_once $this->SessionLib;
            $Ses = new Session();
            $Ses->Create_variable(['id', 'nickname', 'profile_picture', 'identity'], $result);
            $Ses->setLog_in();

            $this->output([
                'code'     => 1,
                'nickname' => $result['nickname'],
                'password' => $result['password']
            ]);
        } else {
            // 回傳錯誤的訊息
            $this->output(['code' => 0]);
        }
    }

    public function AutoLogin($table = '')
    {
        $password = isset($_COOKIE['password']) ? trim($_COOKIE['password']) : '';
        $sql = "SELECT * FROM $table WHERE password=:password";
        $result = $this->DB->dbQuery($sql, [':password' => $password]);

        require_once $this->SessionLib;
        $Ses = new Session();

        if (!empty($result)) {
            $result = $result[0];
            $Ses->Create_variable(['id', 'nickname', 'profile_picture', 'identity'], $result);
            $Ses->setLog_in();
        }

        //return the page
        header('location: ' . getenv("HTTP_REFERER"));
    }

    public function UploadFile($table = '', $id = '')
    {
        require_once 'file_upload/libs/FileUpload.php';
        $file = new FileUpload('file');

        $data = $_POST['data'][0];

        if ($id == 'session_id') {
            require_once $this->SessionLib;
            $Ses = new Session();
            $id = $Ses->get_var('id');
        }

        if (isset($data['save_name'])) {
            $fileName = $data['save_name'] . "-$id";
            $file_path = $file->saveFile($fileName, $data['save_path']);
        } else {
            $file_path = $file->saveFile(null, $data['save_path']);
        }

        $this->DB->dbUpdate($table, [$data['save_name'] => "/$file_path"], "id = {$id}");
        $this->output(['code' => 1]);

        if ($id == 'session_id') {
            $Ses->Create_variable([$data['save_name'] => "/$file_path"]);
        }

        unset($file_path);
        unset($fileName);
    }
}

<?php
/* 需要 待修改成 try {} */

class Api extends DB_Api {

	private $DB;

    function __construct() {
        require_once 'database/libs/MyPDO.php';
        $this->DB = new MyPDO();
        // $this->DB->debugDB_SQL = true;

        ob_start();
    }

    function __destruct() {
        $this->DB->closeDB();
        // $this->check_json_error_log();
        // $this->check_json_error_header(500, "Internal Server Error!!");

        // ob_end_clean();
        exit();
    }

    public function Get($table = '', $id = '') {
        if ($id == 'session_id') {
            require_once 'session/libs/Session.php';
            $Ses = new Session();
            $id = $Ses->get_var('id');            // 已存在session['id']

            $result = $this->DB->dbQuery("SELECT * FROM $table WHERE id=$id");
            $this->output($result[0]);

        } else if ($id == '') {
            $result = $this->DB->dbQuery("SELECT * FROM $table ");

            // var_dump($result);
            $this->output($result);
        } else {
            $result = $this->DB->dbQuery("SELECT * FROM $table WHERE id=$id");
            $this->output($result[0]);
        }
    }

	public function Add($table = '') {
		$data = $this->get_postData();
		$lastId = $this->DB->dbInsert($table, $data);

		$this->output(['code' => 1, 'lastId' => $lastId]);
	}

	public function Update($table = '') {
		$data = $this->get_postData();

		if (isset($data['password'])) {
			$data['password'] = password_hash($data['password'] ,PASSWORD_BCRYPT);
		}

		if ($table == 'member') {
			require_once 'session/libs/Session.php';
			$Ses = new Session();
			$Ses->Create_variable(['nickname' => $data['nickname']]);
		}

		$this->DB->dbUpdate($table, $data, "id = {$data['id']}");
		$this->output(['code' => 1]);
	}

	public function Delete($table = '', $id = '') {
		$this->DB->dbDelete($table, "id={$id}");
		$this->output(['code' => 1]);
	}
	public function Register($table = '') {
		$data = $this->get_postData();
		$isRepeat = $this->DB->dbQuery("SELECT id FROM $table WHERE email=:_email", [':_email' => $data['email']]);

		if (empty($isRepeat)) {
			$data['password'] = password_hash($data['password'] ,PASSWORD_BCRYPT);
			// 預設頭貼
			$data['profile_picture'] = "/web_app/public/uploadFiles/profile_picture-0.jpg";
			$lastId = $this->DB->dbInsert($table, $data);
			$this->output(['code' => 1, 'lastId' => $lastId]);
		} else {
			$this->output(['code' => 0, 'error' => "帳號已重複!!"]);
		}
	}

	public function Log_in($table = '') {
		sleep(1);
		$data = $this->get_postData();

		$sql = "SELECT * FROM $table WHERE email=:_email";
		$result = $this->DB->dbQuery($sql, [':_email' => $data['email']]);

        if(!empty($result)){
            $result = $result[0];
            // password_verify 是Bcrypt加密密碼的驗證
            $is_conform = password_verify($data['password'], $result['password'] );
        }else{
            $is_conform = false;
        }

        if ($is_conform) {
            $where = "id = {$result['id']}";
            // 更新登入最後時間
            $this->DB->dbUpdate($table, ['last_datetime' => $data['last_datetime']], $where);

			require_once 'session/libs/Session.php';
			$Ses = new Session();
			$Ses->Create_variable(['id', 'nickname', 'profile_picture', 'identity'], $result);
			$Ses->setLog_in();

			$this->output(['code' => 1,
                           'nickname' => $result['nickname'],
                           'password' => $result['password'] ]);
		} else {
			// 回傳錯誤的訊息
			// header("HTTP/1.0 403 Forbidden") ;
			$this->output(['code' => 0]);
		}
	}

	public function AutoLogin($table = '') {
        $password = isset($_COOKIE['password']) ? trim($_COOKIE['password']): '';
        $sql = "SELECT * FROM $table WHERE password=:password";
        $result = $this->DB->dbQuery($sql,[ ':password' => $password]);

        require_once 'session/libs/Session.php';
        $Ses = new Session();

		if (!empty($result)) {
			$result = $result[0];
			$Ses->Create_variable(['id', 'nickname', 'profile_picture', 'identity'], $result);
			$Ses->setLog_in();
		}
		header('location: ' . getenv("HTTP_REFERER")); //return the page
	}

	public function UploadFile($table = '', $id = '') {
		require_once 'file_upload/libs/FileUpload.php';
		$file = new FileUpload('file');

        $data = $_POST['data'][0];

        if ($id == 'session_id') {
            require_once 'session/libs/Session.php';
            $Ses = new Session();
            $id = $Ses->get_var('id');
        }

		if (isset($data['save_name'])) {
			$fileName = $data['save_name'] . "-$id";
            $file_path = $file->saveFile($fileName, $data['save_path']);
        } else {
            $file_path = $file->saveFile(NULL, $data['save_path']);
        }

		$this->DB->dbUpdate($table, [$data['save_name'] => "/$file_path"],"id = {$id}");
        $this->output(['code' => 1]);

        if($id == 'session_id'){
            $Ses->Create_variable([$data['save_name'] => "/$file_path"]);
        }

        unset($file_path);
        unset($fileName);
	}
}
?>

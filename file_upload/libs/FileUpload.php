<?php
/**
 * @dateTime: 2016-06-19 09:05:22
 * @description: file upload 函式庫
 */
class FileUpload {
	private $_name, $_type, $_sizeMB;
	private $tmp_name;

	function __construct($file_field = '') {
		// 最大上傳size為200MB , 最大上傳個數為20件
		// 可在php.ini 修改下列數值
		// upload_max_filesize
		// post_max_size
		// max_file_uploads

		$this->_name = $_FILES[$file_field]['name'];
		$this->_type = $_FILES[$file_field]['type'];
		$this->_sizeMB = round($_FILES[$file_field]['size'] / 1024000, 3);
		$this->tmp_name = $_FILES[$file_field]['tmp_name'];
		// 設置時區
		date_default_timezone_set('Asia/Taipei');
	}

	public function is_type(array $type = []) {
		foreach ($type as $value) {
			if ($this->_type == $value) {
				return true;
			}
		}
		return false;
	}

	public function saveFile($saveName = '', $savePath = '') {
		// 取附檔名
		$file_extension = strtolower(pathinfo($this->_name, PATHINFO_EXTENSION));
		$file_name = pathinfo($this->_name, PATHINFO_FILENAME);

		if (isset($saveName)) {
			// 中文名儲存
			$baseName = iconv("UTF-8", "BIG-5", $saveName) . ".$file_extension";
		} else {
			$baseName = iconv("UTF-8", "BIG-5", $this->_name);
			if (file_exists("$savePath/$baseName")) {
				$baseName = $file_name . "-[" . date('Ymd') . "_" . date('His') . "].$file_extension";
			}
		}
		move_uploaded_file($this->tmp_name, "$savePath/$baseName");
		unset($file_extension);

		return "$savePath/$baseName";
	}

	public function get_name() {return $this->_name;}
	public function get_sizeMB() {return $this->_sizeMB;}
	public function get_type() {return $this->_type;}
}
?>

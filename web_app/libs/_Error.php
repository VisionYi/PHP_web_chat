<?php
/**
 * 有錯誤就顯示 Error頁面
 */
class _Error extends Controller
{
    private $errorCode;
    private $_file;

    /**
     * 呼叫 views資料夾(也可自訂路徑)下的Error檔案
     *
     * @param string $file   錯誤的檔案名稱或路徑
     * @param string $code   錯誤代碼
     */
    public function page404($file, $code)
    {
        if (ERROR_View != '') {
            $this->errorCode = $code;
            $this->_file = $file;

            $data['title'] = 'Error 404';
            $this->View(ERROR_View, ERROR_Layout, $data);
            exit();
        }
    }

    /**
     * 此function是給Error.php使用的
     * 顯示出個別的錯誤訊息.
     */
    public function error_message()
    {
        switch ($this->errorCode) {
            case 1:
                echo "<b>[Controller]</b> The file: $this->_file.php does not exists .<br>";
                break;
            case 2:
                echo "<b>[Controller]</b> The function: $this->_file() does not exists .<br>";
                break;
            case 3:
                echo "<b>[Model]</b> The file: $this->_file.php does not exists .<br>";
                break;
            case 4:
                echo "<b>[View]</b> The file: $this->_file does not exists .<br>";
                break;
            default:
                echo "<b>Expection Error!!!</b>";
                break;
        }
    }
}

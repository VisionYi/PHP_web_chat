<?php
/* 使用者進入 無須登入*/
session_start();
echo 'Welcome 首頁 <br><br><br>' ;

if(isset($_SESSION['ID'])){
    echo "<br>ID 存在, 已登入!! <br>";
    var_dump ($_SESSION );
}else
    echo "ID 不存在, 需要登入喔!!!!! <br>";

echo '<br><br><a href="test_login.php">使用者登入</a>' ;

/* 使用者登出  */
// session_destroy();
// setcookie(session_name(),'', time()-3600);
// $_SESSION = array();
?>

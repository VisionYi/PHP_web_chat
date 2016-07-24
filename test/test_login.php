<?php
/* 使用者登入 */
// $lifetime = 10;
// session_set_cookie_params($lifetime);
session_start();
// session_regenerate_id();
echo 'Welcome 登入開始  <br><br>' ;


$_SESSION['SessionID'] = session_id();
$_SESSION['ID'] = 'AA11' ;
$_SESSION['time'] = time();

if(isset($_SESSION ['ID'])){
    echo "ID 存在, 已登入!! <br>";
    var_dump ($_SESSION );
}else
    echo "ID 不存在, 需要登入喔!!!!! <br>";


echo '<br><br><a href="page_home.php">進入首頁</a>' ;
?>



<?php
    require_once 'session/libs/Session.php';
    $Ses = new Session();
    $Ses->cookies_verify_login('/api/AutoLogin/member');
    $Ses->Require_Logout_page(['Login' ,'Register' ],'/Home');
    $Ses->Require_Login_page(['UserSetting'],'/Home');

    if($Ses->is_Login()):
?>
    <li><a href='/Login/Logout'>登出</a></li>
    <li class='ss-ver-divider'></li>
    <li class='dropdown'>
        <a class='dropdown-toggle' data-toggle='dropdown' title='profile'>
            <img class="ss-profile-pic" src="<?php echo $_SESSION['profile_picture'];?>">
            <b><?php echo $_SESSION['nickname']; ?> </b>
            <span class='caret'></span>
        </a>
        <ul class='dropdown-menu'>
            <li><a href='/UserSetting'>個人資料</a></li>
            <!-- <li><a>我的圖片.作品</a></li>
            <li class='divider'></li>
            <li><a>訊息箱</a></li> -->
        </ul>
    </li>

<?php else: ?>

    <li><a href='/Register'>註冊</a></li>
    <li class='ss-ver-divider'></li>
    <li><a href='/Login'>登入</a></li>

<?php endif ?>

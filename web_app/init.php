<?php
// initial 所有底層資料夾設定

// 預設根目錄
define('ROOT_PATH', 'web_app');
define('ERROR_VIEW', 'Error.php');
define('ERROR_LAYOUT', '_shared/Layout.php');

// Auto loading all library php file
require_once 'libs/App.php';
require_once 'libs/Controller.php';
require_once 'libs/ErrorPage.php';
require_once 'libs/WebApi.php';

$app = new App();

 ?>

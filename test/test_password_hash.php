<?php

$password = 'adminAA' ;
$hash = password_hash($password ,PASSWORD_BCRYPT);
echo  $hash .'<br>';

$res = password_verify( 'adminAA' , $hash );
if($res)
var_dump( $res );

 ?>

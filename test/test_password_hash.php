<?php

$password = 'abc123' ;
$hash = password_hash($password ,PASSWORD_BCRYPT);
echo  $hash .'<br>';

$res = password_verify( 'abc123' , $hash );
if($res)
var_dump( $res );

 ?>

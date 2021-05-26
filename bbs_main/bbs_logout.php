<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();

// ステータスコードを出力
http_response_code( 301 ) ;
// リダイレクト
header( "Location: ..\bbs_login\bbs_login.html" ) ;
exit();
?>
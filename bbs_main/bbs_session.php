<?php
try
{
ini_set("session.cookie_secure", 1);
session_start();
session_regenerate_id(true);

header( "Location: bbs_main.php" ) ;

}

catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>
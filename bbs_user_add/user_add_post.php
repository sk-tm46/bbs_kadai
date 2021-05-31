<?php
try
{
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$bbs_pass = $_POST['pass'];
$_POST['pass'] = md5($bbs_pass);

$post=sanitize($_POST);
$bbs_name=$post['name'];
$bbs_pass=$post['pass'];

$dsn = 'mysql:dbname=bbs;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'INSERT INTO mst_user(name,pass) VALUES (?,?)';
$stmt = $dbh->prepare($sql);
$data[] = $bbs_name;
$data[] = $bbs_pass;
$stmt->execute($data);

$dbh = null;

// ステータスコードを出力
http_response_code( 301 ) ;
// リダイレクト
header( "Location: bbs_post_done.php" ) ;
exit();
}

catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>
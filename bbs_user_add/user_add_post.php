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
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$sql = 'INSERT INTO mst_user(name,pass) VALUES (:name,:pass)';
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $bbs_name, PDO::PARAM_STR);
$stmt->bindValue(':pass', $bbs_pass, PDO::PARAM_STR);
$stmt->execute();

$dbh = null;

// ステータスコードを出力
http_response_code( 301 ) ;
// リダイレクト
header( "Location: bbs_post_done.php" ) ;
exit();
}

catch (Exception $e)
{
print $e;
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>
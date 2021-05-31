<?php
try
{
session_start();
session_regenerate_id(true);
require_once('../common/common.php');

$post=sanitize($_POST);
$bbs_comment=$post['comment'];
$bbs_photo=$_FILES['photo'];

if( $bbs_photo != null)
{
	move_uploaded_file($bbs_photo['tmp_name'],'./gazou/'.$bbs_photo['name']);
	$bbs_photo=$bbs_photo['name'];
}
else
{
	$bbs_photo='';
}

$dsn = 'mysql:dbname=bbs;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'INSERT INTO mst_bbs(comment,image) VALUES (?,?)';
$stmt = $dbh->prepare($sql);
$data[] = $bbs_comment;
$data[] = $bbs_photo;
$stmt->execute($data);

$dbh = null;

// ステータスコードを出力
http_response_code( 301 ) ;
// リダイレクト
header( "Location: bbs_main.php" ) ;
exit();
}

catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>
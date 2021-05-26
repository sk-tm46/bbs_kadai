<?php
try
{

require_once('../common/common.php');

$post=sanitize($_POST);
$bbs_name=$post['name'];
$bbs_pass=$post['pass'];

$bbs_pass=md5($bbs_pass);

$dsn = 'mysql:dbname=bbs;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql='SELECT name FROM mst_user WHERE name=\'?\' AND pass=\'?\'';
$stmt=$dbh->prepare($sql);
$data[]=$bbs_name;
$data[]=$bbs_pass;
$stmt->execute($data);

$dbh = null;

$rec = $stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
	echo $bbs_name;
	echo $bbs_pass;
	print 'ユーザー名またはパスワードが間違っています。<br />';
	print '<a href="bbs_login.html">戻る</a>';
}
else
{
	session_start();
	$_SESSION['login']=1;
	$_SESSION['member_name']=$rec['name'];
	header('Location: ..\bbs_main\bbs_main.php');
	exit();
}
}

catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>
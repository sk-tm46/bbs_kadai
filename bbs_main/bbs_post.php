<?php
try
{
session_start();
session_regenerate_id(true);
require_once('../common/common.php');

$post=sanitize($_POST);
$bbs_comment=$post['comment'];
$bbs_photo=$_FILES['photo'];
$bbs_name=$_SESSION['member_name'];

$reply_judg = substr($bbs_comment, 0, 2);
if($reply_judg == ">>")
{
	$i = 3;
	$no = "";
	while(true)
	{
		//i文字目を取り出す
		$reply_no_judg = substr($bbs_comment, $i, 1);
		
		//数字か判定
		if(is_numeric($bbs_comment)
		{
			$no = $no . $reply_no_judg;
		}
		else
		{
			//数字ではない場合抜ける
			$bbs_replyno = $no;
			break;
		}
		$i = $i + 1;
	}
}


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

$sql = 'INSERT INTO mst_bbs(comment,image,name,replyno) VALUES (?,?,?,?)';
$stmt = $dbh->prepare($sql);
$data[] = $bbs_comment;
$data[] = $bbs_photo;
$data[] = $bbs_name;
$data[] = $bbs_replyno;
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
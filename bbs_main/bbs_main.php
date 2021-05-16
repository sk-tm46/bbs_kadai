<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print 'ゲストさん';
	print '<a href="..\bbs_login\bbs_login.html"> ログイン </a><br />';
	print '<br/>';
}
else
{
	print $_SESSION['member_name'];
	print 'さん　';
	print '<a href="..\bbs_login\bbs_logout.php"> ログイン中</a><br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ふれあい掲示板 </title>
</head>
<body>
TYS掲示板<br/>
<br/>
コメント<br/>

<form method="post" enctype="multipart/form-data">
<input type="text" name="comment" style"width:200px"><br/>
<input type="file" name="photo" style"width:400px">
<input type="submit" formaction="bbs_post.php" name="svpost" value="投稿"><br/>
<input type="submit" formaction="bbs_reload.php" name="add" value="最新を読み込む">
</form>
</body>
</html>
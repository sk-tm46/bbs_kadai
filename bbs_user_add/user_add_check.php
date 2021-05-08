<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
	print 'ログインされていません。 <br />';
	print '<a href="../bbs_login/bbs_login.html"> ログイン画面へ </a>';
	exit();
}
else
{
	print $_SESSION['name'];
	print 'さんログイン中 <br />';
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

<?php

$post=sanitize($_POST);
$bbs_name=$post['name'];
$bbs_pass=$post['pass'];
$bbs_pass2=$post['pass2'];

//ユーザー名文字数
$name_len=mb_strlen($bbs_name);

//パスワード文字数
$pass_len=mb_strlen($bbs_pass);
$pass_wdt=mb_strwidth($bbs_pass);

if($bbs_name=='')
{
	print 'ユーザー名が入力されていません。 <br />';
}
else if($name_len>=31)
{
	print '30字以内で入力してください。 <br />';
}
else
{
	print '	ユーザー名：';
	print $bbs_name;
	print '<br />';
}

if($bbs_pass=='')
{
	print 'パスワードが入力されていません。 <br />';
}
else if($pass_len!=$pass_wdt)
{
	print 'パスワードは半角英数字の15文字以内で入力してください。 <br />';
}

if($bbs_pass!=$bbs_pass2)
{
	print 'パスワードが一致しません。 <br />';
}


?>

</body>
</html>
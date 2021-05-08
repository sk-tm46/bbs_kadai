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
	print '<a href="bbs_logout.php"> ログイン中</a><br />';
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
<input type="text" name="comment" style"width:200px"><br/>
<input type="file" name="photo" accept='image/*' onchange="previewImage(this);">
<p>
Preview:<br>
<img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:200px;">
</p>
//<?php
//function bbs_reload()
//{
//	print 'こんにちは';
//}
//?>

<script>
function previewImage(obj)
{
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
}

</script>
<input type="submit" value="投稿">
<input type="button" value="最新の投稿を読み込む" onclick="bbs_reload()" >
</body>
</html>
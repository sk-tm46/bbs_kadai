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

<?php
//投稿内容を取得する
try{
$dsn = 'mysql:dbname=bbs;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * FROM mst_bbs WHERE 1';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

$count = 0;

while(true)
{
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($rec==false)
	{
		break;
	}
	$bbs_post_no[$count] = $rec['no'];
	$bbs_post_name[$count] = $rec['name'];
	$bbs_post_date[$count] = $rec['date'];
	$bbs_post_comment[$count] = $rec['comment'];
		if($rec['image']=='')
		{
			$bbs_post_image[$count]='';
		}
		else
		{
			$bbs_post_image[$count]='<img src="gazou/'.$rec['image'].'" width="400" height="250">';
		} //else終わり
	$count = $count + 1;
}

$bbs_post_count = count($bbs_post_no);

}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

TYS掲示板<br/>
<br/>
コメント<br/>
<form method="post" enctype="multipart/form-data">
<input type="text" name="comment" style"width:200px"><br/>
<input type="file" name="photo" id="sFiles"  style"width:400px">
<input type="submit" formaction="bbs_post.php" name="svpost" value="投稿"><div id="photoMess"></div><br/>
<table border="1">
<?php for($i=0;$i<$bbs_post_count;$i++)
{
?>
	<tr>
	<td><?php print $bbs_post_no[$i];
	print ':';
	print $bbs_post_name[$i];
	print ':';
	print $bbs_post_date[$i]; ?><br/>

	<?php print $bbs_post_comment[$i]; ?>
	
	<?php if($bbs_post_image[$i] != "")
	{
		print $bbs_post_image[$i];
	 } ?>	
	</tr>
<?php
}
?>
</table>

<input type="submit" formaction="bbs_main.php" name="reload" value="最新を読み込む"><br/>
<script>
function checkPhotoInfo()
{
//ファイルサイズ取得
var fileList = document.getElementById("sFiles").files;
var list = "";
for(var i=0; i<fileList.length; i++){
list += "[" + fileList[i].size + " bytes]" + fileList[i].name + "<br>";
}
if(list != null){
	if( list > 1000000)
	{
	document.getElementById("photoMess").innerText = "画像が大き過ぎます。";
	return false;
	}
}

}
</script>

</form>
</body>
</html>
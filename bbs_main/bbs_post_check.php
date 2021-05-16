<?php
session_start();
session_regenerate_id(true);
?>

<?php
$post=sanitize($_POST);
$bbs_comment=$post['comment'];
$bbs_photo=$_FILES['photo'];
$bbs_photo_name = $_FILES['photo']['name']; 
$bbs_user=$post['userid'];

if( $pro_gazou['size'] > 0)
{
	if( $pro_gazou['size'] > 1000000)
	{
		print '画像が大き過ぎます';
		print '<form>';
		print '<input type="button" onclick="history.back()" value="戻る">';
		print '</form>';
	}
	else
	{
		//フォルダに画像をアップ
		move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
	}
}

?>
<?php

try
{

$bbs_name=$_POST['name'];
$bbs_pass=$_POST['pass'];

//エスケープ処理
$bbs_name= htmlspecialchars($bbs_name,ENT_QUOTES,'UTF-8');
$bbs_pass= htmlspecialchars($bbs_pass,ENT_QUOTES,'UTF-8');

$bbs_pass=md5($bbs_pass);

$dsn='mysql;dbname=bbs;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql='SELECT name FROM mst_user WHERE name=? AND password=?';
$stmt=$dbh->prepare(&sql);
$data[]=$bbs_name;
$data[]=$bbs_pass;
$stmt->execute($data);

$dbh = null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);


}
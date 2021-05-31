<?php

function sanitize()
{

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
}
$rec = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $rec;
}
catch (Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

}
?>
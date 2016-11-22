<?php
error_reporting(0);

include("db_con.php");

$linkid = $_GET['l'];
$linkid = filter_var($linkid, FILTER_SANITIZE_STRING);

$geturl = mysqli_query($db_con, "SELECT linkid,url1,url2 FROM `links` WHERE linkid = '" . $linkid . "'");
$urls = $geturl->fetch_assoc();

$upstat = mysqli_query($db_con, "UPDATE `stats` SET LinkViews = LinkViews + 1 WHERE id = 1");

$d = date('i');
$d = intval($d);
if ($d % 2 == 0) {
	header('Location: ' . $urls[url1]);
}else{
	header('Location: ' . $urls[url2]);
}
?>

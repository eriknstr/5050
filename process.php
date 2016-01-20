<?php

$v = $_POST['v'];
$l1 = $_POST['l1'];
$l2 = $_POST['l2'];

if($v == 1){

$g = array('\'', '"', '\\', '\;', '\$', '\>', '\<');
$b = array('', '', '', '', '', '', '');
$l1 = str_replace($b, $g, $l1);
$l2 = str_replace($b, $g, $l2);

$dir = mt_rand(1, 2000000000) . mt_rand(1, 2000000000) . mt_rand(1, 2000000000);

mkdir("l/" . $dir);
chdir("l/" . $dir);
file_put_contents("index.html", "<script>var r = Math.floor((Math.random()*2)+1); if(r == 1){window.location = '" . $l1 . "'}else{window.location = '" . $l2 . "'}</script>");

$fu = "http://5050.degstu.com/l/" . $dir;

echo "<font face='arial'><center><div style='width:50%;'><input type='text' value='" . $fu . "'/></div></center></font>";

}else{echo "Invalid request.";}

?>

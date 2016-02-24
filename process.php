<?php

//Config stuff, touch this.
define("ServerURL", "http://localhost/Degstu-5050/l/"); //Enter a URL to your server here, MUST END IN "/l/" ex: http://5050.degstu.com/l/
error_reporting(0); //Comment out this line if you are just testing, keep it uncommented if this deployed
//END CONFIG, DONT MESS WITH THE STUFF BELOW

$v = $_POST['v'];
$l1 = $_POST['l1'];
$l2 = $_POST['l2'];

if($v == 1){

function gen(){
chdir("l");
if(!file_exists($dir)){
chdir("../");
$g = array('\'', '"', '\\', '\;', '\$', '\>', '\<');
$b = array('', '', '', '', '', '', '');
$GLOBALS["l1"] = str_replace($b, $g, $GLOBALS["l1"]);
$GLOBALS["l2"] = str_replace($b, $g, $GLOBALS["l2"]);

$dir = mt_rand(1, 2000000000) . mt_rand(1, 2000000000) . mt_rand(1, 2000000000);


mkdir("l/" . $dir);
chdir("l/" . $dir);

$fcon = "<?php
	error_reporting(0);
	\$d = date('i');
	\$d = intval(\$d);
	if (\$d % 2 == 0) {
		header('Location: " . $GLOBALS["l1"] . "');
	}else{
		header('Location: " . $GLOBALS["l2"] . "');
	}
\\?>";

file_put_contents("index.php", $fcon);

$fu = ServerURL . $dir;

echo "<font face='arial'>
<center>
<div style='width:50%;'>
<a href='http://www.reddit.com/r/FiftyFifty/submit?url=" . $fu . "'>Submit to Reddit</a><p />
<input type='text' style='width:50%;text-align: center;' value='" . $fu . "'/>
<p />
</div>
</center>
</font>";
}else{gen();}
}

gen();

}else{echo "Invalid request.";}

?>

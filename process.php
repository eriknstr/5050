<?php

//Config stuff, touch this.
define("ServerURL", "http://5050.degstu.com/l/"); //Enter a URL to your server here, MUST END IN "/l/" ex: http://5050.degstu.com/l/
define("Whitelist", array("imgur.com", "giphy.com", "postimg.org", "gfycat.com", "minus.com", "youtube.com", "vimeo.com", "liveleak.com")); //Allowed domains
error_reporting(0); //Comment out this line if you are just testing, keep it uncommented if this deployed
//END CONFIG, DONT MESS WITH THE STUFF BELOW
//except maybe uncomment the var_dumps if stuffs not working

$v = $_POST['v'];
$l1 = $_POST['l1'];
$l2 = $_POST['l2'];

if($v == 1){

//Validate url
$l1 = filter_var($l1, FILTER_SANITIZE_URL);
$l2 = filter_var($l2, FILTER_SANITIZE_URL);
if(filter_var($l1, FILTER_VALIDATE_URL) === false || filter_var($l2, FILTER_VALIDATE_URL) === false){die(print_r("Invalid URL(s).", true ));}
$l1v = str_replace('www.', '', parse_url($l1, PHP_URL_HOST));
$l2v = str_replace('www.', '', parse_url($l2, PHP_URL_HOST));
function giveHost($host_with_subdomain) {
    $array = explode(".", $host_with_subdomain);

    return (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "").".".$array[count($array) - 1];
}
$l1v = giveHost($l1v);
$l2v = giveHost($l2v);
//var_dump(Whitelist);
//var_dump($l1);
//var_dump($l2);
//var_dump($l1v);
//var_dump($l2v);
if(!in_array($l1v, Whitelist) || !in_array($l2v, Whitelist)){die(print_r("Blocked URL(s).", true ));}

//Generate
function gen(){
chdir("l");
if(!file_exists($dir)){
chdir("../");
$g = array('\'', '"', '\\', '\;', '\$', '\>', '\<');
$b = array('', '', '', '', '', '', '');
$GLOBALS["l1"] = str_replace($b, $g, $GLOBALS["l1"]);
$GLOBALS["l2"] = str_replace($b, $g, $GLOBALS["l2"]);

$dir = base64_encode(mt_rand(1, 2000000000));


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
" . '?>' . "";

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

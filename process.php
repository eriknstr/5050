<?php

//Config stuff, touch this.
@define("ServerURL", "http://5050.degstu.com/"); //Enter a URL to your server here, MUST END IN "/l/" ex: http://5050.degstu.com/l/
@$wl = array("imgur.com", "giphy.com", "postimg.org", "gfycat.com", "minus.com", "youtube.com", "vimeo.com", "liveleak.com"); //Allowed domains
error_reporting(0); //Comment out this line if you are just testing, keep it uncommented if this deployed
//END CONFIG, DONT MESS WITH THE STUFF BELOW
//except maybe uncomment the var_dumps if stuffs not working

$v = $_POST['v'];
$l1 = $_POST['l1'];
$l2 = $_POST['l2'];

if($v == 1){

include("db_con.php");

//Validate url
$l1 = filter_var($l1, FILTER_SANITIZE_URL);
$l2 = filter_var($l2, FILTER_SANITIZE_URL);

if(filter_var($l1, FILTER_VALIDATE_URL) === false || filter_var($l2, FILTER_VALIDATE_URL) === false){die(print_r("Invalid URL(s).", true ));}

$l1v = str_replace('www.', '', parse_url($l1, PHP_URL_HOST));
$l2v = str_replace('www.', '', parse_url($l2, PHP_URL_HOST));
$l1v = giveHost($l1v);
$l2v = giveHost($l2v);
if(!in_array($l1v, $wl) || !in_array($l2v, $wl)){die(print_r("Blocked URL(s).", true ));}

gen($l1, $l2, $db_con);

}else{echo "Invalid request.";}

function gen($link1, $link2, $db){
	$LinkID = generateRandomString(15);
	
	ValidateID($LinkID, $db, $link1, $link2);
}

function ValidateID($Link, $db, $l1, $l2){
	$result = mysqli_query($db, "SELECT 1 FROM `links` WHERE `linkid` = '$Link'");
	if ($result && mysql_num_rows($result) > 0){
        	gen($l1, $l2, $db);
	}else{
		//echo "nf";
		CreateURL($Link, $db, $l1, $l2);
	}
}

function CreateURL($Link, $db, $l1, $l2){
	mysqli_query($db, "INSERT INTO `links` (`id`, `linkid`, `url1`, `url2`) VALUES (NULL, '" . $Link . "', '" . $l1 . "', '" . $l2 . "')");
	$furl = ServerURL . "v.php?l=" . $Link;
	
	$upstat = mysqli_query($db, "UPDATE `stats` SET LinksCreated = LinksCreated + 1 WHERE id = 1");
	
	DispURL($furl);
}

function DispUrl($FinalURL){
	echo "<font face='arial'><center><div style='width:50%;'><a href='http://www.reddit.com/r/FiftyFifty/submit?url=" . $FinalURL . "'>Submit to Reddit</a><p /><input type='text' style='width:50%;text-align: center;' value='" . $FinalURL . "'/><p /></div></center></font>";
}

function giveHost($host_with_subdomain) {
	$array = explode(".", $host_with_subdomain);

	return (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "").".".$array[count($array) - 1];
}

function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
?>

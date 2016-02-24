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

$fcon = "<script src='../cookie/src/js.cookie.js'></script>
<script>

	if(Math.floor((Math.random()*2)+1) == 1){
		var redir =  '" . $GLOBALS["l1"] . "';
	}else{
		var redir =  '" . $GLOBALS["l2"] . "';
	}

	var uid = '" . $dir . "' + '-d5050';
	
	var dCookie = Cookies.get(uid);
	
	if(typeof dCookie === 'undefined'){
    		Cookies.set(uid, redir, { expires: 0.0006944444444444445 });
    		window.location = redir;
	}else{window.location = dCookie;}

</script>";

file_put_contents("index.html", $fcon);

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

<html>
<head>
<title>50/50 by Degstu</title>
</head>
<body>

<center>
<font face="arial">
<div style="width:40%;">

<h1>50/50 by Degstu</h1>
<b>YOU MUST INCLUDE "http://" IN YOUR URL!!</b><br/><br />
Due to people using this platform to post spammy links, there is now a whitelist. Allowed hosts: <b>Imgur, Giphy, Postimage, Gfycat, Minus, YouTube, Vimeo, and Liveleak</b>.<p />
<form action="process.php" method="post">
<input type="hidden" name="v" value="1"/>
<input type="text" name="l1" placeholder="URL 1"/><br />
<input type="text" name="l2" placeholder="URL 2"/><br />
<input type="submit" value="Generate"/>
</form>
<p />
<?php

include("db_con.php");

$getstats = mysqli_query($db_con, "SELECT LinkViews,LinksCreated FROM `stats` WHERE id = 1");
$stats = $getstats->fetch_assoc();

echo "Links viewed: " . $stats[LinkViews] . "<br />";
echo "Links created: " . $stats[LinksCreated];

?>
</div>
<p />
Degstu<p />
Under an MIT License
</font>
</center>

</body>
</html>

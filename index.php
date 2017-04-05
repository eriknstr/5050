<html>
<head>
<title>50/50 by Degstu</title>
</head>
<body>

<center>
<font face="arial">

<h1>50/50 by Degstu</h1>

<div style="width:40%;">

<div style="border:2px solid #000000;">

<h2>Link Requirements</h2>

<ul>
<li>Allowed hosts: Imgur, Giphy, Postimage, Gfycat, Minus, YouTube, Vimeo, and Liveleak.</li>
<li>Your URLs must have "http://" or "https://" in the beginning.</li>
</ul>

</div>

<p />

<div style="border:2px solid #000000;">

<h2>Create a Link</h2>

<form action="process.php" method="post">
<input type="hidden" name="v" value="1"/>
<input type="text" name="l1" placeholder="URL 1"/><br />
<input type="text" name="l2" placeholder="URL 2"/><br />
<input type="submit" value="Create"/>
</form>

</div>

<p />

<div style="border:2px solid #000000;">

<h2>Stats</h2>

<?php

include("db_con.php");

$getstats = mysqli_query($db_con, "SELECT LinkViews,LinksCreated FROM `stats` WHERE id = 1");
$stats = $getstats->fetch_assoc();

echo $stats[LinkViews] . " links viewed.<br />";
echo $stats[LinksCreated] . " links created.<p />";

?>

</div>

<p />

Degstu.com<p />

<a href="https://github.com/Degstu/5050">Open Source Under an MIT License</a>

</div>

</font>
</center>

</body>
</html>

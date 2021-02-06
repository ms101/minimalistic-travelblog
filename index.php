<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="robots" content="noindex, nofollow" />
	<title>Simple Blog</title>
 	<style type="text/css">
	* { margin: 0; padding: 0; }
	body {
		color: #ccc;
		background-color: #333;
		font-family: sans-serif;
	}
	a , a:link, a:active, a:hover {
		color: #008fff; /* orangerot f20 */
		text-decoration: none;
	}
	#wrapper {
		width: 60%;
		margin: 30px auto;
	}
	#picwrapper {
		text-align: center;
		margin: 0 0 60px;
	}
	@media screen and (max-width: 900px) {
		#wrapper { width: 90%; }
		img { width: 90% }
	}
	h1 {
		color: #008fff;
		height: 40px;
		width: 120px;
		margin: 0 0 26px -20px;
		transform: rotate(-5deg);
		text-shadow: 1px 1px 3px black;
	}
	#h1:after { content: 'Blog!'; }
	h1:hover #h1:after { content: '<back'; }
	h2 {
		margin: 20px 0 16px;
		font-size: 22px;
		font-family: Georgia, serif;
		font-style: italic;
		color: #fff;
		text-shadow: 1px 1px 1px black;
	}
	h3 {
		font-size: 100%;
		margin: 16px 0 10px;
	}
	p {
		margin: 0;
	}
	img {
		width: 60%;
		margin: 28px auto 0;
		box-shadow: 2px 2px 3px black;
		box-shadow: 1px 1px 4px black;
		-moz-transition-duration: .2s; /* firefox */
		-webkit-transition-duration: .2s; /* chrome, safari */
		-o-transition-duration: .2s; /* opera */
		-ms-transition-duration: .2s; /* ie 9 */
	}
	img:hover {
		width: 100%;
	}
	ul li {
		list-style-type: none;
		padding-left: 0px;
		margin-bottom: 4px;
	}
	.trip { margin: 5px 0 30px; }
	#symbol {
		font-size: 90px;
		color: #555;
		text-align: center;
	}
	</style>
</head>
<body>
<div id="wrapper">
<?php
$ordner = array();

// array including subfolders/blogposts
if ($handle = opendir('.')) {
	while (($entry = readdir($handle)) !== false) {
		if($entry !== "index.php" && $entry !== ".index.php.swp" && $entry !== "." && $entry !== "..") {
			$ordner[] = $entry;
		}
	}
}

//sort subfolders
if(isset($ordner)) {
	rsort($ordner);
}

// write specific blogpost
if(isset($_GET["p"])) {
	$p = $_GET["p"];
	
	echo "<h1><a href='./'><span id='h1'></span></a></h1>\n";
	
	if(!in_array($p, $ordner)) {
		echo "<p>Nope!</p>";
		exit();
	}

	// write blogpost
	//	include text
	echo "<article>\n";
	echo "<h2>$p</h2>\n<p>";
	include "./$p/text";
	echo "</p>\n</article>\n</div>\n<div id='picwrapper'>\n";

	//	include images
	$pics = array();
	
	if ($handle1 = opendir("./$p/")) {
		while (($en = readdir($handle1)) !== false) {
			if($en !== "text" && $en !== "." && $en !== "..") {
				$pics[] = $en;
			}
		}
	}
	sort($pics);
	foreach($pics as $pic) {
		echo "<img src='./$p/$pic' alt='' /><br />\n";
	}
// write linklist/menu
} else { 	
	echo "<h1><a href='./'>Blog!</a></h1>\n";
	echo "<h2>Overview</h2>\n";
	echo "<ul>\n";
	// read all subfolders
	foreach($ordner as $ord) {
		$o1 = substr($ord, 0, 10);
		$o2 = substr($ord, 10, strlen($ord));
		echo "<li>$o1 &nbsp;<a href='.?p=$ord'>$o2</a></li>\n";
		
		// choose seperator for multiple trips, or delete the following 3 lines if you dont need them
		if($o2 == " Genf") {
			echo "<li class='trip'><b>&#x2191; Trip #2 to country YZ &#x2191;</b></li>\n";
		}
	}
	// delete the next line if you dont need separation
	echo "<li class='trip'><b>&#x2191; Trip #1 to country XY &#x2191;</b></li>\n";
	echo "</ul>\n";
}
?>
<p id='symbol'>&#3484;</p>
<!-- alternatives: 3484 1422 -->
</div>
</body>
</html>

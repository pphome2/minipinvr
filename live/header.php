<?php

 #
 # LiveCam
 #
 # info: main folder copyright file
 #
 #

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo($LIVE_SITENAME); ?></title>
		<meta charset="utf-8" />
		<?php if (isset($cam)){ ?>
		<meta http-equiv="refresh" content="<?php #echo($LIVE_SLEEPTIME); ?>; url=./live.php?c=<?php echo($cam); ?>">
		<?php }else{ ?>
		<meta http-equiv="refresh" content="<?php #echo($LIVE_SLEEPTIME); ?>; url=./live.php">
		<?php } ?>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="favicon.png">
		<link rel="shortcut icon" type="image/png" href="favicon.png" />
		<style><?php include("siteb.css"); ?></style>
	</head>
<body>


<div class=all-page>


<header>
<div class="menu">
<ul class="sidenav">
	<li><a href=""><?php echo($LIVE_SITENAME) ?></a></li>
</ul>

</header>

<div class="content">


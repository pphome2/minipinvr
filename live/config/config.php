<?php

 #
 # LiveCam
 #
 # info: main folder copyright file
 #
 #

# configuration

# copyright link
$LIVE_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$LIVE_SITENAME="LiveCam";
$LIVE_SITE_HOME="http://www.google.com";
$LIVE_DOCTYPE="<!DOCTYPE HTML>";

$LIVE_MAINSITE="../start.php";
$LIVE_MAINSITENAME="NVR";

$LIVE_HEADER="header.php";
$LIVE_FOOTER="footer.php";

# camera stream link
$LIVE_CAMSTREAM=array(	"rtsp://user:password@192.168.10.11:554/stream2",
			"rtsp://user:password@192.168.10.12:554/stream2",
			"rtsp://user:password@192.168.10.13:554/stream2"
			);
$LIVE_CAMSTREAM_HD=array("rtsp://user:password@192.168.10.11:554/stream1",
			"rtsp://user:password@192.168.10.12:554/stream1",
			"rtsp://user:password@192.168.10.13:554/stream1"
			);

$LIVE_SLEEPTIME=1;

# language
$LIVE_L_STOP="Leállítás";
$LIVE_L_REFRESH="Frissítés";
$LIVE_L_BACK="Visszalépés";

?>

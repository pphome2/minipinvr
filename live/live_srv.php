<?php

 #
 # Livecam
 #
 # info: main folder copyright file
 #
 #


# load config 
if (file_exists("config/config.php")){
    include("config/config.php");
}

if (isset($_GET["c"])){
    $cam=$_GET["c"];
    $out=shell_exec("./bin/ffmpeg -i $LIVE_CAMSTREAM_HD[$cam] -frames:v 1 -y ./img/img$cam.jpg 2>/dev/null");
}else{
    $db=count($LIVE_CAMSTREAM);
    for($i=0;$i<$db;$i++){
	$out=shell_exec("./bin/ffmpeg -i $LIVE_CAMSTREAM[$i] -frames:v 1 -y ./img/img$i.jpg 2>/dev/null");
    }
}
echo("ok");

?>

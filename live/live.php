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
    #echo shell_exec("./bin/ffmpeg -i $LIVE_CAMSTREAM[$cam] -frames:v 1 -y ./img/img$cam.jpg &");
    echo shell_exec("./live_shell.sh $LIVE_CAMSTREAM[$cam] $cam");
    if (file_exists("$LIVE_HEADER")){
	include("$LIVE_HEADER");
    }
    echo("<div class=spaceline10000></div>");
    echo("<center>");
    echo("<a href='?'><img id=camimg style='width:80%;' src=img/img$cam.jpg></a>");
    echo("<div class=spaceline></div>");
    echo("</center>");
    echo("<div class=row>");
    echo("<div class=col3>");
    echo("<div class=space>");
    echo("<input type=submit id=submit name=submit value='$LIVE_L_STOP' onclick='stop=1;'>");
    echo("</div>");
    echo("</div>");
    echo("<div class=col3>");
    echo("<div class=space>");
    echo("<input type=submit id=submit name=submit value='$LIVE_L_REFRESH' onclick='stop=0;newimg($cam);' >");
    echo("</div>");
    echo("</div>");
    echo("<div class=col3>");
    echo("<div class=space>");
    echo("<input type=submit id=submit name=submit value='$LIVE_L_BACK' onclick='history.back();' >");
    echo("</div>");
    echo("</div>");
    echo("</div>");
}else{
    $db=count($LIVE_CAMSTREAM);
    for($i=0;$i<$db;$i++){
	#echo shell_exec("./bin/ffmpeg -i $LIVE_CAMSTREAM[$i] -frames:v 1 -y ./img/img$i.jpg &");
        echo shell_exec("./live_shell.sh $LIVE_CAMSTREAM[$i] $i");
    }
    if (file_exists("$LIVE_HEADER")){
	include("$LIVE_HEADER");
    }
    echo("<div class=row>");
    echo("<div class=col2>");
    echo("<div class=space>");
    echo("<input type=submit id=submit name=submit value='$LIVE_L_STOP' onclick='stop=1;'>");
    echo("</div>");
    echo("</div>");
    echo("<div class=col2>");
    echo("<div class=space>");
    echo("<input type=submit id=submit name=submit value='$LIVE_L_REFRESH' onclick='stop=0;newallimg();' >");
    echo("</div>");
    echo("</div>");
    echo("</div>");
    echo("<div class=spaceline></div>");
    echo("<center>");
    for($i=0;$i<$db;$i++){
	echo("<a href='?c=$i'><img id=camimg$i style='width:50%;' src=img/img$i.jpg></a>");
        echo("<div class=spaceline></div>");
    }
    echo("</center>");
}

$sec=$LIVE_SLEEPTIME*1000;

?>

<script>

var stop = 0;

function newimg(num) {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
    var source = 'img/img'+num+'.jpg',
        timestamp = (new Date()).getTime(),
        newUrl = source + '?_=' + timestamp;
    	document.getElementById("camimg").src = newUrl;
		if (stop == 0){
		<?php
			echo("timeid=setTimeout(newimg, $LIVE_SLEEPTIME, $cam);");
		?>
		}
    }
    xmlhttp.open("GET", "live_srv.php?c=" + num);
    xmlhttp.send();
}

function newallimg() {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
    var timestamp = (new Date()).getTime(),
        newUrl = 'img/img0.jpg' + '?_=' + timestamp;
    	document.getElementById("camimg0").src = newUrl;
        newUrl = 'img/img1.jpg' + '?_=' + timestamp;
    	document.getElementById("camimg1").src = newUrl;
        newUrl = 'img/img2.jpg' + '?_=' + timestamp;
    	document.getElementById("camimg2").src = newUrl;
		if (stop == 0){
		<?php
			echo("timeid=setTimeout(newallimg, $LIVE_SLEEPTIME);");
		?>
		}
    }
    xmlhttp.open("GET", "live_srv.php");
    xmlhttp.send();
}

<?php
    if (isset($cam)) {
		echo("timeid=setTimeout(newimg, $LIVE_SLEEPTIME, $cam);");
    }else{
		echo("timeid=setTimeout(newallimg, $sec);");
    }
?>

</script>

<?php

if (file_exists("$LIVE_FOOTER")){
    include("$LIVE_FOOTER");
}

?>

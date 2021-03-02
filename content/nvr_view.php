<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #



function liveview(){
	global $L_LIVE_VIEW,$NVR_LIVE_STREAM;

?>

	<h3 class='center'><?php echo($L_LIVE_VIEW); ?></h3>
	<div class="center" id="id_view" style="display:none;" onclick="hidethis(this);">
		<div class=spaceline></div>
		<div class="row border">
		<img class="" id="id_img" src="seccam/1.jpg"><br>
		<div class="" id="id_name">Nappali</div>
		</div>
		<div class=spaceline></div>
	</div>
	<?php
	$db=count($NVR_LIVE_STREAM);
	$y=0;
	for ($i=0;$i<$db;$i++){
		$n=$NVR_LIVE_STREAM[$i][0];
		$l=$NVR_LIVE_STREAM[$i][1];
		if ($y==0) {
			echo("<div class=spaceline></div>");
			echo("<div class=row>");
		}
		$y++;
		echo("<div class=col3>");
		if ($y<>3){
			echo("<div class=spaceright>");
		}
		echo("<div class=border>");
		#echo("<img class=\"\" src=\"seccam/1.jpg\" onclick='imgview(\"$l\",\"$n\");'><br>$n");
		echo("<img class=\"\" src=\"$l\" onclick='imgview(\"$l\",\"$n\");'><br>$n");
		echo("</div>");
		if ($y==3) {
			$y=0;
			echo("<div class=spaceline></div>");
			echo("</div>");
		}else{
		  echo("</div>");
		}
		echo("</div>");
	} ?>
	<div class=spaceline></div>

<?php


}


?>

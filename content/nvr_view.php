<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #



function liveview(){
	global $L_LIVE_VIEW,$L_NOLIVESTREAM,$L_LIVESTREAM_NOTICE,
			$NVR_LIVE_STREAM,$NVR_LIVE_IMAGE_SIZE,$NVR_LIVESTREAM_FILE,
			$NVR_DIR,$NVR_LIVE_IMAGE_APP,$L_LIVEIMAGEAPP,$L_LIVEIMAGEAPPSTART;

?>

	<h3 class='center'><?php echo($L_LIVE_VIEW); ?></h3>
	<div class="center" id="id_view" style="display:none;" onclick="hidethis(this);">
		<div class=spaceline></div>
		<div class="row">
		<div class="border marginauto" style="width:<?php echo($NVR_LIVE_IMAGE_SIZE);?>;">
		<img class="" id="id_img" style="" src="">
		<div class="" id="id_name"></div>
		</div>
		</div>
		<div class=spaceline></div>
	</div>
	<?php
	$of=$NVR_DIR."/".$NVR_LIVESTREAM_FILE;
	if (file_exists($of)){
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
				echo("</div>");
				echo("<div class=spaceline></div>");
			}else{
				echo("</div>");
			}
			echo("</div>");
		}
		if ($y<>0){
			echo("</div>");
		}
		echo("<div class=spaceline></div>");
		echo("<h3 class=center>$L_LIVESTREAM_NOTICE</h3>");
	}else{
		echo("<div class=spaceline></div>");
		echo("<div class=spaceline></div>");
		echo("<h3 class=center>$L_NOLIVESTREAM</h3>");
        if ($NVR_LIVE_IMAGE_APP <> "") {
            echo("<div class=spaceline></div>");
            echo("<div class=spaceline></div>");
            echo("<div class=spaceline></div>");
            echo("<div class=spaceline></div>");
            echo("<h3 class=center>$L_LIVEIMAGEAPP</h3>");
            echo("<div class=spaceline></div>");
            echo("<center>");
            echo("<a href=\"$NVR_LIVE_IMAGE_APP\">");
            echo("<input style=\"width:30%;\" type=submit id=startapp name=startapp value='$L_LIVEIMAGEAPPSTART' >");
            echo("</a>");
            echo("</center>");
        }
	}
}

?>

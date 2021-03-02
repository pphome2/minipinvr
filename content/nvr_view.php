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

<style>
	img {
		max-width: 100%;
		max-height: 100%;
		height: auto;
	}

	.border {
		border-width: 1px;
		border-color: gray;
		border-style: solid;
		border-radius:5px;
	}
</style>


	<h3 class='center'><?php echo($L_LIVE_VIEW); ?></h3>
	<div class="center" id="id_view" style="display:none;" onclick="hidethis(this);">
		<div class=spaceline></div>
		<div class=row>
		<img class="border" id="id_img" src="seccam/1.jpg"><br>
		<div id="id_name">Nappali</div>
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
		echo("<div class=col3>");
		echo("<div class=spaceright>");
		echo("<div class=border>");
		#echo("<img src=\"$l\" onclick=><br>$n");
		echo("<img class=\"\" src=\"$l\" onclick='imgview(\"$l\",\"$n\");'><br>$n");
		echo("</div>");
		echo("</div>");
		echo("</div>");
		$y++;
		if ($y==3) {
			$y=0;
			echo("<div class=spaceline></div>");
			echo("</div>");
		}
	} ?>
	<div class=spaceline></div>

	<script>
	function hidethis(th){
		th.style.display="none";
		document.getElementById("id_view").style.display="none";
	}

	function imgview(imgsrc,imgname){
		document.getElementById("id_view").style.display="block";
		document.getElementById("id_img").src=imgsrc;
		document.getElementById("id_name").innerHTML=imgname;
	}
 
  </script>

<?php


}


?>

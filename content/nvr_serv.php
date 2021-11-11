<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #



function services(){
	global $NVR_DAY_TAG,$NVR_MAIN_TAG,$NVR_SERV_TAG,$NVR_RUN_FILE,$NVR_DIR,$NVR_TIME_FILE,
			$NVR_LIVE_STREAM,
			$L_BACKPAGE,$L_NO_AVAILABLE,$L_DELETE_OK,$L_MOTION_STOP,$L_MOTION_START,
			$L_MOTION_HEAD,$L_MOTION_RUN,$L_MOTION_NORUN,$L_DELETE_OK,$L_DELETE_INFO,
			$L_MOTION_INFO,$L_DELETE_OLD,$L_DELETE_TODAY,$MA_MENU_FIELD,$MA_MENU,
			$L_ERROR,$L_TIME_SAVED,$L_TIME_CONFIG,$L_TIME_INFO,$L_TIME_TABLE,$L_TIME_SAVE,
			$L_TIME_DAYS,$L_MOTION_ERROR_FILE,$L_CAMERA_START,$L_CAMERA_STOP,$L_CAM_NAME,
			$L_CAMERA;

	$day="";
	if (!empty($_GET[$NVR_DAY_TAG])) {
		$day=$_GET[$NVR_DAY_TAG];
	}
	if (empty($day)){
		$day=0;
	}

	if (!empty($_GET[$NVR_SERV_TAG])){
		$f=$_GET[$NVR_SERV_TAG];
		switch ($f){
			case "2":		# mai rögzítés törlése
				if (file_del(false,$NVR_DIR)){
						echo("<div class=infobar>$L_DELETE_OK</div>");
				}
				break;
			case "3":		# régebbi rögzítés törlése
				if (file_del(true,$NVR_DIR)){
						echo("<div class=infobar>$L_DELETE_OK</div>");
				}
				break;
			default:
				break;
		}
	}

	# rögzítés és kamerák állapota (ki- és bekapcsolás)
	#
	# CAM_DETECT=0
	# CAM_ENABLE=("0" "2" "0")
	#
	$camstart=array();
	$camenable="0";
	$camrunsave=false;
	$cdb=count($NVR_LIVE_STREAM);
	$rf=$NVR_DIR."/".$NVR_RUN_FILE;
	if (file_exists($rf)){
		$lines=file($rf);
		for($k=0;$k<count($lines);$k++){
			$ol=explode("=",$lines[$k]);
			if ($ol[0]==="CAM_DETECT"){
				if ($ol[1]==0){
					$camenable="0";
				}else{
					$camenable="1";
				}
			}
			if ($ol[0]==="CAM_ENABLE"){
				$ol[1]=trim($ol[1],"()");
				$olc=explode(" ",$ol[1]);
				for ($i=0;$i<$cdb;$i++){
					if (strpos($olc[$i],"0")>0){
						$camxenable[$i]=false;
					}else{
						$camxenable[$i]=true;
					}
				}
			}
		}
	}else{
		$camrunsave=true;
		for ($i=0;$i<$cdb;$i++){
			$camxenable[$i]=true;
			$camstart[$i]=$L_CAMERA_STOP;
		}
		$buttontext="$L_MOTION_START";
		$info=$L_MOTION_ERROR_FILE;
	}
	$menu=$MA_MENU[0][1];

	# mentés előkészítés
	$out=array("#\n");
	$out[1]="CAM_DETECT=";
	if (isset($_POST["startstopall"])){
		$camrunsave=true;
		if ($buttontext==$L_MOTION_START){
			$out[1]=$out[1]."1";
		}else{
			$out[1]=$out[1]."0";
		}
	}else{
		$out[1]=$out[1].$camenable;
	}
	$out[1]=$out[1]."\n";
	for ($i=0;$i<$cdb;$i++){
		if (isset($_POST["startstop$i"])){
			$camxenable[$i]=!$camxenable[$i];
			$camrunsave=true;
		}
	}
	$out[2]="";
	for ($i=0;$i<$cdb;$i++){
		if ($camxenable[$i]){
			$y=$i+1;
			$out[2]=$out[2].'"'.$y.'" ';
		}else{
			$out[2]=$out[2].'"'."0".'" ';
		}
	}
	$out[2]="CAM_ENABLE=(".$out[2].")\n";
	$out[3]="#\n";
	#echo($out[1]);
	#echo($out[2]);

	# mentés
	if ($camrunsave){
		file_put_contents($rf,$out);
	}
	# változások átvezetése a rendszerbe
	for ($i=0;$i<$cdb;$i++){
		if ($camxenable[$i]){
			$camstart[$i]=$L_CAMERA_STOP;
		}else{
			$camstart[$i]=$L_CAMERA_START;
		}
	}
	if ($camenable==0){
		$buttontext="$L_MOTION_START";
		$info=$L_MOTION_NORUN;
	}else{
		$buttontext="$L_MOTION_STOP";
		$info=$L_MOTION_RUN;
	}


	# időadatok
	#
	# CAM_DAY_START=
	# CAM_DAY_STOP=#
	# CAM_NIGHT_START=
	# CAM_NIGHT_STOP=
	#
	$ddb=count($L_TIME_DAYS);
	$timedata=array();
	$of=$NVR_DIR."/".$NVR_TIME_FILE;
	if (isset($_POST["submittime"])){
		for ($i=1;$i<=$ddb;$i++){
			$out[0]="#\n";
			$timedata[$i][0]=$_POST["nap1$i"];
			$out[1]="CAM_DAY_START=".$timedata[$i][0]."\n";
			$timedata[$i][1]=$_POST["nap2$i"];
			$out[2]="CAM_DAY_STOP=".$timedata[$i][1]."\n";
			$timedata[$i][2]=$_POST["ej1$i"];
			$out[3]="CAM_NIGHT_START=".$timedata[$i][2]."\n";
			$timedata[$i][3]=$_POST["ej2$i"];
			$out[4]="CAM_NIGHT_STOP=".$timedata[$i][3]."\n";
			$out[5]="#\n";
			$rf=$of.$i;
			file_put_contents($rf,$out);
		}
	}else{
		for ($i=1;$i<=$ddb;$i++){
			$rf=$of.$i;
			$lines=file($rf);
			$ol=explode("=",$lines[1]);
			$timedata[$i][0]=trim($ol[1]);
			$ol=explode("=",$lines[2]);
			$timedata[$i][1]=trim($ol[1]);
			$ol=explode("=",$lines[3]);
			$timedata[$i][2]=trim($ol[1]);
			$ol=explode("=",$lines[4]);
			$timedata[$i][3]=trim($ol[1]);
		}
	}

?>

	<div class=insidecontent>
	<h1><center><?php echo($L_MOTION_HEAD); ?> </center></h1>
	<div class=center50>
			<center><p><?php echo($info); ?></p>
			<p><?php echo($L_MOTION_INFO); ?></p></center>
			<form class=formfull id="startstop" method=post>
				<table class=table id='camtable'>
				<?php
				for ($i=0;$i<$cdb;$i++){
					$y=$i+1;
					echo("<div class=row>");
					echo("<div class=col3>");
					echo("<p>$L_CAMERA $y</p>");
					echo("</div>");
					echo("<div class=col3>");
					echo("<p>$L_CAM_NAME[$i]</p>");
					echo("</div>");
					echo("<div class=col3>");
					echo("<input type=submit id=startstop$i name=startstop$i value='$camstart[$i]' >");
					echo("</div>");
					echo("</div>");
				}
				?>
				</table>
				<div class=spaceline></div>
				<div class=spaceline></div>
				<input type=submit id=startstopall name=startstopall value='<?php echo($buttontext) ?>' >
			</form>

		<div class=spaceline></div>
		<div class=spaceline></div>
			<h2><center><?php echo($L_DELETE_INFO); ?></center></h2>
			<div class=row100>
			<div class=col2>
				<div class=spaceright>
				<a href=?<?php echo("$MA_MENU_FIELD=$menu&$NVR_SERV_TAG=2"); ?> >
					<input type=submit id=submitar name=submitar value='<?php echo($L_DELETE_TODAY) ?>' >
				</a>
				</div>
			</div>
			<div class=col2>
				<div class=spaceleft>
				<a href=?<?php echo("$MA_MENU_FIELD=$menu&$NVR_SERV_TAG=3"); ?> >
					<input type=submit id=submitar name=submitar value='<?php echo($L_DELETE_OLD) ?>' >
				</a>
				</div>
			</div>
			</div>

		<div class=spaceline></div>
		<div class=spaceline></div>
			<center>
			<h2><?php echo($L_TIME_CONFIG); ?></h2>
			<p><?php echo($L_TIME_INFO); ?></p>
			</center>
			<form class=formfull id="time" method=post>
				<table class=table id='ktable'>
					<tr class='df_trh'>
					<th class='df_th1'><?php echo($L_TIME_TABLE[0]); ?></th>
					<th class='df_th2'><?php echo($L_TIME_TABLE[1]); ?></th>
					<th class='df_th2'><?php echo($L_TIME_TABLE[2]); ?></th>
					<th class='df_th2'><?php echo($L_TIME_TABLE[3]); ?></th>
					<th class='df_th2'><?php echo($L_TIME_TABLE[4]); ?></th>
					</tr>
					<?php
					for ($i=1;$i<=$ddb;$i++){
						?>
						<tr class="df_tr">
						<td class="df_td">
							<?php $k=$i-1; echo($L_TIME_DAYS[$k]); ?>
						</td>
						<td class="df_td2">
							<input type=time id='nap1<?php echo($i); ?>' name='nap1<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][0]); ?>" >
						</td>
						<td class="df_td2">
							<input type=time id='nap2<?php echo($i); ?>' name='nap2<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][1]); ?>" >
						</td>
						<td class="df_td2">
							<input type=time id='ej1<?php echo($i); ?>' name='ej1<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][2]); ?>" >
						</td>
						<td class="df_td2">
							<input type=time id='ej2<?php echo($i); ?>' name='ej2<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][3]); ?>" >
						</td>
						</tr>
					<?php } ?>
				</table>
				<input type=submit id=submittime name=submittime value='<?php echo($L_TIME_SAVE) ?>' >
			</form>

	</div>
	</div>

	<div class=spaceline></div>
	<div class=insidecontent>
	<div class=center50>
		<a href=".?">
			<input type=submit id=submitar name=submitar value='<?php echo($L_BACKPAGE) ?>' >
		</a>
	</div>
	</div>

	<?php
}




?>

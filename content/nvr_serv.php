<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #



function services(){
	global $NVR_DAY_TAG,$NVR_MAIN_TAG,$NVR_SERV_TAG,$NVR_RUN_FILE,$NVR_DIR,$NVR_TIME_FILE,
			$L_BACKPAGE,$L_NO_AVAILABLE,$L_DELETE_OK,$L_MOTION_STOP,$L_MOTION_START,
			$L_MOTION_HEAD,$L_MOTION_RUN,$L_MOTION_NORUN,$L_DELETE_OK,$L_DELETE_INFO,
			$L_MOTION_INFO,$L_DELETE_OLD,$L_DELETE_TODAY,$MA_MENU_FIELD,$MA_MENU,
			$L_ERROR,$L_TIME_SAVED,$L_TIME_CONFIG,$L_TIME_INFO,$L_TIME_TABLE,$L_TIME_SAVE,
			$L_TIME_DAYS;

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
			case "1": 		# indító fájl a service-nek
				$fi=$NVR_DIR."/".$NVR_RUN_FILE;
				if (file_exists($fi)){
					if (!unlink($fi)){
						echo("<div class=errorbar>$L_ERROR: $fi</div>");
					}
				}else{
					$str="1";
					if (!file_put_contents($fi,$str)){
						echo("<div class=errorbar>$L_ERROR: $fi</div>");
					}
				}
				break;
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
	if (file_exists($NVR_DIR."/".$NVR_RUN_FILE)){
		$buttontext="$L_MOTION_START";
		$info=$L_MOTION_RUN;
	}else{
		$buttontext="$L_MOTION_STOP";
		$info=$L_MOTION_NORUN;
	}
	$menu=$MA_MENU[0][1];

	$of=$NVR_DIR."/".$NVR_TIME_FILE;
	if (isset($_POST["submittime"])){
		$db=count($L_TIME_DAYS);
		$out="";
		for ($i=0;$i<$db;$i++){
			$out=$out.$_POST["nap1$i"]."-";
			$out=$out.$_POST["nap2$i"]."-";
			if (isset($_POST["ej$i"])){
				$out=$out."X"."\n";
			}else{
				$out=$out."I"."\n";
			}
		}
		if ($out<>""){
			$of=$NVR_DIR."/".$NVR_TIME_FILE;
			if (file_put_contents($of,$out)){
				echo("<div class=infobar>$L_TIME_SAVED</div>");
			}else{
				echo("<div class=errorbar>$L_ERROR</div>");
			}
		}else{
			echo("<div class=errorbar>$L_ERROR</div>");
		}
	}
		$timedata=array();
	if (file_exists($of)){
		$lines=file($of);
		for($i=0;$i<count($lines);$i++){
			$ol=explode("-",$lines[$i]);
			$timedata[$i][0]=$ol[0];
			$timedata[$i][1]=$ol[1];
			if (trim($ol[2])=="X"){
				$timedata[$i][2]="checked";
			}else{
				$timedata[$i][2]="";
			}
		}
	}else{
		for($i=0;$i<7;$i++){
			$timedata[$i][0]="06:00";
			$timedata[$i][1]="06:00";
			$timedata[$i][2]="";
		}
	}


?>

	<div class=insidecontent>
	<h1><center><?php echo($L_MOTION_HEAD); ?> </center></h1>
	<div class=center50>
			<center><p><?php echo($info); ?></p>
			<p><?php echo($L_MOTION_INFO); ?></p></center>
			<a href=?<?php echo("$MA_MENU_FIELD=$menu&$NVR_SERV_TAG=1"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($buttontext) ?>' >
			</a>

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
					</tr>
					<?php
					$db=count($L_TIME_DAYS);
					for ($i=0;$i<$db;$i++){
						?>
						<tr class="df_tr">
						<td class="df_td">
							<?php echo($L_TIME_DAYS[$i]); ?>
						</td>
						<td class="df_td">
							<input type=time id='nap1<?php echo($i); ?>' name='nap1<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][0]); ?>" >
						</td>
						<td class="df_td">
							<input type=time id='nap2<?php echo($i); ?>' name='nap2<?php echo($i); ?>' min="00:00" max="23:50" step="60" value="<?php echo($timedata[$i][1]); ?>" >
						</td>
						<td class="df_td">
							<input type=checkbox id='ej<?php echo($i); ?>' <?php echo($timedata[$i][2]); ?> name='ej<?php echo($i); ?>'  >
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

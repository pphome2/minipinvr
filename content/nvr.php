<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #



function store(){
	main_table();
}


function today(){
	main_table();
}


function file_del($all,$dir){
	global $NVR_FILEEXT,$L_ERROR;

	$r=true;
	if ($all){
		$files=scandir($dir);
		foreach ($files as $entry) {
			if ($entry!="." && $entry!=".." && $entry!="lost+found") {
				if (is_dir($dir."/".$entry)){
					$r=file_del(false,$dir."/".$entry);
				}
			}
		}
	}else{
		$files=scandir($dir);
		foreach ($files as $entry) {
			if ($entry!="." && $entry!=".." && $entry!="lost+found") {
				$fileext=explode('.',$entry);
				$fileext_name=$fileext[count($fileext)-1];
				$fileext_name2='.'.$fileext_name;
				if ((in_array($fileext_name, $NVR_FILEEXT))or(in_array($fileext_name2, $NVR_FILEEXT))){
					if (!unlink($dir."/".$entry)){
						echo("$L_ERROR: $entry. ");
						$r=false;
					}
				}
			}
		}
	}
	return($r);
}


function services(){
	global $NVR_DAY_TAG,$NVR_MAIN_TAG,$NVR_SERV_TAG,$NVR_RUN_FILE,$NVR_DIR,
			$L_BACKPAGE,$L_NO_AVAILABLE,$L_DELETE_OK,$L_MOTION_STOP,$L_MOTION_START,
			$L_MOTION_HEAD,$L_MOTION_RUN,$L_MOTION_NORUN,$L_DELETE_OK,$L_DELETE_INFO,
			$L_MOTION_INFO,$L_DELETE_OLD,$L_DELETE_TODAY,$MA_MENU_FIELD,$MA_MENU,
			$L_ERROR;

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
						echo("<center>$L_ERROR: $fi</center>");
					}
				}else{
					$str="1";
					if (!file_put_contents($fi,$str)){
						echo("<center>$L_ERROR: $fi</center>");
					}
				}
				break;
			case "2":		# mai rögzítés törlése
				if (file_del(false,$NVR_DIR)){
						echo("<center>$L_DELETE_OK</center>");
				}
				break;
			case "3":		# régebbi rögzítés törlése
				if (file_del(true,$NVR_DIR)){
						echo("<center>$L_DELETE_OK</center>");
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

	</div>
	</div>

	<div class=spaceline></div>
	<div class=spaceline></div>
	<div class=spaceline></div>
	<div class=insidecontent>
		<a href=".?">
			<input type=submit id=submitar name=submitar value='<?php echo($L_BACKPAGE) ?>' >
		</a>
	</div>

	<?php
}


function main(){
	global $NVR_MAIN_TAG,$NVR_TAG,$NVR_DEL_TAG;

	if (!empty($_GET[$NVR_MAIN_TAG])) {
		main_table();
	}else{
		if (!empty($_GET[$NVR_DEL_TAG])) {
			main_del();
		}else{
			if (!empty($_GET[$NVR_TAG])){
				main_video();
			}else{
				main_table();
			}
		}
	}
}


function main_del(){
	global $L_DEL_CONF,$L_FILENAME,$NVR_DAY_TAG,$NVR_DEL_TAG,$NVR_MAIN_TAG,
			$L_DELETE,$L_BACKPAGE,$NVR_TAG;

	$day="";
	if (!empty($_GET[$NVR_DAY_TAG])) {
		$day=$_GET[$NVR_DAY_TAG];
	}
	if (empty($day)){
		$day=0;
	}

	$videofile="";
	if (!empty($_GET[$NVR_DEL_TAG])) {
		$videofile=$_GET[$NVR_DEL_TAG];
		$ot=explode("/",$videofile);
		$outtext=$ot[count($ot)-1];
	}

	?>
	<center>
	<div class=spaceline100></div>
	<h1><?php echo($L_DEL_CONF); ?></h1>
	<p><?php echo("$L_FILENAME: $outtext"); ?></p>
	<div class=insidecontent>
	<div class=row>
		<div class=col2>
			<div class=space>
			<a href='<?php echo("?$NVR_DAY_TAG=$day&$NVR_DEL_TAG=$videofile&$NVR_MAIN_TAG=1"); ?>' >
				<input type=submit id=submitar name=submitar value=<?php echo($L_DELETE) ?> >
			</a>
			</div>
		</div>
		<div class=col2>
			<div class=space>
			<a onclick="window.history.back();">
				<input type=submit id=submitar name=submitar value=<?php echo($L_BACKPAGE) ?> >
			</a>
			</div>
		</div>
		</div>
	</div>
	<?php
}


function main_video(){
	global $NVR_TAG,$L_NOFILE,$NVR_SUPPORT_VIDEO,$NVR_WIDTH,$NVR_HEIGHT,
			$NVR_DAY_TAG,$NVR_DEL_TAG,$NVR_STORE_DIR,$NVR_STORE_TAG,$NVR_DIR,
			$L_ERROR_VIDEO,$L_DOWNLOAD_TEXT,$L_BACKPAGE,$L_NOFILE,$L_DELETE,
			$L_STORE_COPYTO,$L_STORE_COPY,$L_STORE_FILE_EXISTS,$L_ERROR;

	$day="";
	if (!empty($_GET[$NVR_DAY_TAG])) {
		$day=$_GET[$NVR_DAY_TAG];
	}
	if (empty($day)){
		$day=0;
	}
	$store=false;
	if ($day===$NVR_STORE_DIR){
		$store=true;
	}
	$videofile="";
	if (!empty($_GET[$NVR_TAG])) {
		$videofile=$_GET[$NVR_TAG];
	}
	if (!file_exists($videofile)) {
		$videofile="";
	}

	if (empty($videofile)){
		$outtext=$L_NOFILE;
		$otext="";
	} else {
		$outtext=$videofile;
		$ot=explode("/",$videofile);
		$outtext=$ot[count($ot)-1];
	}

	echo("<center>");
	$vf="";
	if (!empty($_GET[$NVR_STORE_TAG])) {
		if (file_exists($videofile)) {
			$ot=explode("/",$videofile);
			$of=$ot[count($ot)-1];
			$vf=$NVR_DIR."/".$NVR_STORE_DIR."/".$of;
			if (file_exists($vf)){
					echo("$L_STORE_FILE_EXISTS: $videofile");
			}else{
				if (copy($videofile,$vf)){
					echo("$L_STORE_COPY: $videofile");
				}else{
					echo("$L_ERROR: $videofile");
				}
			}
		}else{
			echo("$L_ERROR: $videofile");
		}
		echo("<br /><br />");
	}else{
	}

	if (!empty($videofile)){
		$fileext=explode('.',$videofile);
		$fileext_name=$fileext[count($fileext)-1];
		if (in_array($fileext_name,$NVR_SUPPORT_VIDEO)){
			echo("<video width=$NVR_WIDTH height=$NVR_HEIGHT controls>");
			echo("<source src=$videofile type=video/mp4>");
			echo($L_ERROR_VIDEO);
			echo("</video>");
		}else{
			echo("<img width=$NVR_WIDTH height=$NVR_HEIGHT src=$videofile>");
		}
?>
		<div class=insidecontent>
		<div class=row>
			<div class=col4>
				<div class=space>
				<a href='<?php echo("?$NVR_DAY_TAG=$day&$NVR_DEL_TAG=$videofile"); ?>' >
					<input type=submit id=submitar name=submitar value='<?php echo($L_DELETE) ?>' >
				</a>
				</div>
			</div>
			<div class=col4>
				<div class=space>
				<a href='<?php echo($videofile); ?>' download >
					<input type=submit id=submitar name=submitar value='<?php echo($L_DOWNLOAD_TEXT) ?>' >
				</a>
				</div>
			</div>
			<div class=col4>
				<div class=space>
				<?php
				if (file_exists($vf)){
				?>
					<input type=submit id=submitar name=submitar value='<?php echo($L_STORE_FILE_EXISTS) ?>' >
				<?php
				}else{
				?>
				<a href='<?php echo("?$NVR_DAY_TAG=$day&$NVR_TAG=$videofile&$NVR_STORE_TAG=1"); ?>' >
					<input type=submit id=submitar name=submitar value='<?php echo($L_STORE_COPYTO) ?>' >
				</a>
				<?php
				}
				?>
				</div>
			</div>
			<div class=col4>
				<div class=space>
				<a onclick="window.history.back();">
					<input type=submit id=submitar name=submitar value='<?php echo($L_BACKPAGE) ?>' >
				</a>
				</div>
			</div>

		</div>
		</div>

<?php
	}else{
?>

		<div class=insidecontent>
			<p><?php echo($L_NOFILE); ?></p>
			<a onclick="window.history.back();">
				<input type=submit id=submitar name=submitar value=<?php echo($L_BACKPAGE) ?> >
			</a>
		</div>
<?php
	}
	echo("</center>");
}


function main_table(){
	global $NVR_DAY_TAG,$NVR_DIR,$L_DAYS,$NVR_DIR_DAYS,$NVR_DEL_TAG,
			$NVR_STORE_DIR,$MA_MENU_FIELD,$MA_MENU,
			$L_DAYS,$L_ERROR,$L_STORE;

	if (!empty($_GET[$NVR_DEL_TAG])) {
		$del=$_GET[$NVR_DEL_TAG];
		if (file_exists($del)){
			if (!unlink($del)){
				echo("$L_ERROR: $del");
			}
		}
	} else {
		$del="";
	}
	$store=false;
	if (!empty($_GET[$MA_MENU_FIELD])){
		if ($_GET[$MA_MENU_FIELD]!==$MA_MENU[0][1]){
			$store=true;
		}
	}
	if (!empty($_GET[$NVR_DAY_TAG])) {
		$day=$_GET[$NVR_DAY_TAG];
		if ($day===$NVR_STORE_DIR){
			$store=true;
		}
	}
	if ($store){
		$day=$NVR_STORE_DIR;
		$store=true;
		$aktdir=$NVR_DIR."/".$NVR_STORE_DIR;
	}else{
		if (!empty($_GET[$NVR_DAY_TAG])) {
			$day=$_GET[$NVR_DAY_TAG];
		} else {
			$day="0";
		}
		$activebutton=array('','','','');
		$activebutton[$day]='style=\'color:black;\'';
		$aktdir=$NVR_DIR;
		if ($day<>"0") {
			$aktdir=$aktdir."/".$NVR_DIR_DAYS[$day];
			$thispage=$L_DAYS[$day];
		}else{
			$thispage=$L_DAYS[0];
		}
	?>
	<div class=row>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("?d=0"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[0]); ?>' <?php echo($activebutton[0]); ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("?$NVR_DAY_TAG=$NVR_DIR_DAYS[1]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[1]); ?> ' <?php echo($activebutton[1]); ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("?$NVR_DAY_TAG=$NVR_DIR_DAYS[2]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[2]); ?>' <?php echo($activebutton[2]); ?> >
			</a>
			</div>
		</div>
		<div class=col4>
			<div class=space>
			<a href=<?php echo("?$NVR_DAY_TAG=$NVR_DIR_DAYS[3]"); ?> >
				<input type=submit id=submitar name=submitar value='<?php echo($L_DAYS[3]); ?>' <?php echo($activebutton[3]); ?> >
			</a>
			</div>
		</div>
	</div>

	<?php 
	}
	filetable($aktdir,$day);
}


function filetable($dir,$day){
	global $NVR_FILEEXT,$L_DOWNLOAD_TEXT,$L_TABLE,$NVR_VIDEO_PLAYER,
			$NVR_TAG,$NVR_DEL_TAG,$NVR_DAY_TAG,$NVR_STORE_DIR,
			$L_PLAYER,$L_DOWNLOAD,$L_DELETE,$L_FILTER,$L_STORE;

	$files=scandir($dir,SCANDIR_SORT_DESCENDING);
	usort($files, function ($a, $b){
		$s1=strtotime(substr($b,strlen($b)-12,8));
		$s2=strtotime(substr($a,strlen($a)-12,8));
		return  $s1-$s2;
	});
	$files=scandir($dir,SCANDIR_SORT_DESCENDING);
	usort($files, function ($a, $b){
		$s1=strtotime(substr($b,strlen($b)-12,8));
		$s2=strtotime(substr($a,strlen($a)-12,8));
		return  $s1-$s2;
	});
	if ($day===$NVR_STORE_DIR){
		$fil=$L_FILTER." - ".$L_STORE;
	}else{
		$fil=$L_FILTER;
	}
	echo("<div class=filter>");
	echo('<input type="text" placeholder=\''.$fil.'\' id="filterin" autofocus
			onkeyup="tfilter(\'filterin\')"
			onclick="this.value=\'\'">');
	echo("</div>");
	echo("<table class='df_table_full' id='ktable'>");
	echo("<tr class='df_trh'>");
	echo("<th class='df_th1'>$L_TABLE[0]</th>");
	echo("<th class='df_th2'>$L_TABLE[1]</th>");
	echo("<th class='df_th2'>$L_TABLE[2]</th>");
	echo("<th class='df_th2'>$L_TABLE[3]</th>");
	echo("</tr>");
	foreach ($files as $entry) {
		if ($entry!="." && $entry!=".." && $entry!="lost+found") {
			$fileext=explode('.',$entry);
			$fileext_name=$fileext[count($fileext)-1];
			$fileext_name2='.'.$fileext_name;
			if ((in_array($fileext_name, $NVR_FILEEXT))or(in_array($fileext_name2, $NVR_FILEEXT))){
				echo("<tr class='df_tr'>");
				$fileext_name=strtoupper($fileext_name);
				echo("<td class='df_td'>$entry");
				echo("</td>");
				echo("<td class='df_td2'>");
				echo("<a href='?$NVR_DAY_TAG=$day&$NVR_DEL_TAG=$dir/$entry' class='df_tda2'>$L_DELETE</a>");
				echo("</td>");
				echo("<td class='df_td2'>");
				echo("<a href='$dir/$entry' download class='df_tda2' onclick='delrow(this);'>$L_DOWNLOAD</a>");
				echo("</td>");
				echo("<td class='df_td2'>");
				echo("<a href='?$NVR_DAY_TAG=$day&$NVR_TAG=$dir/$entry' class='df_tda2' onclick='delrow(this);'>$L_PLAYER</a>");
				echo("</td>");
				echo("</tr>");
			}
		}
	}
	echo("</table>");
	echo("</center>");
}




?>

<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #


# load config 
if (file_exists("config/config.php")){
	include("config/config.php");
}

echo($MA_DOCTYPE);
 
for ($i=0;$i<count($MA_LIB);$i++){
	if (file_exists("$MA_LIB[$i]")){
		include("$MA_LIB[$i]");
	}
}

# css setting
setcss();

# login
login();

# build page: header
page_header();

if ($MA_LOGGEDIN){

	# private menu
	$param="";
	$loaded=false;
	if (isset($_GET["$MA_MENU_FIELD"])){
		$param=$_GET["$MA_MENU_FIELD"];
		if (substr($param,strlen($param)-3,3)=="php"){
			$af=$MA_CONTENT_DIR."/".$param;
			if (file_exists($af)){
				include($af);
				$loaded=true;
			}
		}
	}

	if (!$loaded){
		# load local app file
		for ($i=0;$i<count($MA_APPFILE);$i++){
			if (file_exists($MA_APPFILE[$i])){
				include($MA_APPFILE[$i]);
			}
		}
	}

	if ($param<>"" && !$loaded){
		if (function_exists($param)){
			$param();
		}
	}else{
		if (function_exists("main")){
			main();
		}
	}
	
}else{
	login_form();
}

# end local app file


# page end
page_footer();

?>

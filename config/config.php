<?php

 #
 # MiniApps - framework
 #
 # info: main folder copyright file
 #
 #

# configuration

# copyright link
$MA_COPYRIGHT="© ".date("Y").". <a href=https://github.com/pphome2>Github</a>";

# title, home link
$MA_SITENAME="piNVR";
$MA_SITE_HOME="http://www.google.com";
$MA_DOCTYPE="<!DOCTYPE HTML>";

# directories
$MA_CONFIG_DIR="config";
$MA_INCLUDE_DIR="inc";
$MA_CONTENT_DIR="content";

$MA_COOKIE_STYLE="st";
$MA_COOKIE_USER="user";
$MA_COOKIE_PASSWORD="passw";
$MA_COOKIE_TIME="ltime";

# include files
$MA_ADMINFILE="start.php";
$MA_PRIVACY="privacy.php";
$MA_PRINTFILE="print.php";
$MA_CSS=array(
			"$MA_INCLUDE_DIR/siteb.css",
			"$MA_INCLUDE_DIR/sitew.css"
			);
$MA_CSSPRINT="$MA_INCLUDE_DIR/sitepr.css";
$MA_JS_BEGIN="$MA_INCLUDE_DIR/js_begin.js";
$MA_JS_END="$MA_INCLUDE_DIR/js_end.js";
$MA_HEADER="$MA_INCLUDE_DIR/header.php";
$MA_FOOTER="$MA_INCLUDE_DIR/footer.php";
$MA_LIB=array(
			"$MA_INCLUDE_DIR/lib.php",
			"$MA_INCLUDE_DIR/libview.php"
			);

# local app admin file
$MA_APPFILE=array(
					"$MA_CONTENT_DIR/nvr.php",
					"$MA_CONTENT_DIR/nvr_serv.php",
					"$MA_CONTENT_DIR/nvr_view.php",
					"$MA_CONTENT_DIR/nvr_func.php"
				);

# language
$MA_LANGFILE="hu.php";

# search
$MA_SEARCH_ICON_HREF="search.php";
$MA_SEARCH_ICON_JS="";

# other variables
$MA_NOPAGE=false;
$MA_PASSWORD="";
$MA_LOGIN_TIME="";
$MA_LOGGEDIN=false;
$MA_STYLEINDEX=0;
$MA_LOGOUT_IN_HEADER=true;
$MA_PRIVACY_PAGE=false;

# auto logout - second
$MA_LOGIN_TIMEOUT=600;
$MA_ENABLE_COOKIES=true;
$MA_ADMIN_USER=false;
$MA_USERPAGE=false;

# multiuser
$MA_ENABLE_USERNAME=false;
$MA_USERS_ADMINUSERS=array(
				"admin"
			);
$MA_USERS_CRED=array(
					array("admin","e3274be5c857fb42ab72d786e281b4b8"),
					array("user","5f4dcc3b5aa765d61d8327deb882cf99"),
				);
# need md5 passcode -- user password: password - admin password: adminpassword

# menu
$MA_MENU_FIELD="m";
$MA_MENU=array();

# adminmenu
$MA_ADMINMENU_FIELD="m";
$MA_ADMINMENU=array();

# load language file
if (file_exists("$MA_CONFIG_DIR/$MA_LANGFILE")){
	include("$MA_CONFIG_DIR/$MA_LANGFILE");
}


# if not enable cookie support:
# - all form need add this lines
#
#		<input type='hidden' name='$MA_COOKIE_PASSWORD' id='$MA_COOKIE_PASSWORD' value='$MA_PASSWORD'>
#		<input type='hidden' name='$MA_COOKIE_STYLE' id='$MA_COOKIE_STYLE' value='$MA_STYLEINDEX'>
#		<input type='hidden' name='$MA_COOKIE_TIME' id='$MA_COOKIE_TIME' value='$MA_LOGIN_TIME'>
#


############################################

# local app config, variables

# manuname and function name
$MA_MENU=array(
				array($L_MENU_TODAY,"today"),
				array($L_MENU_SERVICES,"services"),
				array($L_MENU_STORE,"store"),
				array($L_MENU_LIVE,"liveview")
			);

#$MA_ADMINMENU=array(
#				array($L_MENU2,"list.php")
#			);

# program parameters
$NVR_FILEEXT=array('mp4','jpg');
$NVR_SUPPORT_VIDEO=array('mp4');
$NVR_DIR_DAYS=array('0','1','2','3');

# directories, files
$NVR_DIR='./seccam';
$NVR_RUN_FILE="nvr.run";
$NVR_TIME_FILE="nvr.day.";
$NVR_LIVESTREAM_FILE="nvr.live";
$NVR_STORE_DIR="TT";

# page parameter
$NVR_TAG="v";
$NVR_DAY_TAG="d";
$NVR_SERVICE_TAG="s";
$NVR_DEL_TAG="r";
$NVR_MAIN_TAG="x";
$NVR_SERV_TAG="s";
$NVR_STORE_TAG="t";

# video dimension
$NVR_WIDTH="65%";
$NVR_HEIGHT="65%";

# generated date file name filter
$NVR_FILTER_FIRSTLETTER="2";

# live cam stream (from camera)
#$NVR_LIVE_STREAM=array(
#						array($L_CAM_1,'http://192.168.10.200:8081/1/stream'),
#						array($L_CAM_2,'http://192.168.10.200:8081/2/stream'),
#						array($L_CAM_3,'http://192.168.10.200:8081/3/stream')
#					);
$NVR_LIVE_STREAM=array(
						array($L_CAM_NAME[0],'seccam/1.jpg'),
						array($L_CAM_NAME[1],'seccam/1.jpg'),
						array($L_CAM_NAME[2],'seccam/1.jpg'),
						array($L_CAM_NAME[3],'seccam/1.jpg'),
						array($L_CAM_NAME[4],'seccam/1.jpg')
					);

$NVR_LIVE_IMAGE_SIZE="80%";

# live image plugin
$NVR_LIVE_IMAGE_APP="live/live.php";

# night config
$NVR_NIGHT_START="21:00";
$NVR_NIGHT_STOP="06:00";

?>

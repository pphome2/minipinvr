<?php

 #
 # nvr - System information app
 #
 # info: main folder copyright file
 #
 #



function searchpage(){
	global $L_SEARCH,$L_NO_AVAILABLE;

	echo("<center>");
	echo("<h1>$L_SEARCH</h1>");
	echo("<p>$L_NO_AVAILABLE</p>");
	echo("</center>");
}

	
function privacypage(){
	global $L_PRIVACY_HEADER,$L_PRIVACY_TEXT;

	echo("<center>");
	echo("<h1>$L_PRIVACY_HEADER</h1>");
	echo("<p>$L_PRIVACY_TEXT</p>");
	echo("</center>");
}

function printpage(){
	global $L_PRINT,$L_NO_AVAILABLE;

	echo("<center>");
	echo("<h1>$L_PRINT</h1>");
	echo("<p>$L_NO_AVAILABLE</p>");
	echo("</center>");
}



?>

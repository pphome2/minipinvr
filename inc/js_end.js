<script>

<?php
if ($MA_LOGGEDIN){
	if ($MA_ENABLE_COOKIES){
?>
	setTimeout(function () { window.location.href = "<?php echo($MA_ADMINFILE); ?>"; }, <?php echo((($MA_LOGIN_TIMEOUT+1)*1000)); ?>);
<?php
	}else{
?>
	setTimeout(function () { window.location.href = "<?php echo($MA_ADMINFILE.'?'.$MA_COOKIE_STYLE.'='.$MA_STYLEINDEX); ?>"; }, <?php echo((($MA_LOGIN_TIMEOUT+1)*1000)); ?>);
<?php
	}
}
?>


function tfilter(inname) {
	var input, sfilter, table, tr, td, i;
	input = document.getElementById(inname);
	sfilter = input.value.toUpperCase();
	table = document.getElementById("ktable");
	tr = table.getElementsByTagName("tr");
	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];
		if (td) {
			if (td.innerHTML.toUpperCase().indexOf(sfilter) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
}


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

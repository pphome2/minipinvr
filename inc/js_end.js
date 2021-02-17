<script>

<?php
if ($MA_ENABLE_COOKIES){
?>
setTimeout(function () { window.location.href = "<?php echo($MA_ADMINFILE); ?>"; }, <?php echo((($MA_LOGIN_TIMEOUT+1)*1000)); ?>);
<?php
}else{
?>
setTimeout(function () { window.location.href = "<?php echo($MA_ADMINFILE.'?'.$MA_COOKIE_STYLE.'='.$MA_STYLEINDEX); ?>"; }, <?php echo((($MA_LOGIN_TIMEOUT+1)*1000)); ?>);
<?php
}
?>

</script>

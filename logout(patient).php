<?php 
	session_start();
	session_destroy();
	echo "<script>alert('LogOut')</script>";
	echo "<script>window.location='index.php'</script>";

?>
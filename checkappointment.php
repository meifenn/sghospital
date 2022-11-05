<?php
include ('connect.php');
if (isset($_REQUEST['AppointmentID'])) 
{
	$aid=$_REQUEST['AppointmentID'];
	$Select="UPDATE appointment SET status='Confirm Appointment' where AppointmentID='$aid'";
	$query=mysqli_query($connection,$Select);
	if ($query) 
	{
		echo "<script>
		alert('Appointment Confirm')
		window.location='Home.php'</script>";
	}
}
?>
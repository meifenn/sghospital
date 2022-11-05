<?php 
include('connect.php');
$txtdocID=$_GET['DoctorID'];

$delete="DELETE FROM docregister WHERE DoctorID='$txtdocID'";
$result=mysqli_query($connection,$delete);

if ($result) 
{
	echo "<script>window.alert('Information Delete Successfully.')</script>";
	echo "<script>window.location='Doctor.php'</script>";
}
else
{
	echo "<p>Failed!!! Please Try Again.".mysqli_error($connection)."</p>";
}

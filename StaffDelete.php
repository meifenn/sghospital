<?php 
include('connect.php');
$txtstaffID=$_GET['StaffID'];

$delete="DELETE FROM staff WHERE StaffID='$txtstaffID'";
$result=mysqli_query($connection,$delete);

if ($result) 
{
	echo "<script>window.alert('Information Delete Successfully.')</script>";
	echo "<script>window.location='Staff.php'</script>";
}
else
{
	echo "<p>Failed!!! Please Try Again.".mysqli_error($connection)."</p>";
}
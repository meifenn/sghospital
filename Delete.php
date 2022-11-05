<?php 
include('connect.php');
$txtroomID=$_GET['RoomID'];

$delete="DELETE FROM room WHERE RoomID='$txtroomID'";
$result=mysqli_query($connection,$delete);

if ($result) 
{
	echo "<script>window.alert('Information Delete Successfully.')</script>";
	echo "<script>window.location='Room.php'</script>";
}
else
{
	echo "<p>Failed!!! Please Try Again.".mysqli_error($connection)."</p>";
}
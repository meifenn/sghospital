<?php 
function Add($txtdocid,$roomid,$txtdutytime,$txtdutydate)
{
	$host="localhost";
	$user="root";
	$pass="";
	$database="sghospitaldb";
	$connection=mysqli_connect($host,$user,$pass,$database);
	$query="SELECT * FROM docregister WHERE DoctorID='$txtdocid'";
	$ret=mysqli_query($connection,$query,$roomquery);
	$count=mysqli_num_rows($ret);
	if ($count<1)
	 {
		echo "<p>No Record Found.</p>";
		//exit();
	}
	$arr=mysqli_fetch_array($ret);
	$doctorname=$arr['DoctorName'];
	$docimage=$arr['Image'];

	$query1="SELECT * FROM room WHERE RoomID='$roomid'";
	$ret1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($ret1);
	$arr1=mysqli_fetch_array($ret1);
	$roomtype=$arr1['RoomType'];

	if(isset($_SESSION['schedulefunction'])) 
	{
	  $index=IndexOf($txtdocid);
	  if($index==-1)	
	  {
	  	$size=count($_SESSION['schedulefunction']);

		$_SESSION['schedulefunction'][$size]['DoctorID']=$txtdocid;
	  	$_SESSION['schedulefunction'][$size]['DoctorName']=$doctorname;
	  	$_SESSION['schedulefunction'][$size]['DutyDate']=$txtdutydate;
	  	$_SESSION['schedulefunction'][$size]['DutyTime']=$txtdutytime;
	  	$_SESSION['schedulefunction'][$size]['RoomID']=$roomid;
	  	$_SESSION['schedulefunction'][$size]['RoomType']=$roomtype;
	  	$_SESSION['schedulefunction'][$size]['docimage']=$docimage;

}
	}
	else
	{
		$_SESSION['schedulefunction']=array();
		$_SESSION['schedulefunction'][0]['DoctorID']=$txtdocid;
	  	$_SESSION['schedulefunction'][0]['DoctorName']=$doctorname;
	  	$_SESSION['schedulefunction'][0]['DutyDate']=$txtdutydate;
	  	$_SESSION['schedulefunction'][0]['DutyTime']=$txtdutytime;
	  	$_SESSION['schedulefunction'][0]['RoomID']=$roomid;
	  	$_SESSION['schedulefunction'][0]['RoomType']=$roomtype;
	  	$_SESSION['schedulefunction'][0]['docimage']=$docimage;

	}
	echo "<script>window.location='schedule.php'</Script>";
}
	function IndexOf($txtdocid)
  {
  	if(!isset($_SESSION['schedulefunction']))
  	{
  		return -1;
  	}
  	$size=count($_SESSION['schedulefunction']);
  	if($size==0)
  	{
  		return -1;
  	}
  	for($i=0; $i<$size; $i++)
  	{
  		if($txtdocid==$_SESSION['schedulefunction'][$i]['DoctorID'])
     {
     	return $i;
     }
  	}
     return -1;
  }

  function Remove($txtdocid)
{
	$index=IndexOf($txtdocid);
	if($index!=-1)
	{
		unset($_SESSION['schedulefunction'][$index]);
		echo "<script>window.location='schedule.php'</script>";
	}
}
 ?>

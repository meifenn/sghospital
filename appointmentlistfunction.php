<?php 
function Add($doctorID)
{
	$connect=mysqli_connect("localhost","root","","sghospitaldb");
	$query="SELECT * 
    FROM docregister d,schedetail sd, docschedule s, room r
    WHERE s.ScheduleID=sd.ScheduleID
    AND d.DoctorID=sd.DoctorID
    AND d.DoctorID='$doctorID'";
	$ret=mysqli_query($connect,$query);
	$count=mysqli_num_rows($ret);
	if ($count<1) 
	{
		echo "<p>No Record Found.</p>";
		exit();
	}
 $arr=mysqli_fetch_array($ret);
 $docname=$arr['DoctorName'];
 $specialities=$arr['Specialities'];
 $image=$arr['Image'];
 $dutydate=$arr['DutyDate'];
 $dutytime=$arr['DutyTime'];

 if (isset($_SESSION['appointmentlist']))
 {
 	  $index=IndexOf($doctorID);
	  if($index==-1)	
	  {
	  	$size=count($_SESSION['appointmentlist']);

	  	$_SESSION['appointmentlist'][$size]['DoctorID']=$doctorID;
	  	$_SESSION['appointmentlist'][$size]['DoctorName']=$docname;
	  	$_SESSION['appointmentlist'][$size]['Specialities']=$specialities;
	  	$_SESSION['appointmentlist'][$size]['Image']=$image;
	  	$_SESSION['appointmentlist'][$size]['DutyDate']=$dutydate;
	  	$_SESSION['appointmentlist'][$size]['DutyTime']=$dutytime;
	} 	
 }
 else
 {
 	$_SESSION['appointmentlist']=array();
 	$_SESSION['appointmentlist'][0]['DoctorID']=$doctorID;
 	$_SESSION['appointmentlist'][0]['DoctorName']=$docname;
 	$_SESSION['appointmentlist'][0]['Specialities']=$specialities;
 	$_SESSION['appointmentlist'][0]['Image']=$image;
 	$_SESSION['appointmentlist'][0]['DutyDate']=$dutydate;
 	$_SESSION['appointmentlist'][0]['DutyTime']=$dutytime;
 }
   echo "<script>window.location='AppointmentListtemplate.php'</script>";
}
function IndexOf($doctorID)
  {
  	if(!isset($_SESSION['appointmentlist']))
  	{
  		return -1;
  	}
  	$size=count($_SESSION['appointmentlist']);
  	if($size==0)
  	{
  		return -1;
  	}
  	for($i=0; $i<$size; $i++)
  	{
  		if($doctorID==$_SESSION['appointmentlist'][$i]['DoctorID'])
     {
     	return $i;
     }
  	}
     return -1;
  }
	function Remove($doctorID)
{
	$index=IndexOf($doctorID);
	if($index!=-1)
	{
		unset($_SESSION['appointmentlist'][$index]);
		echo "<script>window.location='AppointmentListtemplate.php'</script>";
	}
}
 ?>
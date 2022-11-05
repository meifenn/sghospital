<?php 
function Add($appointmentid)
{
	$connect=mysqli_connect("localhost","root","","sghospitaldb");
	$query="SELECT * 
    FROM docregister d,schedetail sd, appointment a, appointmentdetail ad, patientregister p
    WHERE a.AppointmentID=ad.AppointmentID
    AND ad.DoctorID=d.DoctorID
    AND p.PatientID=a.PatientID
    AND a.AppointmentID='$appointmentid'";
	$ret=mysqli_query($connect,$query);
	$count=mysqli_num_rows($ret);
	if ($count<1) 
	{
		echo "<p>No Record Found.</p>";
		exit();
	}
 $arr=mysqli_fetch_array($ret);
 $docname=$arr['DoctorName'];
 $pname=$arr['PatientName'];
 $image=$arr['Image'];
 $dutydate=$arr['DutyDate'];

 if (isset($_SESSION['treatment']))
 {
 	  $index=IndexOf($appointmentid);
	  if($index==-1)	
	  {
	  	$size=count($_SESSION['treatment']);
	  	$_SESSION['treatment'][$size]['AppointmentID']=$appointmentid;
	  	$_SESSION['treatment'][$size]['DoctorName']=$docname;
	  	$_SESSION['treatment'][$size]['PatientName']=$pname;
	  	$_SESSION['treatment'][$size]['Image']=$image;
	  	$_SESSION['treatment'][$size]['DutyDate']=$dutydate;
	} 	
 }
 else
 {
 	$_SESSION['treatment']=array();
 	$_SESSION['treatment'][0]['AppointmentID']=$appointmentid;
 	$_SESSION['treatment'][0]['DoctorName']=$docname;
 	$_SESSION['treatment'][0]['PatientName']=$pname;
 	$_SESSION['treatment'][0]['Image']=$image;
 	$_SESSION['treatment'][0]['DutyDate']=$dutydate;
 }
   echo "<script>window.location='treatmenttemplate.php'</script>";
}
function IndexOf($appointmentid)
  {
  	if(!isset($_SESSION['treatment']))
  	{
  		return -1;
  	}
  	$size=count($_SESSION['treatment']);
  	if($size==0)
  	{
  		return -1;
  	}
  	for($i=0; $i<$size; $i++)
  	{
  		if($appointmentID==$_SESSION['treatment'][$i]['AppointmentID'])
     {
     	return $i;
     }
  	}
     return -1;
  }
	function Remove($appointmentid)
{
	$index=IndexOf($appointmentID);
	if($index!=-1)
	{
		unset($_SESSION['treatment'][$index]);
		echo "<script>window.location='treatmenttemplate.php'</script>";
	}
}
 ?>
<?php
session_start();
include ('connect.php');
include ('appointmentlistfunction.php');
include('AutoID.php');
if (isset($_POST['btnappointment'])) 
{
   $appointmentid=$_POST['txtappointmentID'];
   $patientid=$_SESSION['pid'];
   $status="Appointment";
   $query="INSERT INTO appointment
                      (AppointmentID,PatientID,status)
VALUES
('$appointmentid','$patientid','$status')";
$ret=mysqli_query($connection,$query);

$size=count($_SESSION['appointmentlist']);
for ($i=0; $i <$size ; $i++) 
{ 
  $doctorID=$_SESSION['appointmentlist'][$i]['DoctorID'];
  $dutydate=$_SESSION['appointmentlist'][$i]['DutyDate'];

  $insert_apdetail="INSERT INTO appointmentdetail
 (AppointmentID, DoctorID, apdate)
 VALUES
 ('$appointmentid','$doctorID','$dutydate')";
 $ret1=mysqli_query($connection,$insert_apdetail);
}
 if($ret1) 
 {
   echo "<script>alert('Appointment Process Complete')</script>";
   echo "<script>window.location='finddoctor.php'</script>";
 }
}
if (isset($_GET['action'])) 
{
	$action=$_GET['action'];
	if ($action==="appointment")
	{
		$doctorID=$_GET['doctorID'];
		Add($doctorID);
	}

	elseif ($action==='remove') 
	{
		$doctorID=$_GET['doctorID'];
		Remove($doctorID);
	}
}
?>
<?php 
include('header(Admin).php');
 ?>
            <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="top-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                    <p class="bold text-left">Monday - Saturday</p>
                    </div>
                    <div class="col-sm-6 col-md-6">
                    <p class="bold text-right">Call us now +923 842 355</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container navigation">
        
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">
                    <h2>SGHospital</h2>
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
              <ul class="nav navbar-nav">
                <li><a href="finddoctor.php">Find Doctor?</a></li>
                <li class="active"><a href="AppointmentListtemplate.php">Appointment</a></li>
                <li><a href="treatmenttemplate.php">Treatment Record</a></li>
                <li><a href="treatmentsearch.php">Search Treatment Record</a></li>
                <li><a href="feedback.php">Feedback</a></li>
                <li><a href="logout(patient).php">Logout</a></li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Section: intro -->
    <section id="intro" class="intro">
        <div class="intro-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-wrapper">
                        <div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
                        
                            <div class="panel panel-skin">
                            <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Appointment List</h3>
                                    </div>
                                    <div class="panel-body">
                                    <form action="AppointmentListtemplate.php" method="POST">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Appointment ID</label>
                                                    <input  name="txtappointmentID"  type="text"  value="<?php echo AutoID('appointment','AppointmentID','AP-',5) ?>" class="form-control input-md" readonly />
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Patient Name</label>
                                                    <input type="text" name="txtpatientname" value="<?php echo $_SESSION['pname'] ?>" class="form-control input-md"/>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" name="btnappointment" class="btn btn-skin btn-sm-12 btn-lg">
                                        <a href="finddoctor.php">Back to Find Doctor?</a>
                                        </div>
                                </div>
                        </div>
                    </div>
                    </div>
                </div>                  
            </div>      
        </div>
    </div>
    <br>
    <fieldset>
		<legend align="center">Appointment List</legend>
		<?php
		if (!isset($_SESSION['appointmentlist'])) 
		{
			echo "<p>No Appointment History Found.</p>";
			exit();
		}
		?>
		<table align="center" width="65%" border="1" cellpadding="3px">
			<tr>
				<th>Image</th>
				<th>Doctor Name</th>
				<th>Specialities</th>
				<th>Date</th>
				<th>Time</th>
				<th>Action</th>
			</tr>
		<?php
		$size=count($_SESSION['appointmentlist']);
		for ($i=0; $i <$size ; $i++) 
		{ 
			$doctorID=$_SESSION['appointmentlist'][$i]['DoctorID'];
	  		$docname=$_SESSION['appointmentlist'][$i]['DoctorName'];
	  		$specialities=$_SESSION['appointmentlist'][$i]['Specialities'];
	  		$image=$_SESSION['appointmentlist'][$i]['Image'];
	  		$dutydate=$_SESSION['appointmentlist'][$i]['DutyDate'];
	  		$dutytime=$_SESSION['appointmentlist'][$i]['DutyTime'];

			echo"<tr>";
			echo"<td><img src='$image' width='100px' height='100px'/></td>";
			echo "<td>$docname</td>";
			echo "<td>$specialities</td>";
			echo "<td>$dutydate</td>";
			echo "<td>$dutytime</td>";
			echo "<td><a href='AppointmentListtemplate.php?action=remove&doctorID=$doctorID' style='color:red'>Remove</a><td>";

			echo "</tr>";
		}
		?>
	</table>
	</fieldset>
    </section>
<?php 
    include('footer.php');
?>
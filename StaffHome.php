<?php 
	include('connect.php');

if(isset($_POST['btnSearch']))
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if($rdoSearchType==1) 
	{
		$AppointmentID=$_POST['cboAppointmentID'];

		$Squery="SELECT a.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p 
				 WHERE a.AppointmentID='$AppointmentID'
				 AND a.PatientID=p.PatientID";
		$result=mysqli_query($connection,$Squery);
	}
	elseif ($rdoSearchType==2) 
	{
		$txtFrom=date('Y-m-d',strtotime($_POST['txtFrom']));
		$txtTo=date('Y-m-d',strtotime($_POST['txtTo']));

		$Squery="SELECT a.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p 
				 WHERE a.appointmentdate BETWEEN '$txtFrom' AND '$txtTo'
				 AND a.PatientID=p.PatientID";
		$result=mysqli_query($connection,$Squery);
	}
	else
	{
		$Squery="SELECT a.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p 
				 WHERE a.PatientID=p.PatientID";
		$result=mysqli_query($connection,$Squery);
	}
}
elseif(isset($_POST['btnShowAll']))
{
	$Squery="SELECT a.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p 
				 WHERE a.PatientID=p.PatientID";
	$result=mysqli_query($connection,$Squery);
}
else
{
	$todayDate=date('Y-m-d');

	$Squery="SELECT a.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p 
				 WHERE a.appointmentdate='$todayDate'
				 AND a.PatientID=p.PatientID";
	$result=mysqli_query($connection,$Squery);
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
			  	<li class="active"><a href="StaffHome.php">Home</a></li>
				<li><a href="Doctor.php">Doctors</a></li>
				<li><a href="Room.php">Rooms</a></li>
				<li><a href="schedule.php">Schedule</a></li>
				<li><a href="logout.php">Logout</a></li>
				<li class="dropdown"> 
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge custom-badge red pull-right">Extra</span>More <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href="Staff.php">Manage Staff</a></li>
				  </ul>
				</li>
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
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Find Appointment List</h3>
									</div>
									<div class="panel-body">
									<form action="StaffHome.php" method="POST">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Search</label><br>
													<input type="radio" name="rdoSearchType" value="1" checked /> Search by AppointmentID<br/>
													<select name="cboAppointmentID">
													<option>Choose AppointmentID</option>
													<?php  
														$query="SELECT a.*,p.PatientID,p.pName
																FROM appointment a,patientregister p 
																WHERE a.PatientID=p.PatientID";
														$ret=mysqli_query($connection,$query);
														$count=mysqli_num_rows($ret);

														for($i=0;$i<$count;$i++) 
														{ 
															$arr=mysqli_fetch_array($ret);
															$AppointmentID=$arr['AppointmentID'];
															$PatientName=$arr['pName'];	

															echo "<option value='$AppointmentID'>" . $AppointmentID ."</option>";
														}
													?>
													</select>
												</div>
											</div>
										</div><div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Search Date</label><br>
													<input type="radio" name="rdoSearchType" value="2"/> Search by Date <br>
													From:<input  type="date" name="txtFrom" value="<?php echo date('d-m-Y') ?>" class="form-control input-md" />
													To  :<input type="date" name="txtTo" value="<?php echo date('d-m-Y') ?>" class="form-control input-md"/>
												</div>
											</div>
										</div>
										<input type="submit" name="btnSearch" value="Search" class="btn btn-skin btn-sm-6 btn-lg">
										 <input type="submit" value="Show All" name="btnShowAll" class="btn btn-skin btn-sm-6 btn-lg">
										</div>
								</div>
						</div>				
						
					</div>
					</div>
				</div>					
			</div>		
		</div>
	</div><br>
	<fieldset>
<legend align="center">Search Results :</legend>
<?php  
	$count=mysqli_num_rows($result);

	if($count==0) 
	{
		echo "<p align='center'>No Order Record Found.</p>";
		exit();
	}
	?>
	<table id="tableid" class="display" align="center" border="1px" width="65%">
	<thead>
	<tr>
		<th>Appointment ID</th>
		<th>Patient Name</th>
		<th>Appointment Date</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>	
	<?php
	for($i=0;$i<$count;$i++) 
	{
		$arr=mysqli_fetch_array($result);
		$AppointmentID=$arr['AppointmentID'];
		$PatientName=$arr['pName'];
		$appointmentdate=$arr['appointmentdate'];
		$status=$arr['status'];
		echo "<tr>";
			echo "<td>$AppointmentID</td>";
			echo "<td>$PatientName </td>";
			echo "<td>$appointmentdate</td>";
			echo "<td>$status</td>";
			echo "<td> 
					<a href='checkappointment.php?AppointmentID=$AppointmentID' style='color:red'>Accept</a>
				  </td>";
		echo "</tr>";
	}
	?>
	</tbody>
	</table>
</fieldset>
    </section>
<?php 
	include('footer.php');
?>
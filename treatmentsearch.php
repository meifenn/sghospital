<?php 
	include('connect.php');

if(isset($_POST['btnSearch']))
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if($rdoSearchType==1) 
	{
		$AppointmentID=$_POST['cboappointmentID'];

		$Squery="SELECT t.*,p.PatientID,p.pName,a.Appointment
				 FROM appointment a,patientregister p, treatment t
				 WHERE a.AppointmentID=t.AppointmentID
				 AND p.PatientID=a.PatientID";
		$result=mysqli_query($connection,$Squery);
	}
	elseif ($rdoSearchType==2) 
	{
		$txtFrom=date('Y-m-d',strtotime($_POST['txtFrom']));

		$Squery="SELECT t.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p,treatment t
				 WHERE t.appointmentdate='$txtFrom'
				 AND a.AppointmentID=t.AppointmentID 
				 AND p.PatientID=a.PatientID";
		$result=mysqli_query($connection,$Squery);
	}
	else
	{
		$Squery="SELECT t.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p, treatment t
				 WHERE p.PatientID=a.PatientID
				 AND a.AppointmentID=t.AppointmentID";
		$result=mysqli_query($connection,$Squery);
	}
}
elseif(isset($_POST['btnShowAll']))
{
	$Squery="SELECT t.*,p.PatientID,p.pName
				 FROM appointment a,patientregister p,treatment t
				 WHERE p.PatientID=a.PatientID
				 AND a.AppointmentID=t.AppointmentID";
	$result=mysqli_query($connection,$Squery);
}
else
{
	$todayDate=date('Y-m-d');

	$Squery="SELECT t.*,p.PatientID,p.pName,t.TreatmentDate
				 FROM appointment a,patientregister p,treatment t 
				 WHERE t.TreatmentDate='$todayDate'
				 AND t.AppointmentID=a.AppointmentID
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
			  	<li><a href="finddoctor.php">Find Doctor?</a></li>
                <li><a href="treatmenttemplate.php">Treatment Record</a></li>
                <li class="active"><a href="treatmentsearch.php">Search Treatment Record</a></li>
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
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Search Treatment List</h3>
									</div>
									<div class="panel-body">
									<form action="treatmentsearch.php" method="POST">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Search</label><br>
													<input type="radio" name="rdoSearchType" value="1" checked /> Search by AppointmentID<br/>
													<select name="cboappointmentID">
													<option>Choose AppointmentID</option>
													<?php  
														$query="SELECT a.*,p.PatientID,p.pName
																FROM appointment a,patientregister p,treatment t 
																WHERE a.PatientID=p.PatientID
																AND t.AppointmentID=a.AppointmentID";
														$ret=mysqli_query($connection,$query);
														$count=mysqli_num_rows($ret);

														for($i=0;$i<$count;$i++) 
														{ 
															$arr=mysqli_fetch_array($ret);
															$treatmentID=$arr['TreatmentID'];
															$AppointmentID=$arr['AppointmentID'];
															$PatientName=$arr['pName'];	

															echo "<option value='$treatmentID'>" . $AppointmentID ."</option>";
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
													Choose Appointment Date:<input  type="date" name="txtFrom" value="<?php echo $treatmentdate ?>" class="form-control input-md" />
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
		<th>Treatment ID</th>
		<th>Appointment ID</th>
		<th>Patient Name</th>
		<th>Treatment Date</th>
		<th>Status</th>
	</tr>
	</thead>
	<tbody>	
	<?php
	for($i=0;$i<$count;$i++) 
	{

		$arr=mysqli_fetch_array($result);
		$treatmentID=$arr['TreatmentID'];
		$AppointmentID=$arr['AppointmentID'];
		$PatientName=$arr['pName'];
		$treatmentdate=$arr['TreatmentDate'];
		$status=$arr['status'];
		echo "<tr>";
			echo "<td>$treatmentID</td>";
			echo "<td>$AppointmentID</td>";
			echo "<td>$PatientName </td>";
			echo "<td>$treatmentdate</td>";
			echo "<td>$status</td>";
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
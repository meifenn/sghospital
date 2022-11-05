<?php 
session_start();
include('connect.php');
if (isset($_POST['btnsend'])) 
{
	$txtfeedback=$_POST['txtfeedback'];
	$patientid=$_SESSION['pid'];

	$insert="INSERT INTO feedback (feedback,PatientID) VALUES ('$txtfeedback','$patientid')";
	
	$ret=mysqli_query($connection,$insert);
	if ($ret) 
	{
		echo "<script>window.alert('We got your message. Thanks U <3')</script>";
		echo "<script>window.location='feedback.php'</script>";
	}
	else
	{
		echo "<p>Please Try Again".mysqli_error($connection)."</p>";
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
				<li><a href="treatmenttemplate.php">Treatment Record</a></li>
				<li><a href="treatmentsearch.php">Search Treatment Record</a></li>
				<li class="active"><a href="feedback.php">Feedback</a></li>
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
									<h4 class="panel-title"><span class="fa fa-pencil-square-o"></span> Thanks you for believing us! Leave a message or any suggestion <3</h4>
									</div>
									<div class="panel-body">
									<form action="feedback.php" method="POST" enctype="multipart/form-data">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Give Feedback</label>
													<br>
													<input name="txtfeedback" class="form-control input-md" required>
												</div>
											</div>
										</div>
										<input type="submit" name="btnsend" value="Send" class="btn btn-skin btn-sm-6 btn-lg">
										 <input type="reset" value="Clear" name="btnclear" class="btn btn-skin btn-sm-6 btn-lg">
										 <a href="logout(patient).php">Logout?</a>
										</div>
								</div>
						</div>				
						
					</div>
					</div>
				</div>					
			</div>		
		</div>
	</div>
	</section>
<?php 
	include('footer.php');
?>
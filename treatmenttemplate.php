<?php
session_start();
include('connect.php');
include('AutoID.php');

if (isset($_POST['btnCheckout'])) 
{
   $treatmentid=$_POST['txttreatmentID'];
   $status="Treatment Done";
   $treatmentdate=$_POST['txtdate'];
   $appointmentid=$_POST['AppointmentID'];
   $query="INSERT INTO treatment
                      (TreatmentID,status,TreatmentDate,AppointmentID)
VALUES
('$treatmentid','$status','$treatmentdate','$appointmentid')";
$ret1=mysqli_query($connection,$query);

	echo "<script>alert('Treatment Record Saved')</script>";
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
                <li class="active"><a href="treatmenttemplate.php">Treatment Record</a></li>
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
                                    <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Treatment List</h3>
                                    </div>
                                    <div class="panel-body">
                                    <form action="treatmenttemplate.php" method="POST">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Treatment ID</label>
                                                    <input  name="txttreatmentID"  type="text"  value="<?php echo AutoID('treatment','TreatmentID','TRE-',5) ?>" class="form-control input-md" readonly />
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Patient Name</label>
                                                    <input type="text" name="txtpatientname" value="<?php echo $_SESSION['pname'] ?>" class="form-control input-md"/>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                         	<div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Appointment ID</label>
                                                    <select name="AppointmentID" class="form-control input-md">
													<?php 
														$select="SELECT * FROM appointment";
														$query=mysqli_query($connection,$select);
														$count=mysqli_num_rows($query);
													if($count>0)
													{
														for ($i=0; $i <$count ; $i++) 
														{ 
															$data=mysqli_fetch_array($query);
															$appointmentid=$data['AppointmentID'];
															echo "<option value='$appointmentid'>$appointmentid</option>";
														}
													}
						 							?>
												</select>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Treatment Date</label>
                                                    <select name="txtdate" class="form-control input-md">
													<?php 
														$select="SELECT * FROM schedetail";
														$query=mysqli_query($connection,$select);
														$count=mysqli_num_rows($query);
													if($count>0)
													{
														for ($i=0; $i <$count ; $i++) 
														{ 
															$data=mysqli_fetch_array($query);
															$treatmentdate=$data['DutyDate'];
															echo "<option value='$treatmentdate'>$treatmentdate</option>";
														}
													}
						 							?>
												</select>
                                                </div>
                                            </div>
                                       	</div>
                                       	 <input type="submit" name="btnCheckout" value="Save" class="btn btn-skin btn-sm-6 btn-lg">
										 <input type="reset" value="Clear" name="btnclear" class="btn btn-skin btn-sm-6 btn-lg">
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
	</section>
<?php 
    include('footer.php');
?>
<?php 
include('connect.php');

if (isset($_REQUEST['DoctorID'])) {
	$docID=$_REQUEST['DoctorID'];
	$query="SELECT * FROM docregister WHERE DoctorID='$docID'";
	$ret=mysqli_query($connection,$query);
	$row=mysqli_fetch_array($ret);
	$docname=$row['DoctorName'];
	$phone=$row['Dphone'];
	$gender=$row['Gender'];
	$email=$row['Email'];
	$password=$row['Password'];
	$specialities=$row['Specialities'];
	$address=$row['Address'];
	$image=$row['Image'];
}
if (isset($_POST['btnUpdate']))
{
	$txtdocID=$_POST['txtdocID'];
	$txtdocname=$_POST['txtdoctorname'];
	$txtphone=$_POST['txtphone'];
	$rdogender=$_POST['rdogender'];
	$txtemail=$_POST['txtemail'];
	$txtpassword=$_POST['txtpassword'];
	$txtspecialities=$_POST['txtspecialities'];
	$txtaddress=$_POST['txtaddress'];
	$docimage=$_FILES['image']['name'];
	$folder="docimage/";

	$filename=$folder. '_' .$docimage;

	$copied=copy($_FILES['image']['tmp_name'], $filename);

	if(!$copied) 
	{
		echo "<script>window.alert('Error: cannot upload photo')</script>";
		exit();
	}

echo $update="UPDATE docregister
		SET DoctorName='$txtdocname',
			Dphone='$txtphone',
			Gender='$rdogender',
			Email='$txtemail',
			Password='$txtpassword',
			Specialities='$txtspecialities',
			Address='$txtaddress',
			Image='$filename'
			WHERE DoctorID='$txtdocID'";
$result=mysqli_query($connection,$update);

if ($result) 
{
	echo"<script>window.alert('Update Successfully')</script>";
	echo "<script>window.location='Doctor.php'</script>";
}
else
{
	echo "<p>Error: ". mysqli_error($connection) ."</p>";
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
			  	<li><a href="StaffHome.php">Home</a></li>
				<li class="active"><a href="Doctor.php">Doctors</a></li>
				<li><a href="Room.php">Rooms</a></li>
				<li><a href="schedule.php">Schedule</a></li>				
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
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Doctor Update</h3>
									</div>
									<div class="panel-body">
									<form action="DocUpdate.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="txtdocID" value="<?php echo $docID?>" class="form-control input-md">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Doctor Name</label>
													<input type="text" name="txtdoctorname" value="<?php echo $docname?>" class="form-control input-md"/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Phone Number</label>
													<input type="text" name="txtphone" value="<?php echo $phone?>" class="form-control input-md"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Gender</label><br>
													<input type="text" name="rdogender" value="<?php echo $gender?>" readonly/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Email</label>
													<input type="text" name="txtemail" value="<?php echo $email?>" class="form-control input-md"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Password</label>
													<input type="text" name="txtpassword" value="<?php echo $password?>" class="form-control input-md"/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Department</label>
													<input type="text" name="txtspecialities" value="<?php echo $specialities?>" class="form-control input-md"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12">
												<div class="form-group">
													<label>Address</label>
													<input name="txtaddress" value="<?php echo $address?>" class="form-control input-md"/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12">
												<div class="form-group">
													<label>Doctor Image</label>
													<input type="file" name="image" value="<?php echo $image?>" class="form-control input-md">
												</div>
											</div>
										</div>
										<input type="submit" value="Update" name="btnUpdate" class="btn btn-skin btn-sm-6 btn-lg">
										<input type="reset" value="Clear" name="btnclear" class="btn btn-skin btn-sm-6 btn-lg">
									</form>
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
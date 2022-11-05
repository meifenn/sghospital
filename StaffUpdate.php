<?php 
include('connect.php');

if (isset($_REQUEST['StaffID'])) {
	$staffID=$_REQUEST['StaffID'];
	$query="SELECT * FROM staff WHERE StaffID='$staffID'";
	$ret=mysqli_query($connection,$query);
	$row=mysqli_fetch_array($ret);
	$staffname=$row['StaffName'];
	$sphone=$row['SPhone'];
	$sgender=$row['Gender'];
	$sposition=$row['Position'];
	$semail=$row['Email'];
	$spassword=$row['Password'];
	$saddress=$row['Address'];
}
if (isset($_POST['btnUpdate']))
{
	$txtstaffID=$_POST['txtstaffID'];
	$txtstaffname=$_POST['txtstaffname'];
	$txtphone=$_POST['txtphone'];
	$rdogender=$_POST['rdogender'];
	$txtposition=$_POST['txtposition'];
	$txtemail=$_POST['txtemail'];
	$txtpassword=$_POST['txtpassword'];
	$txtaddress=$_POST['txtaddress'];

echo $update="UPDATE staff
		SET StaffName='$txtstaffname',
			SPhone='$txtphone',
			Gender='$rdogender',
			Position='$txtposition',
			Email='$txtemail',
			Password='$txtpassword',
			Address='$txtaddress'
			WHERE StaffID='$txtstaffID'";
$result=mysqli_query($connection,$update);

if ($result) 
{
	echo"<script>window.alert('Update Successfully')</script>";
	echo "<script>window.location='Staff.php'</script>";
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
				<li class="active"><a href="Staff.php">Staff</a></li>
				<li><a href="Doctor.php">Doctors</a></li>
				<li><a href="Room.php">Rooms</a></li>
				<li><a href="schedule.php">Schedule</a></li>				<li class="dropdown"> 
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge custom-badge red pull-right">Extra</span>More <b class="caret"></b></a>
				  <ul class="dropdown-menu">
					<li><a href="index.html">Home form</a></li>
					<li><a href="index-video.html">Home video</a></li>
					<li><a href="index-cta.html">Home CTA</a></li>
					<li><a href="https://bootstrapmade.com">Download</a></li>
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
						<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Staff Update</h3>
						</div>
						<div class="panel-body">
						<form action="StaffUpdate.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="txtstaffID" value="<?php echo $staffID?>" class="form-control input-md">
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Staff Name</label>
								<input type="text" name="txtstaffname" value="<?php echo $staffname?>" class="form-control input-md"/>
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Phone</label>
								<input type="text" name="txtphone" value="<?php echo $sphone?>" class="form-control input-md"/>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Gender</label><br>
								<input type="text" name="rdogender" value="<?php echo $sgender?>" readonly/>
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Position</label>
								<input type="text" name="txtposition" value="<?php echo $sposition?>" class="form-control input-md"/>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="txtemail" id="email" value="<?php echo $semail?>" class="form-control input-md"/>
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Password</label>
								<input type="Password" name="txtpassword" value="<?php echo $spassword?>" class="form-control input-md"/>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label>Address</label>
								<input name="txtaddress" value="<?php echo $saddress?>" class="form-control input-md">
							</div>
							</div>
								<input type="submit" value="Update" name="btnUpdate" class="btn btn-skin btn-sm-6 btn-lg">
								<input type="reset" value="Clear" name="btnclear" class="btn btn-skin btn-sm-6 btn-lg">
							</div>
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
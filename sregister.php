<?php 
include('connect.php');

if (isset($_POST['btnsave']))
{
	$txtstaffname=$_POST['txtstaffname'];
	$txtphone=$_POST['txtphone'];
	$rdogender=$_POST['rdogender'];
	$txtposition=$_POST['txtposition'];
	$txtemail=$_POST['txtemail'];
	$txtpassword=$_POST['txtpassword'];
	$txtaddress=$_POST['txtaddress'];

$checkEmail="SELECT Email from staff where Email='$txtemail'";
$ret=mysqli_query($connection,$checkEmail);
$count=mysqli_num_rows($ret);

if ($count>0) 
{
	echo"<script>window.alert('Email already exist. Try another Email Address!')</script>";
	echo"<script>window.location='index.php'</script>";
	exit();
}
$insert= "INSERT INTO staff (StaffName, SPhone, Gender,Position, Email, Password, Address)
	VALUES 
('$txtstaffname','$txtphone','$rdogender','$txtposition','$txtemail','$txtpassword','$txtaddress')";

$ret=mysqli_query($connection,$insert);
if ($ret) 
{
	echo"<script>window.alert('Register Successfully')</script>";
	echo"<script>window.location='index.php'</script>";
}
else
{
	echo "<p>Something went wrong in registration".mysqli_error($connection)."</p>";
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
				<li><a href="login.php">Login</a></li>
				<li class="active"><a href="sregister.php">Register</a></li>
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
						<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Staff Register</h3>
						</div>
						<div class="panel-body">
						<form action="Staff.php" method="post" enctype="multipart/form-data">
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Staff Name</label>
								<input type="text" name="txtstaffname" placeholder="Enter Your Full Name" class="form-control input-md" required/>
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Phone</label>
								<input type="text" name="txtphone" placeholder="09*********" class="form-control input-md" required/>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Gender</label><br>
								<input type="radio" name="rdogender" value="Male">Male 								
								<input type="radio" name="rdogender" value="Female">Female 
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Position</label>
								<input type="text" name="txtposition" placeholder="staff" class="form-control input-md" required/>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="txtemail" placeholder="****@gmail.com" id="email" class="form-control input-md">
							</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
								<label>Password</label>
								<input type="Password" name="txtpassword" placeholder="*********" class="form-control input-md" required/>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label>Address</label>
								<textarea name="txtaddress" class="form-control input-md"></textarea>
							</div>
							</div>
							</div>
								<input type="submit" value="Register" name="btnsave" class="btn btn-skin btn-sm-6 btn-lg">
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
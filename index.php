<?php 
	session_start();
	include('connect.php');
	if(isset($_POST['btnlogin']))
	{
		$email=$_POST['txtemail'];
		$password=$_POST['txtpassword'];

		$select="SELECT * FROM staff where Email='$email' and Password='$password'";
		$query=mysqli_query($connection,$select);
		$count=mysqli_num_rows($query);
		if($count>0)
		{
			echo "<script>alert('Staff Login Successful')</script>";
			echo "<script>window.location='StaffHome.php'</script>";
		}
		else
		{

		$select1="SELECT * FROM patientregister where pEmail='$email' and pPassword='$password'";
		$query1=mysqli_query($connection,$select1);
		$count1=mysqli_num_rows($query1);
		if($count1>0)
		{
			$data=mysqli_fetch_array($query1);
			$pid=$data['PatientID'];
			$pname=$data['pName'];
			$_SESSION['pid']=$pid;
			$_SESSION['pname']=$pname;
			echo "<script>alert('Patient Login Successful')</script>";
			echo "<script>window.location='finddoctor.php'</script>";
		}
		else
		{
			echo "<script>alert('Invalid Login')</script>";
			echo "<script>window.location='index.php'</script>";
		}
			
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
				<li class="active"><a href="index.php">Login</a></li>
				<li><a href="PatientRegister.php">Register</a></li>
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
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Login Form</h3>
									</div>
									<div class="panel-body">
									<form action="index.php" method="POST" enctype="multipart/form-data">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Email</label>
													<input type="Email" name="txtemail" placeholder="****@gmail.com" class="form-control input-md" required/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Password</label>
													<input type="password" placeholder="********" name="txtpassword" class="form-control input-md" required/>
												</div>
											</div>
										</div>
										<input type="submit" name="btnlogin" value="Login" class="btn btn-skin btn-sm-6 btn-lg">
										<input type="reset" value="Clear" name="btnclear" class="btn btn-skin btn-sm-6 btn-lg">
										<a href="PatientRegister.php">No Account?</a>
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
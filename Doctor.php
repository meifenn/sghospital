<?php 
include('connect.php');

if (isset($_POST['btnsave']))
{
	$txtdoctorname=$_POST['txtdoctorname'];
	$txtphone=$_POST['txtphone'];
	$rdogender=$_POST['rdogender'];
	$txtemail=$_POST['txtemail'];
	$txtpassword=$_POST['txtpassword'];
	$txtdepartment=$_POST['txtdepartment'];
	$txtaddress=$_POST['txtaddress'];
	$image=$_FILES['image']['name'];
	$folder="docimage/";

	$filename=$folder. '_' .$image;

	$copied=copy($_FILES['image']['tmp_name'], $filename);
	$roomid=$_POST['roomid'];

	if(!$copied) 
	{
		echo "<script>window.alert('Error: cannot update photo')</script>";
		exit();
	}

$checkEmail="SELECT Email from docregister where Email='$txtemail'";
$ret=mysqli_query($connection,$checkEmail);
$count=mysqli_num_rows($ret);

if ($count>0) 
{
	echo"<script>window.alert('Email already exist. Try another Email Address!')</script>";
	echo"<script>window.location='Doctor.php'</script>";
	exit();
}

$insert= "INSERT INTO docregister (DoctorName, Dphone, Gender, Email, Password, Specialities, Address, Image,RoomID)
	VALUES 
('$txtdoctorname','$txtphone','$rdogender','$txtemail','$txtpassword','$txtdepartment','$txtaddress','$filename','$roomid')";

$ret=mysqli_query($connection,$insert);

if ($ret) 
{
	echo"<script>window.alert('Register Successfully')</script>";
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
			  	<li><a href="StaffHome.php">Home</a></li>
				<li class="active"><a href="Doctor.php">Doctors</a></li>
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
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span> Doctor Register</h3>
									</div>
									<div class="panel-body">
									<form action="Doctor.php" method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Doctor Name</label>
													<input type="text" name="txtdoctorname" placeholder="Enter Your Full Name" class="form-control input-md" required/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Phone Number</label>
													<input type="text" name="txtphone" placeholder="09*********" class="form-control input-md" required/>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Gender</label><br>
													<input type="radio" name="rdogender" value="Male"> Male 
													<input type="radio" name="rdogender" value="Female"> Female
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Email</label>
													<input type="email" name="txtemail" placeholder="****@gmail.com" class="form-control input-md" required/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Password</label><br>
													<input type="Password" name="txtpassword" placeholder="********" class="form-control input-md" required/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Department</label>
													<input type="text" name="txtdepartment" class="form-control input-md" required/>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Address</label>
													<textarea name="txtaddress" class="form-control input-md"></textarea>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Choose Room</label>
													<select name="roomid" class="form-control input-md">
														<?php 
														$select="SELECT * FROM room";
														$query=mysqli_query($connection,$select);
														$count=mysqli_num_rows($query);
														if($count>0)
														{
															for ($i=0; $i <$count ; $i++) 
															{ 
															$data=mysqli_fetch_array($query);
															$roomid=$data['RoomID'];
															$Roomtype=$data['RoomType'];
															echo "<option value='$roomid'>$Roomtype</option>";
															}
														}
														?>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12">
												<div class="form-group">
													<label>Doctor Image</label>
													<input type="file" name="image" class="form-control input-md">
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
	<hr>
	<table border="2" width="65%" cellpadding="3px" align="center">
	<tr>
		<td align="center">Doctor ID</td>
		<td align="center">Doctor Name</td>
		<td align="center">Phone Number</td>
		<td align="center">Gender</td>
		<td align="center">Email</td>
		<td align="center">Specialities</td>
		<td align="center">Address</td>
		<td align="center">Doctor Image</td>
		<td align="center">Action</td>

	</tr>
	<?php 
		$query="SELECT * FROM docregister";
		$ret=mysqli_query($connection,$query);
		$count=mysqli_num_rows($ret);

	for ($i=0; $i <$count ; $i++) { 
		$row=mysqli_fetch_array($ret);
		$txtdocID=$row['DoctorID'];
		$txtdoctorname=$row['DoctorName'];
		$txtphone=$row['Dphone'];
		$rdogender=$row['Gender'];
		$txtemail=$row['Email'];
		$txtspecialities=$row['Specialities'];
		$txtaddress=$row['Address'];
		$image=$row['Image'];

		echo "<tr>";
		echo "<td>" . $txtdocID . "</td>";
		echo "<td>" . $txtdoctorname . "</td>";
		echo "<td>" . $txtphone . "</td>";
		echo "<td>" . $rdogender . "</td>";
		echo "<td>" . $txtemail . "</td>";
		echo "<td>" . $txtspecialities . "</td>";
		echo "<td>" . $txtaddress . "</td>";
		echo "<td><img src='$image' width='100px' height='100px'></td>";
		echo "<td>
		<a href='DocUpdate.php?DoctorID=$txtdocID'>Edit</a>
				|
		<a href='DocDelete.php?DoctorID=$txtdocID'>Delete</a>
			  </td>";
	echo "</tr>";
	}
	?>
	</table>
    </section>
<?php 
	include('footer.php');
?>
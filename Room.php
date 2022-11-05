<?php 
include('connect.php');

if (isset($_POST['btnsave']))
{
	
	$txtroomtype=$_POST['txtroomtype'];

$ret=mysqli_query($connection,$checkEmail);
$count=mysqli_num_rows($ret);

$insert= "INSERT INTO Room (RoomType)
	VALUES 
('$txtroomtype')";

$ret=mysqli_query($connection,$insert);

if ($ret) 
{
	echo"<script>window.alert('Room Register Successfully')</script>";
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
				<li><a href="Doctor.php">Doctors</a></li>
				<li class="active"><a href="Room.php">Rooms</a></li>
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
						<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Room Registration</h3>
						</div>
						<div class="panel-body">
						<form action="Room.php" method="post">
							<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label>Room Type</label>
								<input type="text" name="txtroomtype" placeholder="eg.Office" class="form-control input-md" required/>
							</div>
							</div>
							</div>
								<input type="submit" value="Register" name="btnsave" class="btn btn-skin btn-sm-6 btn-lg">
								<input type="reset" value="Clear" name="btnclear" class="btn btn-skin btn-sm-6 btn-lg">
						</div>
						</div>
						</div>
					</div>
				</div>					
			</div>		
		</div>
	</div>	
	<hr>
	<table border="1" cellpadding="3px" align="center" width="65%">
	<tr>
		<td align="center">Room ID</td>
		<td align="center">Room Type</td>
		<td align="center">Action</td>
	</tr>
	<?php 
		$query="SELECT * FROM room";
		$ret=mysqli_query($connection,$query);
		$count=mysqli_num_rows($ret);

	for ($i=0; $i <$count ; $i++) { 
		$row=mysqli_fetch_array($ret);
		$txtroomID=$row['RoomID'];
		$txtroomtype=$row['RoomType'];

		echo "<tr>";
		echo "<td>" . $txtroomID . "</td>";
		echo "<td>" . $txtroomtype . "</td>";
		echo "<td>
		<a href='RoomUpdate.php?RoomID=$txtroomID'>Edit</a>
				|
		<a href='Delete.php?RoomID=$txtroomID'>Delete</a>
			  </td>";
	echo "</tr>";
	}
	?>
	</table>
    </section>
<?php 
	include('footer.php');
?>
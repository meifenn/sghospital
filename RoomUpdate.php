<?php 
include('connect.php');

if (isset($_REQUEST['RoomID'])) {
	$roomID=$_REQUEST['RoomID'];
	$query="SELECT * FROM room WHERE RoomID='$roomID'";
	$ret=mysqli_query($connection,$query);
	$rows=mysqli_fetch_array($ret);
	$roomtype=$rows['RoomType'];
}
if (isset($_POST['btnUpdate']))
{
	$txtroomID=$_POST['txtroomID'];
	$txtroomtype=$_POST['txtroomtype'];

echo $update="UPDATE room
		SET	RoomType='$txtroomtype'
		WHERE RoomID='$txtroomID'";
$result=mysqli_query($connection,$update);

if ($result) 
{
	echo"<script>window.alert('Update Successfully')</script>";
	echo "<script>window.location='Room.php'</script>";
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
				<li><a href="Staff.php">Staff</a></li>
				<li><a href="Doctor.php">Doctors</a></li>
				<li class="active"><a href="Room.php">Rooms</a></li>
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
						<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Room Update</h3>
						</div>
						<div class="panel-body">
						<form action="RoomUpdate.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="txtroomID" value="<?php echo $roomID?>" class="form-control input-md">
							<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="form-group">
								<label>Room Type</label>
								<input type="text" name="txtroomtype" value="<?php echo $roomtype?>" class="form-control input-md"/>
							</div>
							</div>
							</div>
								<input type="submit" value="Update" name="btnUpdate" class="btn btn-skin btn-sm-6 btn-lg">
								<input type="reset" value="Clear" name="btnclear" class="btn btn-skin btn-sm-6 btn-lg">
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
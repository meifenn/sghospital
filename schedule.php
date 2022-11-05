<?php 
session_start();
include('connect.php');
include('ScheduleFunction.php');
include('AutoID.php');
if (isset($_GET['btnsave'])) 
{
	$txtscheID=$_GET['txtscheID'];
	$StaffID=$_GET['cboStaffID'];
	$txtdate=$_GET['txtdate'];

	$insert_sche="INSERT INTO docschedule
	(ScheduleID,ScheDate,StaffID)values
	('$txtscheID','$txtdate','$StaffID')";
$ret=mysqli_query($connection,$insert_sche);

$size=count($_SESSION['schedulefunction']);
for ($i=0; $i <$size ; $i++) 
{ 
		$txtdocid=$_SESSION['schedulefunction'][$i]['DoctorID'];
	  	$roomid=$_SESSION['schedulefunction'][$i]['RoomID'];
	  	$txtdutydate=$_SESSION['schedulefunction'][$i]['DutyDate'];
	  	$txtdutytime=$_SESSION['schedulefunction'][$i]['DutyTime'];

	$inser_schedetail="INSERT INTO schedetail(ScheduleID,DoctorID,RoomID,DutyDate,DutyTime)
	VALUES('$txtscheID','$txtdocid','$roomid','$txtdutydate','$txtdutytime')";
	$ret=mysqli_query($connection,$inser_schedetail);
}
if ($ret)
 {
	unset($_SESSION['schedulefunction']);
	echo "<script>window.alert('Schedule Lists were saved.')</script>";
	echo "<script>window.location='schedule.php'</script>";
}
else
{
	echo "<p>Something went wrong in saving schedule list:". mysqli_error($connection)."</p>";
}
}
if (isset($_GET['action'])) 
{
	$action=$_GET['action'];
	if ($action==='add') 
	{
        $txtdocid=$_GET['txtdocid'];
		$roomid=$_GET['roomid'];
		$txtdutytime=$_GET['txtdutytime'];
		$txtdutydate=$_GET['txtdutydate'];
		Add($txtdocid,$roomid,$txtdutytime,$txtdutydate);
	}
	elseif ($action==='remove') 
	{
		$txtdocid=$_GET['DoctorID'];
		Remove($txtdocid);
	}
	elseif ($action==='clearall') 
	{
		ClearAll();
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
				<li><a href="Room.php">Rooms</a></li>
				<li class="active"><a href="schedule.php">Schedule</a></li>
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
    <section id="intro" class="intro">
		<div class="intro-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-wrapper">
						<div class="wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.2s">
						
							<div class="panel panel-skin">
							<div class="panel-heading">
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Record Schedule</h3>
									</div>
									<div class="panel-body">
									<form action="schedule.php" method="GET">
										<input type="hidden" name="action" value="add" class="form-control input-md">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Schedule ID</label>
													<input type="text" name="txtscheID" value="<?php echo AutoID ('docschedule','scheduleID','SCHE-',5)?>" class="form-control input-md" readonly/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Schedule Date</label>
													<input type="Date" name="txtdate" value="<?php echo date('Y-m-d')?>" class="form-control input-md" readonly/>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Duty Date</label>
													<input type="Date" name="txtdutydate" value="<?php echo date('Y-m-d')?> " class="form-control input-md" required/>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Duty Time</label>
													<select name="txtdutytime" class="form-control input-md"/>
														<option>12 PM to 3 PM</option>
														<option>3 PM to 6 PM</option>
														<option>6 PM to 9 PM</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Doctor Name</label><br>
													<select name="txtdocid" class="form-control input-md"/>
														<?php 
														$select="SELECT * FROM docregister";
														$query=mysqli_query($connection,$select);
														$count=mysqli_num_rows($query);
														if($count>0)
														{
															for ($i=0; $i <$count ; $i++) 
															{ 
																$data=mysqli_fetch_array($query);
																$txtdocid=$data['DoctorID'];
																$txtdocname=$data['DoctorName'];
																echo "<option value='$txtdocid'>$txtdocname</option>";
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Room Type</label>
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
										 <input type="submit" name="btnAdd" value="Add" class="btn btn-skin btn-sm-6 btn-lg">
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
	<fieldset>
		<legend align="center">Schedule List</legend>
		<?php
		if (!isset($_SESSION['schedulefunction'])) 
		{
			echo "<p align=center>No Purchase Record Found.</p>";
			exit();
		}
		?>
		<table align="center" border="1" cellpadding="3px">
			<tr>
				<th>Doctor Image</th>
				<th>Doctor Name</th>
				<th>Duty Date</th>
				<th>Duty Time</th>
				<th>Room Type</th>
				<th>Action</th>
			</tr>
		<?php
		$size=count($_SESSION['schedulefunction']);
		for ($i=0; $i <$size ; $i++) 
		{ 
			$docid=$_SESSION['schedulefunction'][$i]['DoctorID'];
			$doctorname=$_SESSION['schedulefunction'][$i]['DoctorName'];
			$dutydate=$_SESSION['schedulefunction'][$i]['DutyDate'];
			$dutytime=$_SESSION['schedulefunction'][$i]['DutyTime'];
			$roomid=$_SESSION['schedulefunction'][$i]['RoomID'];
			$roomtype=$_SESSION['schedulefunction'][$i]['RoomType'];
			$docimage=$_SESSION['schedulefunction'][$i]['docimage'];

			echo"<tr>";
			echo"<td><img src='$docimage' width='100px' height='100px'/></td>";
			echo "<td>$doctorname</td>";
			echo "<td>$dutydate</td>";
			echo "<td>$dutytime</td>";
			echo "<td>$roomtype</td>";
			echo "<td><a href='schedule.php?action=remove&DoctorID=$docid'>Remove</a></td>";

			echo "</tr>";
		}
		?>
			<td>Staff Name</td>
			<td>
				<select name="cboStaffID">
					<option>-----Select Staff Name------</option>
					<?php
					$query="Select * FROM staff";
					$ret=mysqli_query($connection,$query);
					$count=mysqli_num_rows($ret);

					for ($i=0; $i <$count ; $i++)
					{ 
						$arr=mysqli_fetch_array($ret);
						$StaffID=$arr['StaffID'];
						$staffname=$arr['StaffName'];
						echo"<option value='$StaffID'>" . $staffname ."</option>";
					}
					?>	
				</select>
			</td>
			<td>
				<input type="submit" name="btnsave" value="Save" class="btn btn-skin btn-block btn-lg">
				</td>
			</tr>
	</table>
	</fieldset>
</form>
    </section>
<?php 
	include('footer.php');
?>
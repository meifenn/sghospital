<?php
include('connect.php');		
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
				<li class="active"><a href="finddoctor.php">Find Doctor?</a></li>
				<li><a href="treatmenttemplate.php">Treatment Record</a></li>
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
									<h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>Find Doctor List</h3>
									</div>
									<div class="panel-body">
									<form action="finddoctor.php" method="POST">
										<div class="row">
											<div class="col-xs-6 col-sm-6 col-md-6">
												<div class="form-group">
													<label>Search Doctor</label>
													<input type="text" name="txtSearch" placeholder="Find Doctor" class="form-control input-md"/>
												</div>
											</div>
										</div>
										<input type="submit" name="btnSearch" value="Search" class="btn btn-skin btn-sm-6 btn-lg">
										 <input type="submit" value="Show All" name="btnShowAll" class="btn btn-skin btn-sm-6 btn-lg">
										</div>
								</div>
						</div>				
						
					</div>
					</div>
				</div>					
			</div>		
		</div>
	</div>
	<?php 
if (isset($_POST['btnSearch']))
				{
					$docname=$_POST['txtSearch'];
					$query="SELECT * FROM docregister 
							WHERE DoctorName LIKE '%$docname%'";
					$result=mysqli_query($connection,$query);
					$count=mysqli_num_rows($result);
					if ($count>0)
					{
						echo "<table class='docregister' align='center'
							border='3px'>";
						for ($i=0; $i < $count; $i+=1)
						{ 
					$query1="SELECT * FROM docregister 
							WHERE DoctorName LIKE '%$docname%'
							LIMIT $i,1";
							$result1=mysqli_query($connection,$query1);
							$count1=mysqli_num_rows($result1);
							echo "<tr>";
							for ($j=0; $j < $count1; $j++)
							{ 
								$arr=mysqli_fetch_array($result1);
								echo "<td>";
								echo "<a href='Appointment.php?DoctorID=".$arr['DoctorID']."'>";
								echo "<br>";
								echo "<img src='".$arr['Image']."' width='200px'>";
								echo "<br>";
								echo "<b>".$arr['DoctorName']."</b>";
								echo "<br>";
								echo "<b>".$arr['Specialities']."</b>";
								echo "<br>";
								echo "</td>";
							}
							echo "</tr>";
						}
						echo "</table>";
					}

					else
 				{
 					echo "<h1><b><u>Doctor Name that Entered Is Not Found</u></b></h1>";
 				}
 			}
					else
				{	$query="SELECT * FROM docregister 
					ORDER BY DoctorName";
					$result=mysqli_query($connection,$query);
					$count=mysqli_num_rows($result);

					if ($count>0)
					{
						echo "<table class='docregister' align='center'
						border='2px'>";
						for ($i=0; $i < $count; $i+=5)
						{ 
					$query1="SELECT * FROM docregister 
							ORDER BY DoctorName
							LIMIT $i,5";
							$result1=mysqli_query($connection,$query1);
							$count1=mysqli_num_rows($result1);
							echo "<tr>";
							for ($j=0; $j < $count1; $j++)
							{ 
								$arr=mysqli_fetch_array($result1);
								echo "<td>";
								echo "<a href='Appointment.php?DoctorID=".$arr['DoctorID']."'>";
								echo "<br>";
								echo "<img src='".$arr['Image']."' width='200px' '>";
								echo "<br>";
								echo "<b>".$arr['DoctorName']."</b>";
								echo "<br>";
								echo "<b>".$arr['Specialities']."</b>";
								echo "<br>";
								echo "</td>";
					}
					echo "</tr>";
				}
				echo "</table>";
			}
		}
	 ?>
    </section>
<?php 
	include('footer.php');
?>
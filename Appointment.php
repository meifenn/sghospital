<?php 
session_start();
include('connect.php');
if (isset($_REQUEST['DoctorID']))
{
	$doctorID=$_REQUEST['DoctorID'];
	$query="SELECT * 
    FROM docregister d,schedetail sd, docschedule s, room r
    WHERE s.ScheduleID=sd.ScheduleID
    AND d.DoctorID=sd.DoctorID
    AND d.DoctorID='$doctorID'";
    $ret=mysqli_query($connection,$query);
    $arr=mysqli_fetch_array($ret);
    $docname=$arr['DoctorName'];
    $specitalities=$arr['Specialities'];
    $roomtype=$arr['RoomType'];
    $dutydate=$arr['DutyDate'];
    $dutytime=$arr['DutyTime'];
    $image=$arr['Image'];
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
                                    <h3 class="panel-title"><span class="fa fa-pencil-square-o"></span>About Dr. <?php echo $docname ?></h3>
                                    </div>
                                    <div class="panel-body">
                                    <form action="AppointmentListtemplate.php" method="GET">
                                    <input type="hidden" name="doctorID" value="<?php echo $doctorID ?>"/>
                                    <input type="hidden" name="action" value="appointment" />
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <img src="<?php echo $image?>" border width="200px" height="200px" id="ImgPhoto"/><br/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Doctor Name</label>
                                                    <input type="text" name="txtdocname" value="<?php echo $docname?>" class="form-control input-md" />
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Specialities</label>
                                                    <input type="text" name="txtspecialities" value="<?php echo $specitalities?>" class="form-control input-md"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Room Number</label>
                                                    <input type="text" name="txtroomnumber" value="<?php echo $roomtype?>" class="form-control input-md"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Duty Date</label>
                                                    <input type="text" name="txtdutydate" value="<?php echo $dutydate?>" class="form-control input-md"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <label>Duty Time</label>
                                                    <input type="text" name="txtdutytime" value="<?php echo $dutytime?>" class="form-control input-md"/>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" name="btnappointment" value="Make Appointment Now?" class="btn btn-skin btn-sm-12 btn-lg">
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
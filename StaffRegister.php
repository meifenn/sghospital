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
	echo"<script>window.location='StaffRegister.php'</script>";
	exit();
}

$insert= "INSERT INTO staff (StaffName, SPhone, Gender,Position, Email, Password, Address)
	VALUES 
('$txtstaffname','$txtphone','$rdogender','$txtposition','$txtemail','$txtpassword','$txtaddress')";

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
<!DOCTYPE html>
<html>
<head>
	<title>Staff Registration</title>
</head>
<body>
<form action="StaffRegister.php" method="post">
	<fieldset>
	<legend>Staff Registration Form</legend>
	<table>
		<tr>
			<td>Staff Name:  </td>
			<td>
				<input type="text" name="txtstaffname" placeholder="Enter Your Full Name" required/>
			</td>
		</tr>
		<tr>
			<td>PhoneNumber:  </td>
			<td>
				<input type="text" name="txtphone" placeholder="09*********" required/>
			</td>
		</tr>
		<tr>
			<td>Gender:  </td>
			<td>
				<input type="radio" name="rdogender" value="Male">Male <br>
				<input type="radio" name="rdogender" value="Female">Female <br>
			</td>
		</tr>
		<tr>
			<td>Position:  </td>
			<td>
				<input type="text" name="txtposition" placeholder="nurse" required/>
			</td>
		</tr>
		<tr>
			<td>Email:  </td>
			<td>
				<input type="email" name="txtemail" placeholder="****@gmail.com" required/>
			</td>
		</tr>
		<tr>
			<td>Password:  </td>
			<td>
				<input type="Password" name="txtpassword" placeholder="********" required/>
			</td>
		</tr>
		<tr>
			<td>Address:  </td>
			<td>
				<textarea name="txtaddress"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="btnsave" value="Save">
				<input type="reset" name="btnclear" value="Clear">
			</td>
		</tr>
	</table>	
</fieldset>
</form>
</body>
</html>
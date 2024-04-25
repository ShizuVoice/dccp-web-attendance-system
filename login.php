<?php
session_start();
if(isset($_POST['btnlogin']))
{
	include_once("config.php");
	$count=0;
	$uname=$_REQUEST['uname'];
	$pass=$_REQUEST['pass'];
	$encrypted_pass=SHA1($pass);

	$sql="SELECT * FROM teacher_data WHERE tid = '$uname' AND pin_code = '$encrypted_pass'";

	$rs=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($rs);

	if($count==1)
	{
		//$count=$count+1
		$res=mysqli_fetch_array($rs);
		$_SESSION["tid"]=$res['tid'];
		$_SESSION["USNAME"]=$res['first_name']." ".$res['last_name'];
		// $user_type=$res['user_type'];
		// if(strcmp($user_type,"admin")==0)
		// {
			header("Location: profile.php");
		// }
		// else{
		// 	header("Location: home.php");
		// }
	}
	else {
		echo '<script> alert($encrypted_pass); </script>';
	}
}

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="mycss.css">
	<script src="myjs.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<title>LogIn Form</title>
</head>
<body>
	<div class="container mt-3" style="width: 30%;">
		<div class="card">
			<div class="card-header">
				<h4 align="center">Data Center College of the Philippines of Laoag City, Inc.</h4>
			</div>
			<div class="card-body">
				<center><img class="w-50"  src="DCCPLOGO3.png"/> </center>
				
				
				<form class="container" method="post" action="login.php">
					<div class="form-group">
						<label for="usr">ID Number:</label>
						<input type="text" class="form-control" name="uname">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" name="pass">
					</div>

					<div class="form-group mt-3">
						<td align="center" colspan="2"><input class="btn btn-success w-100"  type="submit" name="btnlogin" value="Sign In" /></td>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
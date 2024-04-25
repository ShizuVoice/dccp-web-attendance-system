<?php
session_start();

// if(!isset($_SESSION['tid']))
// {
// 	header("Location:login.php");
// }

$tid = $_SESSION['tid'];

$uname = $_SESSION['USNAME'];

$sql = "";
$ln = "dsadas";
$fn = $tid;
$mn = "";
$pos = "";
include ("config.php");
$sql = "select * from  teacher_data where  tid='$tid'";
$result = mysqli_query($conn, $sql);
if ($result) {
	while ($row = mysqli_fetch_array($result)) {
		$ln = $row['last_name'];
		$fn = $row['first_name'];
		$mn = $row['middle_name'];
		$pos = $row['position_code'];
	}
}

$sql = "SELECT mon_am_in, mon_am_out, mon_pm_in, mon_pm_out, 
               tue_am_in, tue_am_out, tue_pm_in, tue_pm_out, 
               wed_am_in, wed_am_out, wed_pm_in, wed_pm_out, 
               thu_am_in, thu_am_out, thu_pm_in, thu_pm_out, 
               fri_am_in, fri_am_out, fri_pm_in, fri_pm_out, 
               sat_am_in, sat_am_out, sat_pm_in, sat_pm_out 
        FROM teacher_time_data 
        WHERE tid = $tid";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$mon_am_in = $row["mon_am_in"];
	$mon_am_out = $row["mon_am_out"];
	$mon_pm_in = $row["mon_pm_in"];
	$mon_pm_out = $row["mon_pm_out"];
	$tue_am_in = $row["tue_am_in"];
	$tue_am_out = $row["tue_am_out"];
	$tue_pm_in = $row["tue_pm_in"];
	$tue_pm_out = $row["tue_pm_out"];
	$wed_am_in = $row["wed_am_in"];
	$wed_am_out = $row["wed_am_out"];
	$wed_pm_in = $row["wed_pm_in"];
	$wed_pm_out = $row["wed_pm_out"];
	$thu_am_in = $row["thu_am_in"];
	$thu_am_out = $row["thu_am_out"];
	$thu_pm_in = $row["thu_pm_in"];
	$thu_pm_out = $row["thu_pm_out"];
	$fri_am_in = $row["fri_am_in"];
	$fri_am_out = $row["fri_am_out"];
	$fri_pm_in = $row["fri_pm_in"];
	$fri_pm_out = $row["fri_pm_out"];
	$sat_am_in = $row["sat_am_in"];
	$sat_am_out = $row["sat_am_out"];
	$sat_pm_in = $row["sat_pm_in"];
	$sat_pm_out = $row["sat_pm_out"];
} else {
	echo "No scheduled time data found for tid $tid";
}

$sql = "SELECT teacher_can_edit FROM system_settings WHERE id = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$teacher_can_edit = $row['teacher_can_edit'];

?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="mycss.css">
	<link rel="icon" type="image/x-icon" href="DCCPLOGO3.png">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="myjs.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
		integrity="sha384-oBqDVmMz4fnFO9gybB5IXNxFwWQfE7u8Lj+XJHAxKlXiG/8rsrtpb6PEdzD828Ii"
		crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<title>Profile</title>
</head>

<body>
	<div class="sidebar" align="center">
		<center><img src="DCCPLOGO3.png" /> </center>
		<h5> WELCOME: <?php echo $uname; ?></h5>
		<hr />
		<a href="profile.php">PROFILE</a>
		<a href="attendance.php">ATTENDANCE</a>
		<a href="logout.php" class="mt-5">LOGOUT</a>
		<div class="version" align="center">
			<p>Web version 2024.4.21</p>
		</div>
	</div>

	<div class="container" style="width:80%; margin-left: 20%;">
		<div class="card mt-2" style="float:left; width:33%;height:520px">
			<div class="card-header">
				<h2>Employee Profile</h2>
			</div>
			<div class="card-body">
				<form class="container" method="post" action="update_time.php" id="scheduleForm">
					<div class="form-group">
						<label for="usr">ID:</label>
						<input value="<?php echo $tid ?>" type="text" class="form-control" id="usr" readonly>
					</div>
					<div class="form-group">
						<label for="usr">Last Name:</label>
						<input value="<?php echo $ln ?>" type="text" class="form-control" id="usr" readonly>
					</div>
					<div class="form-group">
						<label for="usr">First Name:</label>
						<input value="<?php echo $fn ?>" type="text" class="form-control" id="usr" readonly>
					</div>
					<div class="form-group">
						<label for="usr">Middle Name:</label>
						<input value="<?php echo $mn ?>" type="text" class="form-control" id="usr" readonly>
					</div>
					<div class="form-group">
						<label for="usr">Position Code:</label>
						<input value="<?php echo $pos ?>" type="text" class="form-control" id="usr" readonly>
					</div>
					<div class="form-group mt-4">
				<!-- <input class="btn btn-success w-100" type="submit" name="btnlogin" value="Update" /> -->
				<button type="button" class="btn btn-primary w-100">
					Request Details Update
				</button>
			</div>
			</div>

		</div>
	
		<div class="card me-1 mt-2" style="float:right; width:64%;height:520px">
			<div class="card-header">
				<h2>Schedule Time</h2>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Day</th>
								<th>AM In</th>
								<th>AM Out</th>
								<th>PM In</th>
								<th>PM Out</th>
							</tr>
						</thead>
								<tbody>
									<tr>
										<td>Monday</td>
										<td><input type="text" name="MonAMIn" value="<?php echo $mon_am_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="MonAMOut" value="<?php echo $mon_am_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="MonPMIn" value="<?php echo $mon_pm_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="MonPMOut" value="<?php echo $mon_pm_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
							</tr>
							<tr>
								<td>Tuesday</td>
								<td><input type="text" name="TueAMIn" value="<?php echo $tue_am_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="TueAMOut" value="<?php echo $tue_am_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="TuePMIn" value="<?php echo $tue_pm_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="TuePMOut" value="<?php echo $tue_pm_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
							</tr>
							<tr>
								<td>Wednesday</td>
								<td><input type="text" name="WedAMIn" value="<?php echo $wed_am_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="WedAMOut" value="<?php echo $wed_am_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="WedPMIn" value="<?php echo $wed_pm_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="WedPMOut" value="<?php echo $wed_pm_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
							</tr>
							<tr>
								<td>Thursday</td>
								<td><input type="text" name="ThuAMIn" value="<?php echo $thu_am_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="ThuAMOut" value="<?php echo $thu_am_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="ThuPMIn" value="<?php echo $thu_pm_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="ThuPMOut" value="<?php echo $thu_pm_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
							</tr>
							<tr>
								<td>Friday</td>
								<td><input type="text" name="FriAMIn" value="<?php echo $fri_am_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="FriAMOut" value="<?php echo $fri_am_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="FriPMIn" value="<?php echo $fri_pm_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="FriPMOut" value="<?php echo $fri_pm_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
							</tr>
							<tr>
								<td>Saturday</td>
								<td><input type="text" name="SatAMIn" value="<?php echo $sat_am_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="SatAMOut" value="<?php echo $sat_am_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="SatPMIn" value="<?php echo $sat_pm_in ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
								<td><input type="text" name="SatPMOut" value="<?php echo $sat_pm_out ?>"
										style="width: 120px; text-align: center;" <?php if ($teacher_can_edit == 0)
											echo 'readonly'; ?>></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	
			<!-- Modal -->
			<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="confirmModalLabel">Confirm Your Data</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							Please ensure that your data is correct before updating. Do you want to save
							changes?
							All
							previous data will be overwritten.
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
							<button type="button" class="btn btn-primary" id="confirmBtn">Yes</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Success/Fail Modal -->
			<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="resultModalLabel">Result</h5>
							<!--
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												-->
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
	
							</button>
	
						</div>
						<div class="modal-body" id="resultModalBody">
							<!-- Message will be inserted here -->
						</div>
						<div class="modal-footer">
							<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group p-2">
				<!-- <input class="btn btn-success w-100" type="submit" name="btnlogin" value="Update" /> -->
				<button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#confirmModal"
					<?php if ($teacher_can_edit == 0)
						echo 'disabled="disabled"'; ?>>
					Request Time Update
				</button>
			</div>
			</form>
		</div>
	</div>
</div>
		<script src="updateJS.js"></script>
</body>

</html>
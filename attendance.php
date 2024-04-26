<?php 
session_start();
if(!isset($_SESSION['tid']))
{
	header("Location:login.php");
}
$tid=$_SESSION['tid'];

$uname=$_SESSION['USNAME'];
if($_SESSION['tid']==null)
{
	header("Location:logout.php");
}
include("config.php"); 

// Get the year and month from the URL parameters or set to the current year and month if not present
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$month = isset($_GET['month']) ? $_GET['month'] : date('n');

// Get the filter option parameter from the GET request
$filterOption = isset($_GET['filter-option']) ? $_GET['filter-option'] : 'this-month';

// Set the selected radio button based on the filter option parameter
if ($filterOption === 'specific-month') {
  $specificMonthChecked = 'checked';
  $thisMonthChecked = '';
} else {
  $specificMonthChecked = '';
  $thisMonthChecked = 'checked';
}

// Modify the SQL query based on the selected year and month
$sql = "SELECT * from attendance_log, teacher_data WHERE teacher_data.tid = attendance_log.tid AND teacher_data.tid='$tid' AND YEAR(attendance_log.date) = '$year' AND MONTH(attendance_log.date) = '$month' ORDER BY attendance_log.date DESC";

$result=mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="mycss.css">
	<link rel="icon" type="image/x-icon" href="DCCPLOGO3.png">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="myjs.js"></script>
	<script src="attendanceJS.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<title>Attendance</title>
</head>
<body>
	<div class="sidebar" align="center">
	
		<center><img  src="DCCPLOGO3.png"/> </center>
		<h5> WELCOME: <?php echo strtoupper($uname); ?></h5>
		<hr/>
		<a href="profile.php">PROFILE</a>
		<a href="attendance.php">ATTENDANCE</a>
		<a href="logout.php" class="mt-5">LOGOUT</a>
		<div class="version" align="center">
			<p>Web version 2024.4.21</p>
		</div>
	</div>
	<div class="container pt-2" style="margin-left: 21%; width:78%">
		<div class="card">
			<div class="card-header"><h2>ATTENDANCE</h2> </div>
			<div class="card-body">
  		<div class="filter-panel" style="width:35%">
  		  <form>
  		    <label>Filter by:</label>
  		    <div class="form-check">
  		      <input class="form-check-input" type="radio" name="filter" id="this-month" <?php echo $thisMonthChecked;?>>
  		      <label class="form-check-label" for="this-month">This Month</label>
  		    </div>
  		    <div class="form-check">
  		      <input class="form-check-input" type="radio" name="filter" id="specific-month" <?php echo $specificMonthChecked;?>>
  		      <label class="form-check-label" for="specific-month">Specific Date</label>
  		      <div class="specific-month-filter">
  		        <select class="form-select" id="month">
  		          <option value="">Select Month</option>
  		          <option value="1">January</option>
  		          <option value="2">February</option>
			      <option value="3">March</option>
  		          <option value="4">April</option>
				  <option value="5">May</option>
  		          <option value="6">June</option>
				  <option value="7">July</option>
  		          <option value="8">August</option>
				  <option value="9">September</option>
  		          <option value="10">October</option>
				  <option value="11">November</option>
  		          <option value="12">December</option>
  		          <!-- add more options for each month -->
  		        </select>
				
  		        <select class="form-select" id="year">
					<option value="">Select Year</option>
					<?php
						$current_year = date('Y');
						for ($i = $current_year; $i >= 1970; $i--) {
				 		echo "<option value='$i'>$i</option>";
						}
					?>
				</select>
  		      </div>
  		    </div>
			<input type="hidden" id="filter-option" name="filterOption" value="<?php echo $filterOption; ?>">
  		  </form>
  		</div>
		<table class="table  table-striped table-hover">
			<thead>
				<tr class=" border border-1 text-dark">
					<th scope="col">ID #</th>
					<th scope="col">Full Name</th>
					<th scope="col">Date</th>
					<th scope="col">IN AM</th>
					<th scope="col">OUT AM</th>
					<th scope="col">IN PM</th>
					<th scope="col">OUT PM</th>
				</tr>
			</thead>
			<tbody class="table-group-divider">
				<?php
				if($result){
					while($row=mysqli_fetch_array($result)){
						$aid=$row['aid'];
						echo "<tr><td>". $row['tid']."</td>";
						echo "<td>". $row['last_name']. ', '. $row['first_name']. ' '. $row['middle_name']."</td>";
						echo "<td>". $row['date']."</td>"; 
						echo "<td>". $row['am_in']."</td>"; 
						echo "<td>". $row['am_out']."</td>"; 
						echo "<td>". $row['pm_in']."</td>"; 
						echo "<td>". $row['pm_out']."</td></tr>";
						}
					}
				?>
			</tbody>
		</table>
			</div>
	</div>
</body>
</html>
<?php

session_start();
include("config.php");

// Get the updated schedule time from the AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tid = $_SESSION['tid'];
  $mon_am_in = $_POST['MonAMIn'];
  $mon_am_out = $_POST['MonAMOut'];
  $mon_pm_in = $_POST['MonPMIn'];
  $mon_pm_out = $_POST['MonPMOut'];
  $tue_am_in = $_POST['TueAMIn'];
  $tue_am_out = $_POST['TueAMOut'];
  $tue_pm_in = $_POST['TuePMIn'];
  $tue_pm_out = $_POST['TuePMOut'];
  $wed_am_in = $_POST['WedAMIn'];
  $wed_am_out = $_POST['WedAMOut'];
  $wed_pm_in = $_POST['WedPMIn'];
  $wed_pm_out = $_POST['WedPMOut'];
  $thu_am_in = $_POST['ThuAMIn'];
  $thu_am_out = $_POST['ThuAMOut'];
  $thu_pm_in = $_POST['ThuPMIn'];
  $thu_pm_out = $_POST['ThuPMOut'];
  $fri_am_in = $_POST['FriAMIn'];
  $fri_am_out = $_POST['FriAMOut'];
  $fri_pm_in = $_POST['FriPMIn'];
  $fri_pm_out = $_POST['FriPMOut'];
  $sat_am_in = $_POST['SatAMIn'];
  $sat_am_out = $_POST['SatAMOut'];
  $sat_pm_in = $_POST['SatPMIn'];
  $sat_pm_out = $_POST['SatPMOut'];
}
// Add more variables for the other days of the week

// Connect to the database
//$conn = mysqli_connect($conn, $sql);

$sql = "SELECT tid FROM teacher_time_buffer WHERE tid = '$tid'";
$rs = mysqli_query($conn, $sql);

if ($rs) {
	$sql = "DELETE FROM teacher_time_buffer WHERE tid = '$tid'";
  $rs = mysqli_query($conn, $sql);
}

// Insert the updated schedule time into the `teacher_time_buffer` table
$sql = "INSERT INTO teacher_time_buffer (tid, mon_am_in, mon_am_out, mon_pm_in, mon_pm_out,
        tue_am_in, tue_am_out, tue_pm_in, tue_pm_out, wed_am_in, wed_am_out, wed_pm_in, wed_pm_out,
        thu_am_in, thu_am_out, thu_pm_in, thu_pm_out, fri_am_in, fri_am_out, fri_pm_in, fri_pm_out,
        sat_am_in, sat_am_out, sat_pm_in, sat_pm_out) 
        VALUES ('$tid', '$mon_am_in', '$mon_am_out', '$mon_pm_in', '$mon_pm_out',
        '$tue_am_in', '$tue_am_out', '$tue_pm_in', '$tue_pm_out',
        '$wed_am_in', '$wed_am_out', '$wed_pm_in', '$wed_pm_out',
        '$thu_am_in', '$thu_am_out', '$thu_pm_in', '$thu_pm_out',
        '$fri_am_in', '$fri_am_out', '$fri_pm_in', '$fri_pm_out',
        '$sat_am_in', '$sat_am_out', '$sat_pm_in', '$sat_pm_out')";

$rs = mysqli_query($conn, $sql);

// Check if the SQL query was successful
if ($rs) {
  echo 'success';
} else {
  echo 'error';
}
// Close the database connection
mysqli_close($conn);

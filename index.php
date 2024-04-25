<?php
session_start();
if(!isset($_SESSION['UID']))
{
	header("Location:login.php");
}
$sql="";
include_once("config.php");

if(isset($_POST['btnsearch'])){
	$txtsearch=$_REQUEST['txtsearch'];
	$sql="Select * from employee_information where lname LIKE '%$txtsearch%'";
	$rs=mysqli_query($mysqli,$sql);
}
else{
	$sql="Select * from employee_information LIMIT 25";
	$rs=mysqli_query($mysqli,$sql);
}

?>
<html>
<head><title> Employee Information </title></head>
<body>

	<table border="1" width="80%" align="center">
		<form method="post" action="index.php">
			<tr>
				<td colspan="5"></td>
				<td align="center">
					<input type="text" name="txtsearch" placeholder="search....." />
				</td>
				<td><input type="submit" name="btnsearch" value="Search"></td>
			</tr>
		</form>
		<tr>
			<td> Employee ID </td>
			<td> Last Name </td>
			<td> First Name </td>
			<td> Middle Name </td>
			<td> Address </td>
			<td> Contact </td>
			<td colspan="2"> Actions </td>
		</tr>
		<?php
		while ($res=mysqli_fetch_array($rs)){
			echo "<tr><td>".$res["EID"]."</td>";
			echo "<td>".$res["lname"]."</td>";
			echo "<td>".$res["fname"]."</td>";
			echo "<td>".$res["mname"]."</td>";
			echo "<td>".$res["address"]."</td>";
			echo "<td>".$res["contact"]."</td>";
			echo "<td><a href='edit_employee.php?eid=$res[EID]'>EDIT</a></td>";
			echo "<td><a href='del_employee.php?eid=$res[EID]'>DELETE</a></td></tr>";
		}
		?>
	</table>

	<br>
	<center>
		<a href="logout.php">Logout</a>
	</center>

</body>
</html
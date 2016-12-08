<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php

require_once("FirePHPCore/FirePHP.class.php");
ob_start();
$firephp = FirePHP::getInstance(true);

ini_set('display_errors', 'On');

	$u1 = $_GET['u1'];
	$u2 = $_GET['u2'];

  $serverName = "cs336collegecosts.cvv8avsmuk3o.us-east-1.rds.amazonaws.com:3306";
  $userName = "aminmcdonough";
  $password = "databases336";
  $dbName = "InternationalCollegeCosts";

  //create connection
  $conn1 = new mysqli($serverName, $userName, $password);

  // check connection

  if(!$conn1){
    die("Connection failed: " . myslqi_error($conn1));
  }

  $sql1 = "SELECT * FROM InternationalCollegeCosts.Universities WHERE university_name = \"". $u1 ."\"";

  $result1 = mysqli_query($conn1, $sql1);

  $firephp->log($result1, "result1");
echo "<table>
<tr>
<th>University</th>
<th>World Rank</th>
<th>Student Enrolled</th>
<th>% International Students</th>
<th>Tuition Cost</th>
</tr>";


  while($row1 = mysqli_fetch_array($result1)){
    echo "<tr>";
    echo "<td>" . $row1['university_name'] . "</td>";
    echo "<td>" . $row1['world_rank'] . "</td>";
    echo "<td>" . $row1['num_students'] . "</td>";
    echo "<td>" . $row1['international_students'] . "</td>";
    echo "<td>" . $row1['Tuition'] . "</td>";
    echo "</tr>";
  }
//  echo "</table>";

  $sql2 = "SELECT * FROM InternationalCollegeCosts.Universities WHERE university_name = \"". $u2 ."\"";
  $result2 = mysqli_query($conn1, $sql2);

/*
echo "<table>
<tr>
<th>University 2</th>
<th>World Rank</th>
<th>Student Enrolled</th>
<th>% International Students</th>
<th>Tuition Cost</th>
</tr>";
*/

  while($row2 = mysqli_fetch_array($result2)){
    echo "<tr>";
    echo "<td>" . $row2['university_name'] . "</td>";
    echo "<td>" . $row2['world_rank'] . "</td>";
    echo "<td>" . $row2['num_students'] . "</td>";
    echo "<td>" . $row2['international_students'] . "</td>";
    echo "<td>" . $row2['Tuition'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
 mysqli_close($conn1);
?>

</body>
</html>

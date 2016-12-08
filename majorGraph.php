<?php
	require_once("FirePHPCore/FirePHP.class.php");
	ob_start();
	$firephp = FirePHP::getInstance(true);

	ini_set('display_errors', 'On');

	$major1 = $_GET['m1'];
	$major2 = $_GET['m2'];

	$firephp->log($major1, "major1");

	$serverName = "cs336collegecosts.cvv8avsmuk3o.us-east-1.rds.amazonaws.com:3306";
    $userName = "aminmcdonough";
    $password = "databases336";

    $conn1 = new mysqli($serverName, $userName, $password);

    if(!$conn1){
    	die("Connection failed: " . mysqli_error($conn1));
    }

    $sql1 = "SELECT NewGrad, Median FROM InternationalCollegeCosts.MajorSalary
		WHERE Major=\"".$major1."\"";

	$result1 = mysqli_query($conn1, $sql1);
    $row1 = mysqli_fetch_array($result1);

    $sql2 = "SELECT NewGrad, Median FROM InternationalCollegeCosts.MajorSalary
		WHERE Major=\"".$major2."\"";

	$result2 = mysqli_query($conn1, $sql2);
    $row2 = mysqli_fetch_array($result2);

    echo $row1[0]. " " .$row1[1]. " " .$row2[0]. " " .$row2[1];

    mysqli_close($conn1);
?>
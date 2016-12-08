<?php
	require_once("FirePHPCore/FirePHP.class.php");
	ob_start();
	$firephp = FirePHP::getInstance(true);

	ini_set('display_errors', 'On');

	$concentration = $_GET['c'];

	$serverName = "cs336collegecosts.cvv8avsmuk3o.us-east-1.rds.amazonaws.com:3306";
    $userName = "aminmcdonough";
    $password = "databases336";

    $conn1 = new mysqli($serverName, $userName, $password);

    if(!$conn1){
    	die("Connection failed: " . mysqli_error($conn1));
    }

    $sql = "SELECT round(avg(NewGrad)), round(avg(Median)), round(min(NewGrad)), round(min(Median)), round(max(NewGrad)), round(max(Median)) FROM InternationalCollegeCosts.MajorSalary WHERE subject= \"". $concentration ."\" GROUP BY subject";
    $firephp->log($sql, "sql");

    $result1 = mysqli_query($conn1, $sql);
    $row = mysqli_fetch_array($result1);
    $firephp->log($row, "row");
    $firephp->log($row[0], "ngAvg");

    echo $row[4]. " ". $row[5] ." ". $row[2] . " " .$row[3]. " ". $row[0]. " ". $row[1];

    mysqli_close($conn1);
?>
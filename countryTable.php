<?php
	require_once("FirePHPCore/FirePHP.class.php");
	ob_start();
	$firephp = FirePHP::getInstance(true);

	ini_set('display_errors', 'On');

	$country = $_GET['c'];
	$firephp->log($country, "country");

	$serverName = "cs336collegecosts.cvv8avsmuk3o.us-east-1.rds.amazonaws.com:3306";
    $userName = "aminmcdonough";
    $password = "databases336";

    $conn1 = new mysqli($serverName, $userName, $password);

    if(!$conn1){
    	die("Connection failed: " . mysqli_error($conn1));
    }

    $sql = "SELECT Value, CollegeCost FROM InternationalCollegeCosts.Countries WHERE Location = \"" . $country ."\"";
    $firephp->log($sql, "query");

    $result1 = mysqli_query($conn1, $sql);
    $row = mysqli_fetch_array($result1);

	echo $row['Value'] . " " . $row['CollegeCost'];

	mysqli_close($conn1);
?>
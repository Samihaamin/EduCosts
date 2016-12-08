<?php
	
	$serverName = "cs336collegecosts.cvv8avsmuk3o.us-east-1.rds.amazonaws.com:3306";
	$userName = "aminmcdonough";
	$password = "databases336";

	//create connection
	$conn = new mysqli($serverName, $userName, $password);

	// check connection

	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	echo "Connected successfully";

	$sql = "SELECT Location FROM InternationalCollegeCosts.Countries";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
		echo "<table><tr><th>Country</th></tr>";
		while($row = $result->fetch_assoc()){
			echo "<tr><td>". $row["Location"];
		}
		echo "</table>";
	} else {
		echo "0 results";
	}
	$conn->close();
?>

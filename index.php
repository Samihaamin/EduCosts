<!DOCTYPE html>

<?php
  require_once("FirePHPCore/FirePHP.class.php");
  ob_start();
  $firephp = FirePHP::getInstance(true);

  $serverName = "cs336collegecosts.cvv8avsmuk3o.us-east-1.rds.amazonaws.com:3306";
  $userName = "aminmcdonough";
  $password = "databases336";

  //create connection
  $conn = new mysqli($serverName, $userName, $password);

  //$firephp->log($conn, 'connection');
  // check connection

  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }
?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link rel = "icon" href="http://educosts.com/favicon.ico" type = "image/png"/>
<link href="tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tabcontent.js" type="text/javascript"></script>
<script src="plotly-latest.min.js"></script>

</head>
<body>
	
	
 <div id="info">
     <center><img src="logo.png" style="width:128px;height:26px;"></center>
     <br>

	<ul class="tabs" style="display: inline-block;">
	    <li><a href="#view1">Insight</a></li>
    <li><a href="#view2">Compare Majors</a></li>
    <li><a href="#view4">Compare Universities</a></li>
    <li><a href="#view5">About</a></li>
	</ul>

<script type = "text/javascript">
	
	

function countryGraph(avgWage = 0, avgCost = 0, country = "Country"){

  var trace1 = {
    x: ['Avg Wage ', 'Avg College Cost'],
    y: [avgWage, avgCost],
    name: country,
    type: 'bar'
  };

  var trace2 = {
    x: ['Avg Wage ', 'Avg College Cost'],
    y: [56701, 27923.7],
    name: 'USA',
    type: 'bar'
  };

  var data = [trace1, trace2];

  var layout = {barmode: 'group',
                title: 'Economic Comparison vs USA'};

  Plotly.newPlot('myDivx2', data, layout);
}
	
	

function concentrationGraph(ngMax = 0, mMax = 0, ngMin = 0, mMin = 0, ngAvg = 0, mAvg = 0){
  var trace3 = {
  y: [ngAvg, mAvg], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: 'Average',
    line: {
    dash: 'solid',
    width: 3
  }
};
var trace4 = {
  y: [ngMax, mMax], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: 'Max',
    line: {
    dash: 'dot',
    width: 1
  }
};
var trace5 = {
  y: [ngMin, mMin], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: 'Min',
    line: {
    dash: 'dot',
    width: 1
  }
};
var data = [trace3, trace4, trace5];

var layout = {title: 'Salary Statistics per Subject Area'};

Plotly.newPlot('myDiv', data, layout);
}

	
	

function majorGraph(ngM1 = 0, mM1 = 0, ngM2 = 0, mM2 = 0, m1 = "Major 1", m2 = "Major 2"){
    var trace1 = {
  y: [ngM1, mM1], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: m1,
    line: {
    dash: 'solid',
    width: 3
  }
};
var trace2 = {
  y: [ngM2, mM2], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: m2,
    line: {
    dash: 'solid',
    width: 3
  }
};
var trace3 = {
  y: [49303, 83756], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: 'Average Salary',
    line: {
    dash: 'dot',
    width: 3
  }
};
var trace4 = {
  y: [96700, 172000], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: 'Max (Petroleum Engineering)',
    line: {
    dash: 'dot',
    width: 1
  }
};
var trace5 = {
  y: [37800, 60300], 
  x: ['New Grad Salary', 'Mean Salary'], 
  mode: 'lines',
  name: 'Min (Kinesiology)',
    line: {
    dash: 'dot',
    width: 1
  }
};
var data = [trace1, trace2, trace3, trace4, trace5];
Plotly.newPlot('myDivx', data);
}

	
	
function showInsight(){

  var counList = document.getElementById("insightCountry");
  var country = counList.options[counList.selectedIndex].value;
  var conList = document.getElementById("insightConcentration");
  var concentration = conList.options[conList.selectedIndex].value;

  if(country.length != 0){
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var countryValues = this.responseText.split(" ");
          var avgWage = countryValues[0];
          var avgCost = countryValues[1];
          countryGraph(avgWage, avgCost, country);
        }
      };
      xmlhttp.open("GET", "countryTable.php?c=" + encodeURIComponent(country), true);
      xmlhttp.send();
  }

  if(concentration.length != 0){
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        var cValues = this.responseText.split(" ");
        concentrationGraph(cValues[0],cValues[1],cValues[2],cValues[3],cValues[4],cValues[5]);
      }
    };
    xmlhttp.open("GET", "concentrationGraph.php?c=" + encodeURIComponent(concentration), true);
    xmlhttp.send();
  }
}

	
	
function showGraph(){

  var m1List = document.getElementById("Major 1");
  var major1 = m1List.options[m1List.selectedIndex].value;
  var m2List = document.getElementById("Major 2");
  var major2 = m2List.options[m2List.selectedIndex].value; 

  if(major1.length == 0 || major2.length == 0){
    return;
  }
  if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }else{
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var majorValues = this.responseText.split(" ");
      majorGraph(majorValues[0],majorValues[1],majorValues[2],majorValues[3], major1, major2);
    }
  };
  xmlhttp.open("GET", "majorGraph.php?m1=" + encodeURIComponent(major1) + "&m2=" + encodeURIComponent(major2) , true);
  xmlhttp.send();
}
</script>


	 
	 
	 
	 

<div class="tabcontents">
<div id="view1">

<div>
<form name = "insight" action="JavaScript:showInsight()" method="get">
Get Insight:
	
    <select id="insightCountry">
          <option value="">Pick Country..</option>
    <?php
      $sql = mysqli_query($conn, "SELECT Location FROM InternationalCollegeCosts.Countries ORDER BY Location");
      while($row = $sql->fetch_assoc()){
        echo "<option value = \"".$row['Location']."\">" . $row['Location'] . "</option>";
      }
    ?>
	    
  </select>
      <select id="insightConcentration">
            <option value="">Pick Concentration..</option>
    <option value ="Business">Business</option>
    <option value ="Engineering">Engineering</option>
    <option value ="Fine Arts">Fine Arts</option>
    <option value ="Health Professions">Health</option>
    <option value ="Humanities">Humanities</option>
    <option value ="Math/CS">Math/CS</option>
    <option value ="Physical/Life Sciences">Life Sciences</option>
    <option value ="Social Sciences">Social Sciences</option>
  </select>
	
  <input type="submit"></input>
</form> 
	
<center>
<div id="myDivx2" style="width: 400px; height: 400px; display: inline-block;"></div>

<script> countryGraph(); </script>

<div id="myDiv" style="width: 400px; height: 400px; display: inline-block;"></div>
</center>

<script> concentrationGraph(); </script>

</div>
</div>

<div id="view2">
<form name = "major" action="JavaScript:showGraph()" method="get">
Pick Majors:
  <select id="Major 1">
      <option value="">Pick First Major..</option>
	  
    <?php
      $sql = mysqli_query($conn, "SELECT Major FROM InternationalCollegeCosts.MajorSalary ORDER BY Major");
      while($row = $sql->fetch_assoc()){
        echo "<option value = \"".$row['Major']."\">" . $row['Major'] . "</option>";
      }
    ?>
	  
  </select>
    <select id="Major 2">
          <option value="">Pick Second Major..</option>
	    
    <?php
      $sql = mysqli_query($conn, "SELECT Major FROM InternationalCollegeCosts.MajorSalary ORDER BY Major");
      while($row = $sql->fetch_assoc()){
        echo "<option value = \"".$row['Major']."\">" . $row['Major'] . "</option>";
      }
    ?>
	    
  </select>
  <input type="submit"></input>
</form>
 
 <center><div id="myDivx" style="width: 600px; height: 400px; display: inline-block;"></div></center>

  <script> majorGraph(); </script>
  </div>

	
	
	
	
<div id="view4">

<script type = "text/javascript">
function showUnivs(){

  var uni1List = document.getElementById("University1");
  var uni1 = uni1List.options[uni1List.selectedIndex].value;
  var uni2List = document.getElementById("University2");
  var uni2 = uni2List.options[uni2List.selectedIndex].value;

  if (uni1.length == 0 || uni2.length == 0) {
      document.getElementById("table1").innerHTML = "Please select two Universities to compare.";
      return;
  } else {
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else{
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("table1").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "getTable.php?u1=" + encodeURIComponent(uni1) + "&u2=" + encodeURIComponent(uni2), true);
      xmlhttp.send();
  }
}
</script>
	
<div>
    <form name = "UniversityCompare" action = "JavaScript:showUnivs()" method = "get">
    Pick Universities:
  <select id="University1">
        <option value="">Pick First University..</option>
	  
    <?php
      $sql = mysqli_query($conn, "SELECT university_name FROM InternationalCollegeCosts.Universities ORDER BY university_name");

      while($row = $sql->fetch_assoc()){
        echo "<option value = \"".$row['university_name']."\">" . $row['university_name'] . "</option>";
      }
    ?>
	  
  </select>
    <select id="University2">
    <option value="">Pick Second University..</option>
	    
    <?php
      $sql = mysqli_query($conn, "SELECT university_name FROM InternationalCollegeCosts.Universities ORDER BY university_name");
      while($row = $sql->fetch_assoc()){
        echo "<option value = \"".$row['university_name']."\">" . $row['university_name'] . "</option>";
      }
    ?>
	    
  </select>
  <input type="submit"></input>
</form>
<br>
<br>
<br>
<br>
<center><div id = "table1" style = "width:780px;">Please select two Universities to compare.</div></center>
  </div>
</div>




<div id="view5">

<div>
<p> EduCosts is a tool to help students interested in studying abroad in US universities to learn more about Universities in terms of tuition, rank and enrolled students.  Additionally, you will find information to aid major selection based on salary and percentage of international students pursuing the subject cluster. </p>

<p> The data sources used to build this site: <br>
<a href="https://www.data.gov"> Data.gov </a> <br>
<a href="http://www.iie.org/Research-and-Publications/Open-Doors/Data#.WD9irHeZPVp"> Open Doors Data </a> <br>
<a href="https://data.oecd.org/education.htm"> Education OECD Data </a>
<br>
<br>
Website developed as a project for Rutgers University CS:336.
<br>
Designed and Developed by Samiha Amin and Chris McDonough.
</p>
</div>
</div>

</div>

</body>
</html>

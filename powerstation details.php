<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
 if( isset( $_REQUEST['insert'] ))
{
        $psc = $_REQUEST['psc'];
	$psname = $_REQUEST['psname'];;
	$lc = $_REQUEST['lc'];;
	$il=$_REQUEST['il'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="insert into pwr_station_details (PowerStationCode, PowerStationName,LocationName,LocationCode) values ('$psc','$psname','$lc','$il')";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly. Insert ID is ". $mysqli->insert_id;
}
}

if( isset( $_REQUEST['search'] ))
{
    $psc = $_REQUEST['psc'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select PowerStationCode, PowerStationName, LocationCode, LocationName from pwr_station_details where PowerStationCode='$psc'";
if ($stmt=$mysqli->prepare($sql)){
$stmt->execute();
$stmt->bind_result($PowerStationCode, $PowerStationName, $LocationCode, $LocationName);
while ($stmt->fetch()){
    echo "$PowerStationCode $PowerStationName $LocationCode $LocationName <br />";
}
$stmt->close();
}  else {
    echo 'error '. $mysqli->error;    
}
$mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<style type="text/css">
		input {
			display: block;
			background-color: #fffff0;
		}
		.inline { display: inline-block;}

		label {font-weight: bolder;}
	</style>
</head>
<body>

    <h1>Author Registration</h1>
	<p>Please fill in the following form to register as author.</p>
	<form>
		<label for="psc">Power Station Code </label>
		<input type="text" size="50" name="psc" />
                <input type="submit" value="Search" class="inline" name="search"/>
		<p>
		<label for="psname">Power Station Name </label>
		<input type="text" size="50" name="psname" />
		<p>
		<label for="lc">Location Name </label>
		<input type="text" size="50" name="lc" />
		<p>
                    <label for="il">Location code </label>
		<input type="text" size="50" name="il" />
		<p>
			<input type="submit" value="Submit" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                       
		</p>
	</form>
	
</body>
</html>
<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
 if( isset( $_REQUEST['insert'] ))
{
        $trafficcode = $_REQUEST['trafficcode'];
	$trafficid = $_REQUEST['trafficid'];;
	$bstype = $_REQUEST['bstype'];;
	$status=$_REQUEST['status'];;
        $spcode=$_REQUEST['spcode'];;
        $charges=$_REQUEST['charges'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="insert into traffic (TrafficCode, TrafficId,BSType,Status,SpCode,Charges) values ('$trafficcode','$trafficid','$bstype','$status','spcode','charges')";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly.";
}
}
if( isset( $_REQUEST['update'] ))
{
        $trafficcode = $_REQUEST['trafficcode'];
	$trafficid = $_REQUEST['trafficid'];;
	$bstype = $_REQUEST['bstype'];;
	$status=$_REQUEST['status'];;
	$spcode=$_REQUEST['spcode'];;
        $charges=$_REQUEST['charges'];;
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="update bank set trafficcode='$trafficcode', trafficid='$trafficid', bstype='$bstype',status=$['status'],spcode=$['spcode'],charges=['charges'], where trafficcode=$trafficcode";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record Updated successfuly.";
}
}
if( isset( $_REQUEST['search'] ))
{
    $trafficcode = $_REQUEST['trafficcode'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select TrafficCode, TrafficId, B.SType, Status,SpCode,Charges from traffic where TrafficCode like '%$trafficcode%'";
if ($stmt=$mysqli->prepare($sql)){
$stmt->execute();
$stmt->bind_result($TrafficCode, $TrafficId, $B.SType, $Status,$SpCode,$Charges);
while ($stmt->fetch()){
    echo "$TrafficCode | $TrafficId | $B.SType | $Status $SpCode $Charges <br />";
}
$stmt->close();
}  else {
    echo 'error '. $mysqli->error;    
}
$mysqli->close();
}
if( isset( $_REQUEST['search_id'] ))
{
    $trafficcode = $_REQUEST['trafficcode'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select TrafficCode,TrafficId,B.SType,Status,SpCode,Charges from traffic where TrafficCode=$trafficcode";
if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $trafficcode = $row['TrafficCode'];
    $trafficid = $row['TrafficId'];
    $bstype = $row['BSType'];
    $status = $row['Status'];
    $spcode=$row['SpCode'];
    $charges=$row['Charges'];
}  else {
    echo "error: ". $mysqli->error;
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

    <h1>Traffic Registration</h1>
	<p>Please fill in the following form to register as author.</p>
	<form>
		<label for="trafficcode">Traffic Code</label>
		<input type="text" size="50" name="trafficcode" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($trafficcode);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search_id"/>
		<p>
		<label for="trafficid">Traffic ID </label>
		<input type="text" size="50" name="trafficid" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($trafficid);} ?>' />
                <input type="submit" value="Search" class="inline" name="search"/>
		
                <p>
		<label for="bstype">BS.TYPE</label>
		<input type="text" size="50" name="bstype" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($bstype);} ?>'/>
		<p>
                    <label for="status">Status</label>
		<input type="text" size="50" name="status" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($status);} ?>'/>
		<p>
                    <label for="spcode">Sp Code</label>
                    <input type="text" size="50" name="spcode" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($spcode);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search_id"/>
                </p>
                    <label for="charges">Charges</label>
                    <input type="text" size="50" name="charges" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($charges);} ?>'/>
                
                
                    <p>
			<input type="submit" value="Save" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                       <input type="submit" value="Update" class="inline" name="update"/>
		</p>
	</form>
	
</body>
</html>
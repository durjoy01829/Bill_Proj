<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
 if( isset( $_REQUEST['insert'] ))
{
        $meternumber = $_REQUEST['meternumber'];
	$type = $_REQUEST['type'];;
	$cond = $_REQUEST['cond'];;
	//$branchname=$_REQUEST['branchname'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="insert into meter (METERNUMBER, TYPE,COND) values ('$meternumber','$type','$cond')";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly.";
}
}
if( isset( $_REQUEST['update'] ))
{
        $meternumber = $_REQUEST['meternumber'];
	$type= $_REQUEST['type'];;
	$cond = $_REQUEST['cond'];;
	//$branchname=$_REQUEST['branchname'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="update meter set TYPE='$type', COND='$cond' where METERNUMBER=$meternumber";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record Updated successfuly.";
}
}
if( isset( $_REQUEST['search'] ))
{
    $meternumber = $_REQUEST['meternumber'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select METERNUMBER, TYPE, COND from meter where TYPE like '%$type%'";
if ($stmt=$mysqli->prepare($sql)){
$stmt->execute();
$stmt->bind_result($METERNUMBER, $TYPE, $COND);
while ($stmt->fetch()){
    echo "$METERNUMBER | $TYPE | $COND  <br />";
}
$stmt->close();
}  else {
    echo 'error '. $mysqli->error;    
}
$mysqli->close();
}
if( isset( $_REQUEST['search_id'] ))
{
    $meternumber = $_REQUEST['meternumber'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select METERNUMBER, TYPE, COND from meter where meternumber=$meternumber";
if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $meternumber = $row['METERNUMBER'];
    $type = $row['TYPE'];
    $cond = $row['COND'];
    
}  else {
    echo "error: ". $mysqli->error;
}
$mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>METER DETAILS</title>
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

    <h1>METER Registration</h1>
	<p>Please fill in the following form to register as author.</p>
	<form>
		<label for="meternumber">METER NUMBER</label>
		<input type="text" size="50" name="meternumber" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($meternumber);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search_id"/>
		<p>
		<label for="type">TYPE </label>
		<input type="text" size="50" name="type" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($type);} ?>' />
                <input type="submit" value="Search" class="inline" name="search"/>
		<p>
		<label for="cond">COND</label>
		<input type="text" size="50" name="cond" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cond);} ?>'/>
		<p>
			<input type="submit" value="Save" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                       <input type="submit" value="Update" class="inline" name="update"/>
		</p>
	</form>
	
</body>
</html>
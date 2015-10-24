<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
 if( isset( $_REQUEST['insert'] ))
{
        $billno = $_REQUEST['billno'];
	$cd = $_REQUEST['cd'];;
	$consumernumber = $_REQUEST['consumernumber'];;
	$issuedate=$_REQUEST['issedate'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="insert into payment (Billno, Cd,Consumernumber,IsseDate) values ('$billno','$cd','$consumernumber','$issuedate')";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly.";
}
}
if( isset( $_REQUEST['update'] ))
{
        $billno = $_REQUEST['billno'];
	$cd = $_REQUEST['cd'];;
	$consumernumber = $_REQUEST['consumernumber'];;
	$issedate=$_REQUEST['issedate'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="update payment set bankname='$billno',cd='$cd', consumernumber='$consumernumber',issedate='$issedate' where billno=$billno";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record Updated successfuly.";
}
}
if( isset( $_REQUEST['search'] ))
{
    $billno = $_REQUEST['billno'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select Billno,Cd,Consumernumber,IsseDate from payment where Cd like '%$cd%'";
if ($stmt=$mysqli->prepare($sql)){
$stmt->execute();
$stmt->bind_result($Billno, $Cd, $Consumernumber, $IsseDate);
while ($stmt->fetch()){
    echo "$Billno | $Cd | $Consumernumber | $IsseDate <br />";
}
$stmt->close();
}  else {
    echo 'error '. $mysqli->error;    
}
$mysqli->close();
}
if( isset( $_REQUEST['search_id'] ))
{
    $billno = $_REQUEST['billno'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select Billno, Cd, Consumernumber, IsseDate from payment where billno=$billno";
if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $billno = $row['billno'];
    $cd = $row['cd'];
    $consumernumber = $row['consumernumber'];
    $issedate = $row['IsseDate'];
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

    <h1>Bank Registration</h1>
	<p>Please fill in the following form to register as author.</p>
	<form>
		<label for="billno">Bill No</label>
		<input type="text" size="50" name="billno" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($billno);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search_id"/>
		<p>
		<label for="cd">Cd</label>
		<input type="text" size="50" name="cd" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cd);} ?>' />
                <input type="submit" value="Search" class="inline" name="search"/>
		<p>
		<label for="consumernumber">Consumer Number</label>
		<input type="text" size="50" name="consumernumber" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($consumernumber);} ?>'/>
		<p>
                    <label for="branchname">Issue Date</label>
		<input type="text" size="50" name="issedate" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($issedate);} ?>'/>
		<p>
			<input type="submit" value="Save" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                       <input type="submit" value="Update" class="inline" name="update"/>
		</p>
	</form>
	
</body>
</html>
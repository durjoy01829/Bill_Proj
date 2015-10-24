<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
 if( isset( $_REQUEST['insert'] ))
{
        $id = $_REQUEST['id'];
	$area = $_REQUEST['area'];;
	$amount = $_REQUEST['amount'];;
	//$branchname=$_REQUEST['branchname'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="insert into vat (Id, Area,Amount) values ('$id','$area','$amount')";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly.";
}
}
if( isset( $_REQUEST['update'] ))
{
        $id = $_REQUEST['id'];
	$area = $_REQUEST['area'];;
	$amount = $_REQUEST['amount'];;
	//$branchname=$_REQUEST['branchname'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="update vat set Id='$id', Area='$area', amount='$amount' where id=$id";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record Updated successfuly.";
}
}
if( isset( $_REQUEST['search'] ))
{
    $area = $_REQUEST['area'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select Id, Area, Amount from vat where Area like '%$area%'";
if ($stmt=$mysqli->prepare($sql)){
$stmt->execute();
$stmt->bind_result($Id, $Area, $Amount);
while ($stmt->fetch()){
    echo "$Id $Area $Amount <br />";
}
$stmt->close();
}  else {
    echo 'error '. $mysqli->error;    
}
$mysqli->close();
}
if( isset( $_REQUEST['search_id'] ))
{
    $id = $_REQUEST['id'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select Id, Area, Amount from vat where Id=$id";
if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $vid = $row['Id'];
    $varea = $row['Area'];
    $vamount = $row['Amount'];
   // $brname = $row['BRANCHNAME'];
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

    <h1>VAT Registration</h1>
	<p>Please fill in the following form to register as author.</p>
	<form>
		<label for="id">Id</label>
		<input type="text" size="50" name="id" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($vid);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search_id"/>
		<p>
		<label for="area">Area </label>
		<input type="text" size="50" name="area" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($varea);} ?>' />
                <input type="submit" value="Search" class="inline" name="search"/>
		<p>
		<label for="amount">Amount</label>
		<input type="text" size="50" name="amount" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($vamount);} ?>'/>
		
		<p>
			<input type="submit" value="Save" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                       <input type="submit" value="Update" class="inline" name="update"/>
		</p>
	</form>
	
</body>
</html>
<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
 if( isset( $_REQUEST['insert'] ))
{
        $id = $_REQUEST['id'];
	$bankname = $_REQUEST['bankname'];;
	$branchcode = $_REQUEST['branchcode'];;
	$branchname=$_REQUEST['branchname'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="insert into bank (ID, BANKNAME,BRANCHCODE,BRANCHNAME) values ('$id','$bankname','$branchcode','$branchname')";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly.";
}
}
if( isset( $_REQUEST['update'] ))
{
        $id = $_REQUEST['id'];
	$bankname = $_REQUEST['bankname'];;
	$branchcode = $_REQUEST['branchcode'];;
	$branchname=$_REQUEST['branchname'];;
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="update bank set bankname='$bankname', BRANCHCODE='$branchcode', BRANCHNAME='$branchname' where id=$id";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record Updated successfuly.";
}
}
if( isset( $_REQUEST['search'] ))
{
    $bankname = $_REQUEST['bankname'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select ID, BANKNAME, BRANCHCODE, BRANCHNAME from bank where BANKNAME like '%$bankname%'";
if ($stmt=$mysqli->prepare($sql)){
$stmt->execute();
$stmt->bind_result($ID, $BANKNAME, $BRANCHCODE, $BRANCHNAME);
while ($stmt->fetch()){
    echo "$ID | $BANKNAME | $BRANCHCODE | $BRANCHNAME <br />";
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
$sql = "select ID, BANKNAME, BRANCHCODE, BRANCHNAME from bank where ID=$id";
if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $bid = $row['ID'];
    $bname = $row['BANKNAME'];
    $bcode = $row['BRANCHCODE'];
    $brname = $row['BRANCHNAME'];
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
		<label for="id">ID</label>
		<input type="text" size="50" name="id" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($bid);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search_id"/>
		<p>
		<label for="bankname">BANK NAME </label>
		<input type="text" size="50" name="bankname" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($bname);} ?>' />
                <input type="submit" value="Search" class="inline" name="search"/>
		<p>
		<label for="branchcode">BRANCH CODE</label>
		<input type="text" size="50" name="branchcode" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($bcode);} ?>'/>
		<p>
                    <label for="branchname">BRANCH NAME</label>
		<input type="text" size="50" name="branchname" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($brname);} ?>'/>
		<p>
			<input type="submit" value="Save" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                       <input type="submit" value="Update" class="inline" name="update"/>
		</p>
	</form>
	
</body>
</html>
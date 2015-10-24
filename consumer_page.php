<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
if( isset( $_REQUEST['insert'] ))
{
        $id = $_REQUEST['id'];
	 $name = $_REQUEST['name'];
	 $address = $_REQUEST['address'];
          $division = $_REQUEST['division'];
          $meternumber = $_REQUEST['meternumber'];
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="insert into consumer (Consumer_NO, NAME, ADDRESS, DIVISION, METERNUMBER) values ($id, '$name', '$address', '$division', $meternumber)";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly.";
}
}
if( isset( $_REQUEST['update'] ))
{
     $id = $_REQUEST['id'];
	 $name = $_REQUEST['name'];
         $address = $_REQUEST['address'];
             $division = $_REQUEST['division'];
              $meternumber = $_REQUEST['meternumber'];
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="update consumer set NAME='$name', ADDRESS='$address', DIVISION='$division', METERNUMBER=$meternumber where Consumer_NO=$id";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record Updated successfuly.";
}
}
if( isset( $_REQUEST['search'] ))
{
    $name = $_REQUEST['name'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select Consumer_NO, NAME,ADDRESS, DIVISION, METERNUMBER from consumer where NAME like '%$name%'";
if ($stmt=$mysqli->prepare($sql)){
$stmt->execute();
$stmt->bind_result($ID,$NAME,$ADDRESS,$DIVISION,$METERNUMBER);
while ($stmt->fetch()){
    echo "$ID $NAME $ADDRESS $DIVISION $METERNUMBER <br />";
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
$sql = "select Consumer_NO,NAME,ADDRESS,DIVISION,METERNUMBER from consumer where Consumer_NO=$id";
if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $cid = $row['Consumer_NO'];
    $cname = $row['NAME'];
    $caddress = $row['ADDRESS'];
    $cdivision=$row['DIVISION'];
    $cmeternumber=$row['METERNUMBER'];
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
	<title>CONSUMER</title>
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

    <h1>CONSUMER FORM</h1>
	<p>Please fill in the following form to register as author.</p>
	<form>
		<label for="id">ID</label>
		<input type="text" size="50" name="id" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cid);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search_id"/>
		<p>
                    <label for="name">NAME</label>
		<input type="text" size="50" name="name" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cname);} ?>'/>
                <input type="submit" value="Search" class="inline" name="search"/>   
                <p>
		<label for="address">ADDRESS </label>
		<input type="text" size="50" name="address" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($caddress);} ?>' />
                
		<p>
		<label for="division">DIVISION</label>
		<input type="text" size="50" name="division" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cdivision);} ?>'/>
                <p>
                   <label for="meternumber">METER NUMBER</label>
		<input type="text" size="50" name="meternumber" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cmeternumber);} ?>'/> 
                </p>
	
			<input type="submit" value="Save" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                       <input type="submit" value="Update" class="inline" name="update"/>
		</p>
	</form>
	
</body>
</html>
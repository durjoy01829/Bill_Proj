<?php
//$p=& $_POST;
$id= $_GET['id'];
$Consumer_NO= $_GET['Consumer_NO'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
//$sql = "select ID, BillGroup, BookNumber, WalkOrd, Cd, IssueDate, PresentDate, PreviousDate, LastPaymentDate, OldMeterUnit, Vat, PresentRdg, Status from billingtable where ID=$id";
$sql = "select * from billingtable where ID=$id";
$sql1 = "select * from consumer where Consumer_NO=$Consumer_NO";

if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $id = $row['ID'];
   $bgroup=$row['BillGroup'];
   $bno=$row['BookNumber'];
   $Cd=$row['Cd'];
   $IssueDate=new DateTime($row['IssueDate']);
   $IssueDate=$IssueDate->format('d/m/y');
  // $MONTH=;
   $MONTH = new DateTime($row['IssueDate']);
$MONTH =$MONTH->format('M-Y'); 
//
}  else {
    echo "error: ". $mysqli->error;
}
//$mysqli->close();

if ($result1 = $mysqli->query($sql1)){
    $row=$result1->fetch_assoc();
   $Consumer_NO = $row['Consumer_NO'];
    $Consumer_Name = $row['NAME'];
     $Consumer_Add = $row['ADDRESS'];
      $Consumer_dv = $row['DIVISION'];
//
}  else {
    echo "error: ". $mysqli->error;
}
$mysqli->close();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Print Bill</title>
        
    </head>
  
    <body id="body-color">
          <h1>BANGLADESH POWER DEVELOPMENT BOARD</h1>
        <div id="Sign-In">
            
          <form>
            
             <p>
                    
                 <label for="bno">Consumer NO <?=$Consumer_NO?></label>
                 <label for="bno">Consumer Name : <?=$Consumer_Name?></label> 
                 <label for="bno">Consumer Address : <?=$Consumer_Add?></label> 
                 <label for="bno">Consumer Div : <?=$Consumer_dv = $row['DIVISION'];?></label>
 <p>
     <label for="month">MONTH <?=$MONTH?> </label> <label for="id">BILL NO. <?=$id?></label> <label for="id">CD <?=$Cd?></label> <label for="id">Issue Date <?=$IssueDate?></label>
     <p>
  
<label for="Grop">BILL Group <?=$bgroup?></label> 
<label for="bno">BILL NO <?=$bno?></label> 
                  <p>
                
          </form> 
            
    </body>
</html>
   
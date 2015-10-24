<?php
$content = '<h1></h1>';
 include('master.php');
//get submitted variables
 if( isset( $_REQUEST['insert'] ))
 {
    	$id = $_REQUEST['id'];
        $Consumer_NO = $_REQUEST['Consumer_NO'];
	$billgroup = $_REQUEST['billgroup'];;
	$booknumber = $_REQUEST['booknumber'];;
	$walkord=$_REQUEST['walkord'];;
        $cd=$_REQUEST['cd'];;
	$issuedate=$_REQUEST['issuedate'];;
        $presentdate=$_REQUEST['presentdate'];;
        $previousdate=$_REQUEST['previousdate'];;
        $lastpaymentdate=$_REQUEST['lastpaymentdate'];;
        $oldmeterunit=$_REQUEST['oldmeterunit'];;
        $vat=$_REQUEST['vat'];;
        $presentrdg=$_REQUEST['presentrdg'];;
        $previousrdg=$_REQUEST['previousrdg'];;
        $consumerunit=$_REQUEST['consumerunit'];;
        $aprfrom=$_REQUEST['aprfrom'];;
        $aprupto=$_REQUEST['aprupto'];;
        $traffic=$_REQUEST['traffic'];;
        $bstype=$_REQUEST['bstype'];;
        $status=$_REQUEST['status'];;
        $spcode=$_REQUEST['spcode'];;
        $spdvaluerule=$_REQUEST['spdvaluerule'];;
       // $spcode=$_REQUEST['spcode'];;
       // $spdvaluerule=$_REQUEST['spdvaluerule'];;
        $meterno=$_REQUEST['meterno'];;
        $type=$_REQUEST['type'];;
        $cond=$_REQUEST['cond'];;
        $omf=$_REQUEST['omf'];;
        $sload=$_REQUEST['sload'];;
       // $month=$_REQUEST['month'];;
        $electricitycharge=$_REQUEST['electricitycharge'];;
        $demandcharge=$_REQUEST['demandcharge'];;
        $minimumcharge=$_REQUEST['minimumcharge'];;
        $servicecharge=$_REQUEST['servicecharge'];;
        $addprinciple=$_REQUEST['addprinciple'];;
        
        
        $mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    
       //$sql="insert into billingtable (ID, BillGroup, BookNumber, WalkOrd, Cd, IssueDate, PresentDate, PreviousDate, LastPaymentDate, OldMeterUnit, Vat, PresentRdg, PreviousRdg, ConsumerUnit,  Status) values ($id, $billgroup, $booknumber, $walkord, $cd, STR_TO_DATE('$issuedate', '%d/%m/%Y'), STR_TO_DATE('$presentdate', '%d/%m/%Y'), STR_TO_DATE('$previousdate', '%d/%m/%Y'), STR_TO_DATE('$lastpaymentdate', '%d/%m/%Y'), $oldmeterunit, $vat, $presentrdg, $previousrdg, $oldmeterunit, $consumerunit, 'Issued')";
$sql="insert into billingtable "
      . "(ID, Consumer_NO, BillGroup, BookNumber, WalkOrd, Cd, IssueDate, PresentDate, PreviousDate, LastPaymentDate, OldMeterUnit, Vat, PresentRdg, PreviousRdg, ConsumeUnit, APR_From, APR_Upto, Traffic, B_S_Type, Status, S_P_Code, SpdValue_Rule, MeterNO, Type, COND, OMF, S_LOAD_KW, ElectricityCharge, DemandCharge, MunimumCharge, ServiceCharge, Add_Principle, Bill_Status)"
     // . "(ID, Consumer_NO, BillGroup, BookNumber, WalkOrd, Cd, IssueDate, PresentDate, PreviousDate, LastPaymentDate,OldMeterUnit, Vat, PresentRdg, PreviousRdg, ConsumeUnit)"
//. " values ($id, $Consumer_NO, $billgroup, $booknumber, $walkord, $cd, STR_TO_DATE('$issuedate', '%d/%m/%Y'), STR_TO_DATE('$presentdate', '%d/%m/%Y'), STR_TO_DATE('$previousdate', '%d/%m/%Y'), STR_TO_DATE('$lastpaymentdate', '%d/%m/%Y'),$oldmeterunit, $vat, $presentrdg, $previousrdg, $consumerunit)";
. " values ($id, $Consumer_NO, $billgroup, $booknumber, $walkord, $cd, STR_TO_DATE('$issuedate', '%d/%m/%Y'), STR_TO_DATE('$presentdate', '%d/%m/%Y'), STR_TO_DATE('$previousdate', '%d/%m/%Y'), STR_TO_DATE('$lastpaymentdate', '%d/%m/%Y'), $oldmeterunit, $vat, $presentrdg, $previousrdg, $consumerunit, '$aprfrom', '$aprupto', '$traffic', '$bstype', '$status', '$spcode', '$spdvaluerule', $meterno, $type, '$cond', $omf, $sload, $electricitycharge, $demandcharge,  $minimumcharge, $servicecharge, $addprinciple, 'Issued')";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record inserted successfuly. Insert ID is ". $mysqli->insert_id;
}
 
 }
   if( isset( $_REQUEST['update'] ))  
       {
        $id = $_REQUEST['id'];
	
	
	$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');

    $sql="update billingtable set Bill_Status='Paid' where id=$id";
if (!$mysqli->query($sql)){
    trigger_error($mysqli->error);
}  else {
    echo "Record Updated successfuly.";
}
}


if( isset( $_REQUEST['search_id'] ))
{
    
     $id = $_REQUEST['id'];
$mysqli = new mysqli('localhost', 'root', '', 'billingsystem');
$sql = "select ID, BillGroup, BookNumber, WalkOrd, Cd, IssueDate, PresentDate, PreviousDate, LastPaymentDate, OldMeterUnit, Vat, PresentRdg, PreviousRdg, ConsumeUnit, APR_From, APR_Upto, Traffic, B_S_Type, Status, S_P_Code, SpdValue_Rule, MeterNO, Type, COND, OMF, S_LOAD_KW, ElectricityCharge, DemandCharge, MunimumCharge, ServiceCharge, Add_Principle, Consumer_NO from billingtable where ID=$id and Bill_Status='Issued'";
if ($result = $mysqli->query($sql)){
    $row=$result->fetch_assoc();
    $id = $row['ID'];
    $Consumer_NO = $row['Consumer_NO'];
    
   $bgroup=$row['BillGroup'];
  	$booknumber = $row['BookNumber'];;
	$walkord=$row['WalkOrd'];;
        $cd=$row['Cd'];;
       
        $issuedate= new DateTime($row['IssueDate']);
        $issuedate =$issuedate->format('d/m/y'); 
        $presentdate= new DateTime($row['PresentDate']);
        $presentdate=$presentdate->format('d/m/y'); 
        
        $previousdate=new DateTime($row['PreviousDate']);
        $previousdate=$previousdate->format('d/m/y');
        $lastpaymentdate=new DateTime($row['LastPaymentDate']);
        $lastpaymentdate=$lastpaymentdate->format('d/m/y');
               
        $oldmeterunit=$row['OldMeterUnit'];;
        $vat=$row['Vat'];;
        $presentrdg=$row['PresentRdg'];;
        $previousrdg=$row['PreviousRdg'];;
        $consumerunit=$row['ConsumeUnit'];;
        $aprfrom=$row['APR_From'];;
        $aprupto=$row['APR_Upto'];;
        $traffic=$row['Traffic'];;
        $bstype=$row['B_S_Type'];;
        $status=$row['Status'];;
        $spcode=$row['S_P_Code'];;
        $spdvaluerule=$row['SpdValue_Rule'];
        $meterno=$row['MeterNO'];
        $type=$row['Type'];;
        $cond=$row['COND'];;
        $omf=$row['OMF'];;
        $sload=$row['S_LOAD_KW'];;
        $electricitycharge=$row['ElectricityCharge'];;
        $demandcharge=$row['DemandCharge'];;
        $minimumcharge=$row['MunimumCharge'];;
        $servicecharge=$row['ServiceCharge'];;
        $addprinciple=$row['Add_Principle'];;
        
}  else {
    echo "error: ". $mysqli->error;
}
$mysqli->close();
}

if( isset( $_REQUEST['print'] ))
{
    $id = $_REQUEST['id'];
    $Consumer_NO = $_REQUEST['Consumer_NO'];
    header('Location: Print_Bill.php?id='. $id .'&Consumer_NO=' . $Consumer_NO);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>BILL</title>
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

    <h1>BILL ENTRY</h1>
	<p>Please fill in the following form to bill as author.</p>
	<form method="post">
            <div>
<label for="id">BILL NO.</label>
<input type="text" size="50" name="id" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($id);} ?>'/>
    <input type="submit" value="Search" class="inline" name="search_id"/>
		<p>
		<label for="billgroup">Bill Group </label>
		<input type="text" size="50" name="billgroup" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($bgroup);} ?>'/>
            
		<p>
		<label for="booknumber">Book Number </label>
		<input type="text" size="50" name="booknumber" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($booknumber);} ?>'/>
                
		<p>
                    <label for="walkord">Walk Ord </label>
		<input type="text" size="50" name="walkord" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($walkord);} ?>'/>
		<p>
                 
                    <label for="Consumer_NO">Consumer No.</label>
		<input type="text" size="50" name="Consumer_NO" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($Consumer_NO);} ?>'/>
		<p>
<label for="cd">Cd </label>
		<input type="text" size="50" name="cd" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cd);} ?>'/>
<p>
<label for="issuedate">Issue Date </label>
		<input type="text" size="50" name="issuedate" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($issuedate);} ?>'/>
<p>
<label for="presentdate">Present Date</label>
		<input type="text" size="50" name="presentdate" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($presentdate);} ?>'/>
<p>
<label for="previousdate">Previous Date</label>
		<input type="text" size="50" name="previousdate" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($previousdate);} ?>'/>
<p>
<label for="lastpaymentdate">Last Payment Date</label>
		<input type="text" size="50" name="lastpaymentdate" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($lastpaymentdate);} ?>'/>
<p>
<label for="oldmeterunit">Old Meter Unit </label>
<input type="text" size="50" name="oldmeterunit" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($oldmeterunit);} ?>'/>
<p>
<label for="vat">Vat</label>
		<input type="text" size="50" name="vat" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($vat);} ?>'/>
<p>
<label for="presentrdg">Present Rdg </label>
		<input type="text" size="50" name="presentrdg" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($presentrdg);} ?>'/>
<p>
<label for="previousrdg">Previous Rdg</label>
		<input type="text" size="50" name="previousrdg" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($previousrdg);} ?>'/>
<p>
<label for="consumerunit">Consumed Unit</label>
		<input type="text" size="50" name="consumerunit" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($consumerunit);} ?>'/>
<p>
<label for="aprfrom">APR.FROM</label>
		<input type="text" size="50" name="aprfrom" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($aprfrom);} ?>'/>
<p>
<label for="aprupto">APR.Upto</label>
		<input type="text" size="50" name="aprupto" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($aprupto);} ?>'/>
<p>
<p>
<label for="traffic">Traffic</label>
		<input type="text" size="50" name="traffic" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($traffic);} ?>'/>
<p>
<label for="bstype">B.S.Type</label>
		<input type="text" size="50" name="bstype" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($bstype);} ?>'/>
<p>
<label for="status">Status</label>
		<input type="text" size="50" name="status" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($status);} ?>'/>
<p>
<label for="spcode">S.P.Code</label>
		<input type="text" size="50" name="spcode" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($spcode);} ?>'/>
<p>
<label for="spdvaluerule">SpdValue Rule </label>
		<input type="text" size="50" name="spdvaluerule" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($spdvaluerule);} ?>'/>
<p>
<label for="meterno">Meter No</label>
		<input type="text" size="50" name="meterno" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($meterno);} ?>'/>
<p>
<label for="type">Type</label>
		<input type="text" size="50" name="type" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($type);} ?>'/>
<p>
<label for="cond">COND</label>
		<input type="text" size="50" name="cond" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($cond);} ?>'/>
<p>
<label for="omf">OMF</label>
		<input type="text" size="50" name="omf" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($omf);} ?>'/>
<p>
<label for="sload">S.Load</label>
		<input type="text" size="50" name="sload" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($sload);} ?>'/>
<p>
<label for="electricitycharge">Electricity Charge</label>
		<input type="text" size="50" name="electricitycharge" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($electricitycharge);} ?>'/>
<p>
<label for="demandcharge">Demand Charge</label>
		<input type="text" size="50" name="demandcharge" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($demandcharge);} ?>'/>
<p>
<label for="minimumcharge">Minimum Charge</label>
		<input type="text" size="50" name="minimumcharge" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($minimumcharge);} ?>'/>
<p>
<label for="servicecharge">Service Charge</label>
		<input type="text" size="50" name="servicecharge" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($servicecharge);} ?>'/>
<p>
<label for="addprinciple">Add Principle</label>
		<input type="text" size="50" name="addprinciple" value='<?php if(isset($_REQUEST['search_id'])){echo htmlentities($addprinciple);} ?>'/>
<p>

			<input type="submit" value="Submit" class="inline" name="insert"/>
			<input type="reset" value="Cancel" class="inline" />
                        <input type="submit" value="Payment" class="inline" name="update"/>
                        <input type="submit" value="Print" class="inline" name="print"/>
		</p>
                </div>
	</form>
	
</body>
</html>
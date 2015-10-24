<?php
$p=& $_POST;
$username=trim($p['username']);
$pass=trim($p['password']);
$link =mysql_connect('localhost','root','');
if (!$link){
    echo "no";
}else {
        //echo "ok";
    }
$db=  mysql_select_db('mydb', $link);
if (!$db){
    echo "null";
}  else {
//echo "yes" ;   
}

$result=mysql_query("select * from user where username='$username'");
$row=mysql_fetch_assoc($result);
//echo htmlentities($row['Password']);
if ($row['Password']=$pass)
{
   echo "Welcome " .$username;
   header('Location: Home.php');
}
else {
   echo "Invalid username or password !!";
   header('Location: index.php');
}

//echo "Welcome " .$msg;
mysql_close($link);


?>


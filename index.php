<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if( isset( $_REQUEST['login'] ))
{
  // $p=& $_POST; $_REQUEST['password']
    //$username="";
    //$pass="";
$username=trim($_REQUEST['username']);
$pass=trim($_REQUEST['password']);
$link =mysql_connect('localhost','root','');
if (!$link){
    echo "no";
}else {
        //echo "ok";
    }
$db=  mysql_select_db('billingsystem', $link);
if (!$db){
    echo "null";
}  else {
//echo "yes" ;   
}

$result=mysql_query("select * from user where username='$username' and Password='$pass'");
$row=mysql_fetch_assoc($result);
//echo htmlentities($row['Password']);
if ($pass=$row['Password'])
{
   echo "Welcome " .$username ;
   header('Location: Home.php');
}
else {
   echo "Invalid username or password !!";
   //header('Location: index.php');
}

//echo "Welcome " .$msg;
mysql_close($link);


}
    ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
  
    <body id="body-color">
            <h1>BANGLADESH POWER DEVELOPMENT BOARD</h1>
        <div id="Sign-In">
            
          <form>
              User Name : <br> <input type="text" size="15" name="username" /> <br> 
              
              Password :  <br> <input type="password" size="15" name="password" /> <br> 
              <input type="submit" value="Login" name="login"/>
       
          </form> 
            
    </body>
</html>
<?php

?>

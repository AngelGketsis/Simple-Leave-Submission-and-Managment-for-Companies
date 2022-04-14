<html>
<body>

<?php

use LDAP\Result;

session_start();
require 'db_connect.php';

$app_id = $_POST["app_id"];
$up_status = $_POST["up_status"];


if($_SESSION["admin_status"])
{
  $sql = "UPDATE `applications` SET `statuss`= '$up_status' WHERE application_id LIKE '$app_id' ";


  if ($mysqli->query($sql) === TRUE) 
  {
    echo "Record updated successfully";
  } 
  else 
  {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
}
else
{
  echo "Invalid Permissions";
}
?>

<form method="POST" action="admin_action.php">
<input type="submit" value="BACK"/>
</form>


<br>

</body>    
</html>
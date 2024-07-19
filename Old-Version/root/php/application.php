<html>
<body>

<?php

use LDAP\Result;

session_start();
require 'db_connect.php';

$date1 = $_POST["dt1"];
$date2 = $_POST["dt2"];
$reas = $_POST["reas"];
$id = $_SESSION["id"];
$current_date = date("Y-m-d");

if($_SESSION["employee_status"])
{

  $sql = "INSERT INTO applications(id, date_submitted, startd, endd, Reason, statuss) VALUES ('$id', '$current_date', '$date1', '$date2', '$reas', 'pending')";

  if ($mysqli->query($sql) === TRUE) 
  {
    echo "New application created successfully";
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

<form method="POST" action="employee_action.php">
<input type="submit" value="BACK"/>
</form>


<br>

</body>    
</html>
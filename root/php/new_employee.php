<html>
<body>

<?php

use LDAP\Result;

session_start();
require 'db_connect.php';

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mail = $_POST["mail"];
$type = $_POST["type"];
$nuser = $_POST["new_user"];
$npass = $_POST["new_pass"];
$npass_2 = $_POST["new_pass_2"];

if($_SESSION["root_status"])
{
  if(strcmp($npass, $npass_2) == 0)
  {
      if($type == "admin")
      {
        $sql = "INSERT INTO `supervisor`(`first_name`, `last_name`, `email`, `username`, `passw`, `id`) VALUES ('$fname','$lname','$mail','$nuser','$npass','NULL')";
      }
      else
      {
        $sql = "INSERT INTO `employee`(`first_name`, `last_name`, `email`, `username`, `passw`, `id`) VALUES ('$fname','$lname','$mail','$nuser','$npass','NULL')";
      }
  }
  else
  {
      echo "Password and Re-confirm Password do not match.";
  }
  

  if ($mysqli->query($sql) === TRUE) 
  {
      echo "New user created successfully";
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

<form method="POST" action="root_action.php">
<input type="submit" value="BACK"/>
</form>


<br>

</body>    
</html>
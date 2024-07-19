<html>
<body>

<?php 

    require 'db_connect.php';

    session_start();
    if(!is_null($_POST["usern"]))
    {
        $usern = $_POST["usern"];
        $_SESSION["usern"] = $usern;
    }
    else
    {
        $usern = $_SESSION["usern"];
    }
    if(!is_null($_POST["pass"]))
    {
        $pass = $_POST["pass"];
        $_SESSION["pass"] = $pass;
    }
    else
    {
        $pass = $_SESSION["pass"];
    }

    $sql1 = "SELECT `id`, passw FROM supervisor WHERE username LIKE '". $usern . "' ";
    $result  = $mysqli->query($sql1);

    $id;
    $password;
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $id = $row["id"];
            $password = $row["passw"]; 
        }
    }
    else
    {
        echo "Account does not exist! <br>";
    }
    
    $valid = false;

    if($pass == $password)
    {
        echo "Valid password <br>";
        $valid = True;
    }
    else
    {
        echo "Invalid password <br>";
    }

    $_SESSION["admin_status"] = $valid;

    if($valid)
    {
        $sql2 = "SELECT `id`, application_id, date_submitted, `startd`, `endd`, Reason, `statuss` FROM `applications` WHERE statuss LIKE 'pending' ORDER BY date_submitted ";
        $result2  = $mysqli->query($sql2);
        echo "<h1>Pending applications:</h1> <br>";
        echo "------------------------------------------------------------------------------------------------------------<br>";
        if ($result2->num_rows > 0)
        {
          while($row = $result2->fetch_assoc())
          {
            echo " ID: " . $row["id"] . " Application ID: " . $row["application_id"] . " Date Submitted: " . $row["date_submitted"] ." From: " . $row["startd"]. " Until:" . $row["endd"] . " Reason:" . $row["Reason"] . " Status: ". $row["statuss"] ."<br>";
            echo "------------------------------------------------------------------------------------------------------------<br>";
          }
        }
        else
        {
            echo "0 results";
        }
    }
    else
    {
        echo "Invalid Password! <br>";
    }
    $mysqli->close();
?>

<h2>Update Application</h2>
<form action="update_application.php" method="POST">
  <label for="app_id">Application ID:</label>
  <input type="text" id="app_id" name="app_id">
  <br>
  <label for="up_status">Choose a car:</label>
  <select id="up_status" name="up_status">
    <option value="approved">Approved</option>
    <option value="declined">Declined</option>
  </select>
  <input type="submit">
</form>


<form method="POST" action="../admin_login.php">
<input type="submit" value="BACK"/>
</form>
<br>


</body>
</html>
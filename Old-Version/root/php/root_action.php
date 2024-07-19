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

    $sql1 = "SELECT passw FROM root_acc WHERE username LIKE '". $usern . "' ";
    $result  = $mysqli->query($sql1);

    $password;
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
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

    $_SESSION["root_status"] = $valid;

?>

<form method="POST" action="submit_new_user.php">
<input type="submit" value="Create New User"/>
</form>
<br>

<?php

    if($valid)
    {
        $sql2 = "SELECT `first_name`, `last_name`, `email`, `username`, `id` FROM `employee`";
        $result2  = $mysqli->query($sql2);
        echo "<h1>Employees:</h1> <br>";
        echo "------------------------------------------------------------------------------------------------------------<br>";
        if ($result2->num_rows > 0)
        {
          while($row = $result2->fetch_assoc())
          {
            echo " First Name: " . $row["first_name"] . " Last Name: " . $row["last_name"] . " Email: " . $row["email"]. " Username:" . $row["username"] . " Id: ". $row["id"] ."<br>";
            echo "------------------------------------------------------------------------------------------------------------<br>";
          }
        }
        else
        {
            echo "0 results";
        }

        $sql3 = "SELECT `first_name`, `last_name`, `email`, `username`, `id` FROM `supervisor`";
        $result3  = $mysqli->query($sql3);
        echo "<h1>Admins:</h1> <br>";
        echo "------------------------------------------------------------------------------------------------------------<br>";
        if ($result3->num_rows > 0)
        {
          while($row = $result3->fetch_assoc())
          {
            echo " First Name: " . $row["first_name"] . " Last Name: " . $row["last_name"] . " Email: " . $row["email"]. " Username:" . $row["username"] . " Id: ". $row["id"] ."<br>";
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

<form method="POST" action="../root_login.php">
<input type="submit" value="BACK"/>
</form>
<br>


</body>
</html>
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

    

    $sql1 = "SELECT `id`, passw FROM employee WHERE username LIKE '". $usern . "' ";
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
    
    $_SESSION["id"] = $id;

    $valid = false;

    if($pass == $password)
    {
        echo "Valid password <br>";
        $valid = True;
    }

    $_SESSION["employee_status"] = $valid;
?>

<form method="POST" action="submit_application.php">
<input type="submit" value="Sumbit Request"/>
</form>
<br>

<?php
    if($valid)
    {
        $sql2 = "SELECT `application_id`, `date_submitted`, `startd`, `endd`, `statuss` FROM `applications` WHERE id LIKE $id ORDER BY date_submitted";
        $result2  = $mysqli->query($sql2);
        echo "Past applications: <br>";
        echo "------------------------------------------------------------------------------------------------------------<br>";
        if ($result2->num_rows > 0)
        {
          while($row = $result2->fetch_assoc())
          {
            echo "Application id: " . $row["application_id"] . " Submission Date: " . $row["date_submitted"] . " from: " . $row["startd"] . " until:" . $row["endd"] . " status: ". $row["statuss"] ."<br>";
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


<form method="POST" action="../employee_login.php">
<input type="submit" value="BACK"/>
</form>
<br>

</body>
</html>
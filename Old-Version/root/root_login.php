<!DOCTYPE html>
<html>
<head>
  <p>Submit Employee credentials please!</p>
</head>
<body>
		
		<form action="php/root_action.php" method="post">
        <label for="usern">Username:</label><br>
        <input type="text" id="usern" name="usern" ><br>
        <label for="pass">Password:</label><br>
        <input type="password" id="pass" name="pass" ><br><br>
        <input type="submit" value="Submit">
    </form><br>

    <form method="POST" action="index.php">
    	<input type="submit" value="Back"/>
    </form>
</body>
</html>
		
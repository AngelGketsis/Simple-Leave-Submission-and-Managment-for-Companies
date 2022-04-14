<!DOCTYPE html>
<html>
<head>
<body>

<h2>New Employee</h2>
<form action="new_employee.php" method="post">
  <label for="fname">First Name:</label>
  <input type="text" id="fname" name="fname">
  <br>
  <br>
  <label for="lname">Last Name:</label>
  <input type="text" id="lname" name="lname">
  <br>
  <br>
  <label for="mail">Email:</label>
  <input type="text" id="mail" name="mail">
  <br>
  <br>
  <label for="type">User Type:</label>
  <select id="type" name="type">
    <option value="admin">Admin</option>
    <option value="employee">Employee</option>
  </select>
  <br>
  <br>
  <label for="new_user">Username:</label>
  <input type="text" id="new_user" name="new_user">
  <br>
  <br>
  <label for="new_pass">Password: </label>
  <input type="text" id="new_pass" name="new_pass">
  <br>
  <br>
  <label for="new_pass_2">Re-confirm Password: </label>
  <input type="text" id="new_pass_2" name="new_pass_2">
  <br>
  <br>
  <input type="submit" value="Create">
</form><br>

</body>
</head>

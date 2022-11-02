<?php include "../inc/dbinfo.inc"; ?>
<html>  
<head>  
<meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
</head>  
<body>  
<?php

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

/* Ensure that the EMPLOYEES table exists. */
VerifyTable($connection, DB_DATABASE);

/* If input fields are populated, add a row to the EMPLOYEES table. */
$user = htmlentities($_POST['user_name']);
$email = htmlentities($_POST['email']);
$pw = htmlentities($_POST['password']);

if (strlen($user) || strlen($email) || strlen($pw)) {
  AddUser($connection, $user, $email, $pw);
}
?>
<div class="container">
    <div class="title">Create an account</div>
    <div class="content">
      <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="user_name" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" name="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" placeholder="Confirm your password" required>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>
<?php

$result = mysqli_query($connection, "SELECT * FROM userbase");

while($query_data = mysqli_fetch_row($result)) {
  echo "<br>";
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>";
  echo "</tr>";
}
?>

</table>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>

<?php

/* Add an employee to the table. */
function AddUser($connection, $user, $pw, $email) {
   $n = mysqli_real_escape_string($connection, $user);
   $a = mysqli_real_escape_string($connection, $pw);
   $i = mysqli_real_escape_string($connection, $email);

   $query = "INSERT INTO userbase (user_name, email, password) VALUES ('$n', '$a', '$i');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding user data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyTable($connection, $dbName) {
  if(!TableExists("userbase", $connection, $dbName))
  {
     $query = "CREATE TABLE userbase (
         ID int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         user_name VARCHAR(45),
         email VARCHAR(45),
         password VARCHAR(45)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>                   
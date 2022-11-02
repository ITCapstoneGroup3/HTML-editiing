<!DOCTYPE html>  
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
  $conn = mysqli_connect("dbuno.culbmfqkukyt.us-east-1.rds.amazonaws.com", "admin", "ITgroup3!", "dbuno");
   
  // Check connection
  if($conn === false){
      die("ERROR: Could not connect. "
          . mysqli_connect_error());
  }
   
  // Taking all 5 values from the form data(input)
  $first_name =  $_REQUEST['first_name'];
  $last_name = $_REQUEST['last_name'];
  $email = $_REQUEST['email'];
  $user_name = $_REQUEST['user_name'];
   
  // Performing insert query execution
  // here our table name is college
  $sql = "INSERT INTO college  VALUES ('$first_name',
      '$last_name','$gender','$address','$email')";
   
  if(mysqli_query($conn, $sql)){
      echo "<h3>Account created</h3>";

      echo nl2br("\n$first_name\n $last_name\n "
          . "$user_name\n $email");
  } else{
      echo "ERROR: Hush! Sorry $sql. "
          . mysqli_error($conn);
  }
   
  // Close connection
  mysqli_close($conn);
  ?>

<div class="container">
    <div class="title">Create an account</div>
    <div class="content">
      <form action="#">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="first_name" placeholder="Enter your first name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="last_name" placeholder="Enter your last name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details">Birthday</span>
            <input type="text" placeholder="Enter your birthday" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="text" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="text" placeholder="Confirm your password" required>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
          <input type="radio" name="gender" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
  </div>
</body>
</html>
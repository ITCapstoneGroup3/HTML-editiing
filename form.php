<?php
  require 'vendor/autoload.php';

  use Aws\S3\S3Client;
  use Aws\Exception\AwsException;
  
  //Create an S3Client
  $s3 = new Aws\S3\S3Client([
    'version' => 'latest',
    'region' => 'us-east-1'
  ]);


  $conn = mysqli_connect("dbuno.culbmfqkukyt.us-east-1.rds.amazonaws.com", "admin", "ITgroup3!", "dbuno");
   
  // Check connection
  if($conn === false){
      die("ERROR: Could not connect. "
          . mysqli_connect_error());
  }
   
  // Taking all 5 values from the form data(input)
  $email = $_REQUEST['email'];
  $user_name = $_REQUEST['user_name'];
  $user_name = $_REQUEST['password'];
   
  // Performing insert query execution
  // here our table name is college
  $sql = "INSERT INTO userbase  VALUES ('$password', '$user_name', '$email')";
   
  if(mysqli_query($conn, $sql)){
      echo "<h3>Account created</h3>";

      echo nl2br("$user_name\n $email");
  } else{
      echo "ERROR: Hush! Sorry $sql. "
          . mysqli_error($conn);
  }
   
  // Close connection
  mysqli_close($conn);
?>
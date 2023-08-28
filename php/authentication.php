<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
$servername = "localhost";
$User_valid = "root";
$Pin_valid = "";
$dbname = "mycaptcha";


$conn = new mysqli($servername, $User_valid, $Pin_valid, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get the post records

/*$error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$Email)) {
 
    $error_message .= '<li><p>The completed e-mail address appears to be incorrect<p></li>';
 
  }*/

  $email_details = $_POST['mail_id'];
  $name_details = $_POST['full_name'];
  $client_details = $_POST['user_id'];
  $pass_details = $_POST['pass'];
  
// database insert SQL code


$query="select * from captcha where (user='$client_details' or mailid='$email_details');";

      $res=mysqli_query($conn,$query);

      if (mysqli_num_rows($res) > 0) {
        
        $row = mysqli_fetch_assoc($res);
        if($email_details==isset($row['mailid'])|| $client_details==isset($row['user']))
        {
          echo "<script type='text/javascript'>alert('Hey admin We are redirecting you to admin page');
          location='../instasignup.html';</script>";
        }
      }
 else{
  $sql ="INSERT INTO captcha (mailid, fullname , user , pin) VALUES ('$email_details','$name_details','$client_details','$pass_details')";
  if(mysqli_query($conn, $sql)){
    echo "<script type='text/javascript'>alert('Thank you for registering. Your records has been saved');
    location=' ../index.html';</script>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 }
// Close connection
mysqli_close($conn);
?>



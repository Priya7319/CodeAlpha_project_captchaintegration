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

  $mail_check = $_POST['mymail'];
  $pass_check= $_POST['mypass'];


if(isset($_POST['login'])) {
    $sql = mysqli_query($conn,
    "SELECT mailid,pin FROM captcha WHERE mailid='"
    . $_POST["mymail"] . "' AND
    pin='" . $_POST["mypass"] . "'    ");

    $num = mysqli_num_rows($sql);
   
    if($num > 0) {
        $row = mysqli_fetch_array($sql);
        echo "<script type='text/javascript'>alert('Hey You have successfully logged in.');
          location=' ../index.html';</script>";
        exit();
    }
    else {
      echo "<script type='text/javascript'>alert('Invalid mailid or password');
      location=' ../index.html';</script>";
    }
}
?>
    

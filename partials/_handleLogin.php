<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
  include '_dbconnect.php';
  $email = $_POST['loginEmail'];
  $password = $_POST['loginPass'];
  $sql = "SELECT * FROM `users` WHERE user_email='$email'";
  $result = mysqli_query($conn,$sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
    while($row=mysqli_fetch_assoc($result)){
      if(password_verify($password, $row['user_pass'])){
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['sno'] = $row['sno'];
        $_SESSION['useremail'] = $email;
        echo "logged in".$email;
      }
      header("Location: /forum/index.php");
    }
  }
  header("Location: /forum/index.php");
}
?>
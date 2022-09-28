<?php
  #Connect to department mysql server
  $db_conn=mysqli_connect()
  or die("Connection Error!".mysqli_connect_error());

  $email=$_POST['email'];
  $password=$_POST['password'];

  #check duplicated member or not
  $query="SELECT * FROM memberRecord WHERE memberEmail = '$email'";
  $result = mysqli_query($db_conn, $query)
    or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
  $row=mysqli_fetch_array($result);

  if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('User is not registered!');window.location.href='./login.html';</script>";
  } else if ($password != $row['memberPassword']){
    echo "<script>alert('Unauthorized access!');window.location.href='./login.html';</script>";
  } else {
    setcookie("login", true, time()+3600);
    setcookie("uid", $row['uid'], time()+3600);
    setcookie("name", $row['memberName'], time()+3600);
    header("Location: ./memberhome.php"); 
    die();
  }
?>
<?php
  #Connect to department mysql server
  $db_conn=mysqli_connect()
  or die("Connection Error!".mysqli_connect_error());

  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $confirmation=$_POST['confirmation']; 

  #find the number of existing user and assign uid
  $query="SELECT * FROM memberRecord";
  $result = mysqli_query($db_conn, $query)
    or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
  $uid="uid".(mysqli_num_rows($result)+1);

  #check duplicated member or not
  $query="SELECT * FROM memberRecord WHERE memberEmail = '$email'";
  $result = mysqli_query($db_conn, $query)
    or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
  if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Duplicated user email address!');window.location.href='./register.html';</script>";
  } else if ($password != $confirmation){
    echo "<script>alert('Please confirm your password again!');window.location.href='./register.html';</script>";
  } else {
    $query="INSERT INTO memberRecord (uid, memberName, memberEmail, memberPassword) VALUES ('$uid', '$name', '$email', '$password')";
    if (!mysqli_query($db_conn, $query)) {
      echo "<p>Error insert!!<br>".mysqli_error($db_conn)."</p>";
    } else{
      echo "<script>alert('You may log in to your account now!');window.location.href='./index.php';</script>";
    }
  }
?>
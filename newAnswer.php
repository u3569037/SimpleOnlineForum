<?php
  #Connect to department mysql server
  $db_conn=mysqli_connect()
    or die("Connection Error!".mysqli_connect_error());

  $content=$_POST['content'];

  #find the number of existing questions and assign qid
  $query="SELECT * FROM Answer";
  $result = mysqli_query($db_conn, $query)
    or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
  $aid="aid".(mysqli_num_rows($result)+1);

  #insert the question
  $qid = $_COOKIE['qid'];
  $uid = $_COOKIE['uid'];
  $uname = $_COOKIE['name'];
  $time = date('d-m-Y');
  $query="INSERT INTO Answer (aid, qid, content, uid, uname, time) VALUES ('$aid', '$qid', '$content', '$uid','$uname','$time')";
  if (!mysqli_query($db_conn, $query)) {
    echo "<p>Error insert!!<br>".mysqli_error($db_conn)."</p>";
  } else{
    header("Location: ./memberhome.php");
    die();
  }
?>
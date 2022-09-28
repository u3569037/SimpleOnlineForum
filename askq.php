<?php
  #Connect to department mysql server
  $db_conn=mysqli_connect()
    or die("Connection Error!".mysqli_connect_error());

  $title=$_POST['title'];
  $space=$_POST['space'];
  $content=$_POST['content'];

  #find the number of existing questions and assign qid
  $query="SELECT * FROM Question";
  $result = mysqli_query($db_conn, $query)
    or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
  $qid="qid".(mysqli_num_rows($result)+1);
  //check duplicated qid or not
  /*
  $query="SELECT * FROM Question WHERE qid = '$qid'";
  $result = mysqli_query($db_conn, $query)
    or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
  while (mysqli_num_rows($result) > 0){
    $qid++;
    $query="SELECT * FROM Question WHERE qid = '$qid'";
    $result = mysqli_query($db_conn, $query)
      or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
  }
  */

  #insert the question
  $creatorid = $_COOKIE['uid'];
  $creatorName = $_COOKIE['name'];
  $date = date('d-m-Y');
  $query="INSERT INTO Question (qid, space, title, content, answer, up, time, creatorid, creatorName) VALUES ('$qid', '$space', '$title', '$content','','', '$date', '$creatorid', '$creatorName')";
  if (!mysqli_query($db_conn, $query)) {
    echo "<p>Error insert!!<br>".mysqli_error($db_conn)."</p>";
  } else{
    header("Location: ./memberhome.php");
    die();
  }
?>
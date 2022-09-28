<?php
  #Connect to department mysql server
  $db_conn=mysqli_connect()
  or die("Connection Error!".mysqli_connect_error());

  #get data
  $query="SELECT * FROM Question";
  $result = mysqli_query($db_conn, $query)
    or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");

  #add the back home button
  if ($_COOKIE['login'] == 1){
    echo "<a href='./memberhome.php' style='text-decoration: none; padding:5px; font-size:15px; color:blue;'>Back to Home Page</a>";
  } else{
    echo "<a href='./index.php' style='text-decoration: none; padding:5px; font-size:15px; color:blue;'>Back to Home Page</a>";
  }
  #Display the records
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      if ($row['qid'] == $_COOKIE['qid']){
        #get data for the answers
        $query2="SELECT * FROM Answer WHERE qid = '".$row['qid']."'";
        $result2 = mysqli_query($db_conn, $query2)
          or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");
        $upvote = 0;
        $answer = 0;
        while ($row1 = mysqli_fetch_array($row['up'])){
          $upvote++;
        }
        while ($row2 = mysqli_fetch_array($row['answer'])){
          $answer++;
        }
        $space = $row['space'];
        echo "<div>";
        echo "<div class='questionBlk' id='".$row['qid']."'>";
        echo "<p style='border: solid blue 2px; padding: 3px;'>".$row['space']."</p>";

        //add the edit and delete button
        if ($_COOKIE['login'] == 1 && $row['creatorid'] == $_COOKIE['uid']){
          echo "<div style='display:block; float:right;'>";
          echo "<span style='color:blue; font-size:10px; padding:3px; margin-right:5px; cursor: pointer;' onclick='edit(event)' class='editBttn'>Edit</span>";
          echo "<span style='color:blue; font-size:10px; padding:3px; cursor: pointer;' onclick='delquestion(event)' class='delqBttn'>Delete</span>";
          echo "</div>";
        }

        //name and time of the post
        echo "<div style='display:block; float:left; margin:3px;'>";
        echo "<p style='padding:1px; background-color:lightblue; margin-right:3px; text-align:center;'> ".$row['creatorName']."</p>";
        echo "<p style='padding: 1px; color:grey; margin-right:3px;'> ".$row['time']."</p>";
        echo "</div>";

        //content and title
        echo "<div style='display:block; float:left;'>";
        echo "<h3 style='font-weight:bold;' class='title' onclick='showDetails(event)'> ".$row['title']."</h3>";
        echo "<p style='padding:3px;' class='content'> ".$row['content']."</p>";
        echo "<button class='upvote' onclick='upvote(event)'> Upvote(".$upvote.")</button>";
        echo "<button class='answer' onclick='showanswer(event)'> Answer(".mysqli_num_rows($result2).")</button>";
        echo "</div>";

        echo "</div>";

        //add the answer block
        if (mysqli_num_rows($result2) > 0) {
          while ($row2 = mysqli_fetch_array($result2)) {
            echo "<div class='answerBlk' style='display:block;' id='".$row2['aid']."'>";

            //author and posted time
            echo "<div style='display:block;'>";
            echo "<span style='font-weight:bold; font-size:15px; color:blue; padding:2px; margin-right:20px;'>".$row2['uname']."</span>";
            echo "<span style='font-size:10px; color:grey; padding:2px;'>answered on ".$row2['time']."</span>";
            //delete button
            if ($_COOKIE['login'] == 1 && $row2['uid'] == $_COOKIE['uid']){
              echo "<span style='color:blue; font-size:10px; padding:3px; cursor: pointer;' onclick='delanswer(event)' class='delaBttn'>Delete</span>";
            }
            echo "</div>";

            //content
            echo "<p style='padding:3px;' class='answercontent'> ".$row2['content']."</p>";

            echo "</div>";
          }
        }
        if ($_COOKIE['login'] == 1){
          echo "<div class='answerBlk' style='display:block;'>";
          echo "<p style='font-weight:bold; font-size:15px; color:blue; padding:2px;'>".$_COOKIE['name']."</p>";
          echo "<p style='font-weight:bold; font-size:15px; color:grey; padding:2px; cursor:pointer;' onclick='newAnswer(event)'>Post your new answer.</p>";
          echo "</div>";
        }
        echo "</div>";
      }
    }
  } 
?>
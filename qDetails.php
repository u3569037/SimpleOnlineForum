<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Banana Forum-Question Details</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="questionlist">
        <?php include('qDetails2.php') ?>
    </div>
    <script>
      //set the show more button
      var contents = document.getElementsByClassName("content");
      for (var i=0; i < contents.length; i++){
        if ((contents[i].offsetHeight-6)/16 >3){
          contents[i].setAttribute("style","overflow: hidden; height: 50px;");

          //add button
          var showBttn = document.createElement("button");
          showBttn.setAttribute("style","display:block; float:right; text-decoration:none; border: solid 2px grey; border-radius:5px; font-size:10px; background-color:white; padding:3px; box-shadow: 1px 1px 1px rgba(34, 35, 58, 0.2);");
          showBttn.setAttribute("class","showBttn");
          showBttn.innerHTML = "Show more";
          showBttn.setAttribute("onclick","showContent(event)");
          contents[i].parentNode.appendChild(showBttn);
        }
      }
      //click event of the show more button
      function showContent(event){
        if (event.target.parentElement.getElementsByClassName("content")[0].style.overflow == "hidden"){
          event.target.parentElement.getElementsByClassName("content")[0].setAttribute("style","overflow: auto; height: auto;")
          event.target.innerHTML = "Hide";
        }
        else{
          event.target.parentElement.getElementsByClassName("content")[0].setAttribute("style","overflow: hidden; height: 50px;")
          event.target.innerHTML = "Show more";
        }
      }

      //edit question
      function edit(event){
        
      }
      //delete question
      function delquestion(event){
        confirm("Are you sure you want to delete this question?");
        var qid = event.target.parentElement.parentElement.id;
        document.cookie = "qid="+qid;
        <?php
          //Connect to department mysql server
          $db_conn=mysqli_connect()
            or die("Connection Error!".mysqli_connect_error());

          $qid = $_COOKIE['qid'];

          $query="DELETE FROM Question WHERE qid = '$qid'";
          $result = mysqli_query($db_conn, $query)
            or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");

          //redirect to main page
          header("Location: ./memberhome.php"); 
        ?>
        document.cookie = "qid = null; expires=Thu, 12 Dec 1999 12:00:00 UTC";
      }
      function delanswer(event){
        confirm("Are you sure you want to delete this answer?");
        var aid = event.target.parentElement.parentElement.id;
        document.cookie = "aid="+aid;
        <?php
          //Connect to department mysql server
          $db_conn=mysqli_connect()
            or die("Connection Error!".mysqli_connect_error());

          $aid = $_COOKIE['aid'];

          $query="DELETE FROM Answer WHERE aid = '$aid'";
          $result = mysqli_query($db_conn, $query)
            or die("<p>Query Error!<br>".mysqli_error($db_conn)."</p>");

          //redirect to main page
          header("Location: ./memberhome.php"); 
        ?>
        document.cookie = "aid = null; expires=Thu, 12 Dec 1999 12:00:00 UTC";
      }
      //new answer to the question
      function newAnswer(event){
        var qid = event.target.parentElement.parentElement.firstChild.id;
        document.cookie = "qid="+qid;
        event.target.parentElement.innerHTML+="<form action='newAnswer.php' method='post'><textarea name='content' rows='3' cols='30' required>Type your answer here</textarea><input type='submit' value='Submit' style='margin-right:20px;'><button onclick='notAnswer(event)'>Cancel</button></form>";
        event.target.previousSibling.style.display = "none";
        event.target.style.display = "none";
      }
      function notAnswer(event){
        event.target.parentElement.parentElement.firstChild.style.display = "block";
        event.target.parentElement.previousSibling.style.display = "block";
        var form = event.target.parentElement.parentElement.querySelector("form");
        event.target.parentElement.parentElement.removeChild(form);
      }
    </script>
  </body>
</html>
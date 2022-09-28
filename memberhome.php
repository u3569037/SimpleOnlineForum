<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Banana Forum</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style>
      #leftbar{
        position: relative;
        float: left;
        width: auto;
        height: 100%;
      }
      .leftbarBttn{
        display: block;
        border-style: none;
        background-color: inherit;
        padding: 15px;
        color: black;
        font-weight: bold;
        text-decoration: none;
      }
      @media only screen and (max-width: 600px) {
        #leftbar{
          float: center;
          text-align: center;
          width: auto;
        }
        .leftbarBttn{
          margin:0 auto;
          display: inline-block;
          font-size: 8px;
          padding: 8px;
          float: center;
        }
      }
    </style>
    <script src="home.js"></script>
  </head>
  <body>
    <div id="topbar">
      <h2 id="logo" style="cursor: pointer;" onClick="location.href='memberhome.php'">Banana Forum</h2><br>
      <a id="home" class="topbarBttn" href="./memberhome.php">Home</a>
      <button id="hot" class="topbarBttn">Hot</button>
      <input type="text" id="searchbox" onkeyup="search()" placeholder="Search here ^_^">
      <button id="logout" class="topbarBttn" onClick="location.href='logout.php'">Logout</button>
    </div>
    <div id="leftbar">
        <button class="leftbarBttn" onclick="sort1()">Algorithm</button>
        <button class="leftbarBttn" onclick="sort2()">Machine Learning</button>
        <button class="leftbarBttn" onclick="sort3()">System</button>
        <button class="leftbarBttn" onclick="sort4()">Javascript</button>
    </div>
    <div id="askquestion" style="width:92%; text-align:right; background-color:white;">
        <a style="display:block; float:right; border:solid blue 2px; text-decoration:none; margin-top:5px; border-radius:5px; padding:5px;" href="./askq.html">Ask Question</a>
    </div>
    <div id="questionlist">
        <div id="head">
          <p style="color:blue; font-size:20px;">Hi <?php echo $_COOKIE['name']; ?> </p>
          <p style="color:grey; font-size:20px; cursor: pointer;"  onClick="location.href='./askq.html'">What is your question?</p>
        </div>
        <?php include('addquestion.php') ?>
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
          event.target.parentElement.getElementsByClassName("content")[0].setAttribute("style","overflow: auto; height: auto;");
          event.target.innerHTML = "Hide";
        }
        else{
          event.target.parentElement.getElementsByClassName("content")[0].setAttribute("style","overflow: hidden; height: 50px;");
          event.target.innerHTML = "Show more";
        }
      }
      //sort the questions by date by reversing the order of blocks
      qlist = document.getElementById("questionlist");
      for (var i = 2; i < qlist.childNodes.length; i++){
        qlist.insertBefore(qlist.childNodes[i], qlist.childNodes[1]);
      }
      qlist.insertBefore(document.getElementById("head"), qlist.childNodes[1]);

      //edit question
      function edit(event){
        var text = "<form action='editq.php' method='post'><p><label for='title' style='font-weight:bold;'>Title:</label><br><textarea id='title' name='title' rows='1' cols='40' required>"+event.target.parentElement.parentElement.getElementsByClassName("title")[0].innerText+"</textarea></p><p><label for='space' style='font-weight:bold;'>Space:</label><br><input type='radio' name='space' value='Algorithm' required>Algorithm<input type='radio' name='space' value='Machine Learning' required>Machine Learning<input type='radio' name='space' value='System' required>System<input type='radio' name='space' value='Javascript' required>Javascript</p><p><label for='content' style='font-weight:bold;'>Content:</label><br><textarea id='content' name='content' rows='4' cols='40' required>"+event.target.parentElement.parentElement.getElementsByClassName("title")[0].nextElementSibling.innerText+"</textarea></p><input type='submit' id='submitBttn' value='Submit'></form>";
        event.target.parentElement.innerHTML += text;
        var qid = event.target.parentElement.parentElement.id;
        document.cookie = "qid="+qid;
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
      //show the answer
      function showanswer(event){
        var qid = event.target.parentElement.parentElement.id;
        var answerBlks = document.getElementsByClassName("answerBlk");
        for (var i=0; i < answerBlks.length; i++){
          if (answerBlks[i].parentElement.firstChild.id == qid){
            if (answerBlks[i].style.display == "none"){
              answerBlks[i].style.display = "block";
            } else{
              answerBlks[i].style.display = "none";
            }
          } else{
            answerBlks[i].style.display = "none";
          }
        }
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
      //direct to question details page
      function showDetails(event){
        var qid = event.target.parentElement.parentElement.id;
        document.cookie = "qid="+qid;
        window.location.href = "./qDetails.php";
      }
    </script>
  </body>
</html>
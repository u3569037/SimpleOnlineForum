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
      <h2 id="logo" style="cursor: pointer;" onClick="location.href='index.php'">Banana Forum</h2><br>
      <a id="home" class="topbarBttn" href="./index.php">Home</a>
      <button id="hot" class="topbarBttn">Hot</button>
      <input type="text" id="searchbox" onkeyup="search()" placeholder="Search here ^_^">
      <a id="login" class="topbarBttn" href="./login.html" style="display: inline-block;">Log in</a>
      <a id="register" class="topbarBttn" href="./register.html" style="display: inline-block;">Register</a>
    </div>
    <div id="leftbar">
        <button class="leftbarBttn" onclick="sort1()">Algorithm</button>
        <button class="leftbarBttn" onclick="sort2()">Machine Learning</button>
        <button class="leftbarBttn" onclick="sort3()">System</button>
        <button class="leftbarBttn" onclick="sort4()">Javascript</button>
    </div>
    <div id="questionlist">
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
        else {
          event.target.parentElement.getElementsByClassName("content")[0].setAttribute("style","overflow: hidden; height: 50px;");
          event.target.innerHTML = "Show more";
        }
      }
      //sort the questions by date by reversing the order of blocks
      qlist = document.getElementById("questionlist");
      for (var i = 2; i < qlist.childNodes.length; i++){
        qlist.insertBefore(qlist.childNodes[i], qlist.childNodes[1]);
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
      //direct to question details page
      function showDetails(event){
        var qid = event.target.parentElement.parentElement.id;
        document.cookie = "qid="+qid;
        window.location.href = "./qDetails.php";
      }
    </script>
  </body>
</html>
//set the left bar button one by one
function sort1(){
  var temp = document.getElementsByClassName("questionBlk");
    for (var i=0; i<temp.length; i++){
      if (temp[i].firstChild.innerHTML != "Algorithm"){
        temp[i].setAttribute("style","display:none;");
      } else{
        temp[i].setAttribute("style","display:block;");
      }
    }
}

function sort2(){
  var temp = document.getElementsByClassName("questionBlk");
    for (var i=0; i<temp.length; i++){
      if (temp[i].firstChild.innerHTML != "Machine Learning"){
        temp[i].setAttribute("style","display:none;");
      } else{
        temp[i].setAttribute("style","display:block;");
      }
    }
}
function sort3(){
  var temp = document.getElementsByClassName("questionBlk");
    for (var i=0; i<temp.length; i++){
      if (temp[i].firstChild.innerHTML != "System"){
        temp[i].setAttribute("style","display:none;");
      } else{
        temp[i].setAttribute("style","display:block;");
      }
    }
}
function sort4(){
  var temp = document.getElementsByClassName("questionBlk");
    for (var i=0; i<temp.length; i++){
      if (temp[i].firstChild.innerHTML != "Javascript"){
        temp[i].setAttribute("style","display:none;");
      } else{
        temp[i].setAttribute("style","display:block;");
      }
    }
}

//searchbox
function search(){
  var text = document.getElementById('searchbox').value.toUpperCase(); 
  var temp = document.getElementsByClassName("questionBlk");
  for (var i=0; i<temp.length; i++){
      if (temp[i].querySelector(".title").innerHTML.toUpperCase().indexOf(text) == -1){
        temp[i].setAttribute("style","display:none;");
      } else{
        temp[i].setAttribute("style","display:block;");
      }
    }
}

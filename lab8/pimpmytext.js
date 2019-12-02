"use strict";

function pageLoad(){
    var text = $("txtarea");
    $("pimpinButton").onclick = biggerPimpin;
    $("box").onchange = blingCheck;
    $("snoopifyButton").onclick = snoopify;
    $("pigLatinButton").onclick = makePigLatin;
    $("malkovitchButton").onclick = makeMalkovitch;
}
var fsize = "12px";
function biggerPimpin(){
    if(fsize == "12px"){
        setInterval(timer, 500);
    }
}

function timer(){
  $("txtarea").style.fontSize = parseInt(fsize) + 2 + "px";
  fsize = parseInt(fsize) + 2 + "px";
  console.log(fsize);
}

function blingCheck(){
  var cb = document.getElementById("box");
  var text = $("txtarea");
  var body = document.getElementsByTagName('body')[0];

  if(cb.checked === true){
    text.style.fontWeight = "bold";
    text.style.color = "green";
    text.style.textDecoration = "underline";
    body.style.backgroundImage = "url(https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg)";
  }else{
    text.style.fontWeight = "normal";
    text.style.color = "black";
    text.style.textDecoration = "none";
    body.style.backgroundImage = "none";
  }
}

function snoopify(){
    var text = $("txtarea");
    var splitText = text.value.split("."); // .기준으로 잘라서 배열에 삽입
    text.value = splitText.join("-izzle"); // 배열 요소요소마다 -izzle 붙여서 출력
}

function makePigLatin(){
    var text = $("txtarea");
    //var splitText = text.value.split(/[\n]+/);
    var splitText = text.value.split(/\s/);
    splitText.forEach(function(item, index){ // 배열 foreach 하는 방법
      splitText[index] = checkWord(item, 0);
    });
    text.value = splitText.join(" ");
}


function checkWord(word, index){
      if(index > word.length){
        return word;
      }

      if(word[0] == 'a' || word[0] == 'e' || word[0] == 'o' || word[0] == 'i' || word[0] == 'u'){
        return word + "ay";
      }else{
        return checkWord(word.slice(1, word.length) + word[0], index+1);
      }

}

function makeMalkovitch(){
    var text = document.getElementById("txtarea");
    var slice = /\w{5,}/g; // g는 모든 패턴 검색. 지정하지 않으면 패턴 하나 찾고 끝낸다

    text.value = text.value.replace(slice, "Malkovitch");
}

window.onload = pageLoad;

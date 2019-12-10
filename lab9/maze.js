"use strict";

var loser = null;  // whether the user has hit a wall
var gameStart = false;
window.onload = function() {
    // var boundary = $$('.boundary');
    // boundary.observe("mouseover", overBoundary);

    // $$('.boundary').each(function(this) {
    //     this.observe("mouseover", overBoundary);
    // });

    $$("#maze .boundary").invoke('observe', "mouseover", overBoundary);
    $("end").observe("mouseover", overEnd);
    $("start").observe("mouseover", function() {
        gameStart = true;
    });
    // $("maze").observe("mouseleave", overBody);
    $("maze").onmouseleave = overBody;
    $("start").observe("click", startClick);

    // div#maze div.boundary 도 가능
};

// called when mouse enters the walls;
// signals the end of the game with a loss
function overBoundary(event) {
    var boundary = $$("div#maze div.boundary");

    if(loser !== true){
        (function() {
            var p = $("status");
            p.innerHTML = "You lose! :(";
            for (var i = 0; i < boundary.length; i++) {
                boundary[i].addClassName("youlose");
            }
            loser = false;
        }());
    }


      //  this.addClassName("youlose");

}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
  loser = null;
  var boundary = $$("div#maze div.boundary");
  for (var i = 0; i < boundary.length; i++) {
      boundary[i].removeClassName("youlose");
  }

}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
    if(gameStart && loser !== false){
        loser = true;
        $("status").innerHTML = "You win! :)";
    }
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
  //loser = false;

       overBoundary();

}

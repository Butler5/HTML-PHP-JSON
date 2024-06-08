var puzzle = [];
var backPiece = [];


window.onload = function() {
    puzzle =  $$("#puzzlearea div");
    var row = 0, right = 0, top = 0;

  for (var i=0;i<puzzle.length;i++){
        puzzle[i].addClassName("puzzlepiece");
        puzzle[i].style.float = "left";
       puzzle[i].style.backgroundSize = "400px 400px";
       
       backPiece[i] = [];
       backPiece[i][0] = right;
       backPiece[i][1] = top;

       puzzle[i].style.backgroundPosition = "-"+backPiece[i][0]+"px -"+backPiece[i][1]+"px";
       row ++;
       if (row === 4){top += 100; right = 0; row = 0; } else {right +=100;}
    }

  var freemove = document.createElement("div");
   $("puzzlearea").appendChild(freemove);  
   blankP(freemove);


   puzzle = $$("#puzzlearea div"); 
   $("shufflebutton").observe('click', shufflePuzzle);
   movepiece();
};

var blankP = function(el){
  el.removeClassName("movablepiece");
  el.addClassName("puzzlepiece");
  el.style.float = "left";
  el.style.backgroundImage = "none";
  el.style.border = "2px solid white";
};

var background_Position = function(piece , item){
  piece.style.backgroundPosition = "-"+backPiece[item-1][0]+"px -"+backPiece[item-1][1]+"px";
};

var regularP = function(p){
      p.addClassName("puzzlepiece");
      p.style.border = "2px solid black";
      p.style.backgroundImage = "url(background.jpg)";
      p.style.backgroundSize = "400px 400px";
};

function shufflePuzzle(){
	var numArray = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
	for (var i=puzzle.length; i>0; i){
		var j = Math.floor(Math.random() * i);
		var x = numArray[--i];
		var test = numArray[j];
		if(test == "0") { 
			puzzle[i].addClassName("puzzlepiece");
	 		blankP(puzzle[i]);
	 		puzzle[i].innerHTML = "";
					}
		else{
     			puzzle[i].innerHTML = numArray[j];
      			regularP(puzzle[i]);
      			background_Position(puzzle[i], test);
          }
			numArray[j] = x;
    }
  	mopiece();
   }

var movePA = function(piece){
  puzzle[piece].addClassName("movablepiece");
};

var movepiece = function(){
    var move = this.innerHTML;
    var yon = this.hasClassName('movablepiece');
    var blank = 0;
    if (yon){
      	for (var i=0;i<puzzle.length;i++){
        	blank = puzzle[i].innerHTML;
         	if (puzzle[i].innerHTML == ""){
          		puzzle[i].innerHTML = move;
          		this.innerHTML = blank;

          		regularP(puzzle[i]);
          		blankP(this);

        		 mopiece();
        		 background_Position(puzzle[i], move);
      }    
     } 
   }
         };

var mopiece = function(){
	for (var i=0;i<puzzle.length;i++){
		puzzle[i].removeClassName("movablepiece");	}
		  for (var i=0; i<puzzle.length; i++){
  			if (puzzle[i].innerHTML == ""){         
 				  puzzle[i].removeClassName("movablepiece");

  				switch(i){
  					case 0:
  						movePA(i+1);
  						movePA(i+4);
              					break;
  					case 1:
  					case 2:
  						movePA(i-1);
  						movePA(i+1);
        					movePA(i+4);
  						break;
  					case 3:
  						movePA(i-1);
  						movePA(i+4);
  						break;
  					case 4:
  						movePA(i-4);
  						movePA(i+4);
  						movePA(i+1);
  						break;
  					case 5:
  					case 6:
  					case 9:
  					case 10:
  						movePA(i-4);
  						movePA(i+4);
  						movePA(i+1);
  						movePA(i-1);
              					break;
  					case 7: 
  					case 11:
  						movePA(i-4);
  						movePA(i+4);
  						movePA(i-1);
              					break;
  					case 8:
  						movePA(i-4);
  						movePA(i+1);
  						movePA(i+4);
  						break;
  					case 12:
  						movePA(i-4);
  						movePA(i+1);
  						break;
  					case 13: 
  					case 14:
  						movePA(i-4);
  						movePA(i-1);
  						movePA(i+1);
  						break;
  					case 15:
  						movePA(i-4);
  						movePA(i-1);
  						break;
  					}       	
  		}
      			puzzle[i].observe('click', movepiece); }  
  	}	;
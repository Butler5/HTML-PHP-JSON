"use strict";

(function() {

	var URL = "https://webhome.auburn.edu/~abb0025/cpsc5210_module7/dogbreeds.php"; 
	var CHOSEN_BREED = "";

	function getList() {
		var ajax = new XMLHttpRequest();
		ajax.onload = processList;
		var listUrl = URL + "?type=list";
		ajax.open("GET", listUrl, true);
		ajax.send();
		
		function processList() {
			if (this.status == 200) {
				var response = this.responseText;
				var responseArray = response.split("\n");
				
				for (var i = 0; i < responseArray.length; i++) {
					var newOption = document.createElement("option");
					newOption.value = responseArray[i];
					newOption.innerHTML = responseArray[i];
					document.getElementById("allnames").appendChild(newOption);
				}
				document.getElementById("allnames").removeAttribute("disabled");
			} else {
				handleError(this.status);
			}
			document.getElementById("loadingnames").style.display = "none"; 
		}
	}
	
	function getMeaning() {
		var ajax = new XMLHttpRequest();
		ajax.onload = processMeaning;
		CHOSEN_BREED = document.getElementById("allnames").value;
		var listUrl = URL + "?type=meaning&name=" + CHOSEN_BREED + "";
		ajax.open("GET", listUrl, true);
		ajax.send();
		
		function processMeaning() {
			if (this.status == 200) {
				var meaning = document.getElementById("meaning");
				meaning.innerHTML = this.responseText; 
				document.getElementById("loadingmeaning").style.display = "none"; 
			} else {
				handleError(this.status); 
			}
		}
	}


	function handleError(e) {
		document.getElementById("errors").innerHTML = "Sorry, error " + e + " has occurred";
		document.getElementsByClassName("loading").style.display = "none";
	}
	
	function searchClicked() {
		if (document.getElementById("allnames").value) { 

			document.getElementById("resultsarea").style.display = "inline";
			document.getElementById("loadingmeaning").style.display = "inline";
			document.getElementById("loadinggraph").style.display = "inline";
			document.getElementById("loadingcelebs").style.display = "inline";
			document.getElementById("meaning").innerHTML = "";
			document.getElementById("graph").innerHTML = "";
			document.getElementById("celebs").innerHTML = "";
			document.getElementById("errors").innerHTML = "";
			document.getElementById("norankdata").style.display = "none";
			
			getMeaning();
			getRank();
			getCelebs();
		}
	}
	
	window.onload = function() {
		getList(); 
		document.getElementById("search").onclick = searchClicked;
	};
})();
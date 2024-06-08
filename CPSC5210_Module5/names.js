"use strict";

(function() {

	var URL = "https://webhome.auburn.edu/~tzt0062/babynames/babynames.php"; 
	var CHOSEN_NAME = "";
	var GENDER;

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
		CHOSEN_NAME = document.getElementById("allnames").value;
		var listUrl = URL + "?type=meaning&name=" + CHOSEN_NAME + "";
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
	
	
	function getRank() {
		var ajax = new XMLHttpRequest();
		ajax.onload = processRank;
		var genders = document.getElementsByName("gender");
		for (var i = 0; i < genders.length; i++) {
			if (genders[i].checked) {
				GENDER = genders[i].value; 
			}
		}
		var listUrl = URL + "?type=rank&name=" + CHOSEN_NAME + "&gender=" + GENDER + "";
		ajax.open("GET", listUrl, true);
		ajax.send();
		
		function processRank() {
			if (this.status == 200) {
				var rankings = this.responseXML.getElementsByTagName("rank");
				var graph = document.getElementById("graph");

				var dataRow = document.createElement("tr");
				var yearRow = document.createElement("tr");
				for (var i = 0; i < rankings.length; i++) {

					var yearCell = document.createElement("th");
					yearCell.innerHTML = rankings[i].getAttribute("year");
					yearRow.appendChild(yearCell);


					var popularCell = document.createElement("td");
					var popularInnerCell = document.createElement("div");
					
					var rank = rankings[i].innerHTML;
					if (rank > 0 && rank <= 999) {
						popularInnerCell.style.height = parseInt((1/4) * (1000 - rank)) + "px";
					} else {
						rank = 0;
						popularInnerCell.style.height = 0 + "px";
					}
					if (rank > 0 && rank <= 10) {
						popularInnerCell.className = popularInnerCell.className + " topten";
					}
					popularInnerCell.innerHTML = rank;
					popularCell.appendChild(popularInnerCell);
					dataRow.appendChild(popularCell);
				}

				graph.appendChild(yearRow);
				graph.appendChild(dataRow);
				document.getElementById("loadinggraph").style.display = "none"; // hides loading
			} else if (this.status == 410) { 
				document.getElementById("graph").innerHTML = "";
				document.getElementById("norankdata").style.display = "inline";
				document.getElementById("loadinggraph").style.display = "none";
			} else {
				handleError(this.status); 
			}
		}
	}
	
	function getCelebs() {
		var ajax = new XMLHttpRequest();
		ajax.onload = processCelebs;
		var listUrl = URL + "?type=celebs&name=" + CHOSEN_NAME + "&gender=" + GENDER + "";
		ajax.open("GET", listUrl, true);
		ajax.send();
		
		function processCelebs() {
			if (this.status == 200) {
				var json = JSON.parse(this.responseText);
				var list = document.getElementById("celebs");
				for (var i = 0; i < json.actors.length; i++) {
					var first = json.actors[i].firstName;
					var last = json.actors[i].lastName;
					var films = json.actors[i].filmCount;
					var item = document.createElement("li");
					item.innerHTML = "" + first + " " + last + " (" + films + " films)";
					list.appendChild(item); 
				}
				document.getElementById("loadingcelebs").style.display = "none"; 
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
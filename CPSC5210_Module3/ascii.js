"use strict";

(function () {

	var timer;
	var initialAscii;

	function startAscii() {
		
		document.getElementById("start").disabled = true;
		document.getElementById("stop").disabled = false;

		var textarea = document.getElementById("asciiarea");
		initialAscii = textarea.value; 
		var allFrames = textarea.value.split("=====\n");
		var frameSpeed;
		var count = 0;
		var userSpeed = document.getElementsByName("speed");
		var speeds = userSpeed.length;
		for (var i = 0; i < speeds; i++) {
			if (userSpeed[i].checked) {
				frameSpeed = userSpeed[i].value;
			}
		}
		timer = setInterval(updateAscii, frameSpeed);

		function updateAscii() {
			for (var i = 0; i < speeds; i++) {
				if (userSpeed[i].checked && frameSpeed != userSpeed[i].value) {
					frameSpeed = userSpeed[i].value;
					clearInterval(timer);
					timer = setInterval(updateAscii, frameSpeed);
				}
			}
			textarea.value = allFrames[count];
			count++;
			if (count > allFrames.length - 1) {
				count = 0;
			}
		}
	}

	function stopAscii() {
		document.getElementById("start").disabled = false;
		document.getElementById("stop").disabled = true;
		clearInterval(timer);
		document.getElementById("asciiarea").value = initialAscii;
	}

	function drawAscii() {
		var animation = document.getElementById("animation");
		var animationChoice = animation.options[animation.selectedIndex].innerHTML;
		document.getElementById("asciiarea").value = ANIMATIONS[animationChoice];
	}

	function sizeChange() {
		var size = document.getElementById("size");
		var newSize = size.options[size.selectedIndex].value;
		document.getElementById("asciiarea").style.fontSize = newSize + "pt";
	}

	window.onload = function() {
		var start = document.getElementById("start");
		start.onclick = startAscii;

		var stop = document.getElementById("stop");
		stop.onclick = stopAscii;
		stop.disabled = true;

		var animation = document.getElementById("animation");
		animation.onchange = drawAscii;

		var size = document.getElementById("size");
		size.onchange = sizeChange;
	}
})();
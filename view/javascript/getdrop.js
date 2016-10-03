function start() {
	window.setTimeout(getDrop, 1000);
}

function getDrop() {
	"use strict";
	var mydrop = document.getElementById("drop").innerHTML;
	console.log(mydrop);
	//$.post("bug.php", {drop: mydrop});
	document.getElementById("hiddenfield").value = mydrop;
}
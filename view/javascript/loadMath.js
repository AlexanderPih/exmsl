function loadMath() {
	window.setTimeout(typeSet, 1000);
}

function typeSet() {
	var script = document.createElement("script");
script.type = "text/javascript";
//script.src = "../MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML";
script.src = "https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML";
document.getElementsByTagName("head")[0].appendChild(script);
}
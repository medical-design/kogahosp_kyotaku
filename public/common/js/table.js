var chartTable = document.querySelector("table#chart"),
	chartWrapper = chartTable.parentElement,
	chartWidth = chartTable.offsetWidth,
	chartHeight = chartTable.offsetHeight;

function sizeChart() {
	chartWrapper.style.height = chartWrapper.offsetHeight + "px";
	chartWrapper.style.maxWidth = "";

	chartTable.style.display = "none";
	var maxWidth = chartWrapper.offsetWidth;
	chartWrapper.style.maxWidth = maxWidth + "px";
	chartWrapper.style.height = "";

	chartWrapper.style.overflowX = chartWidth > maxWidth ? "auto" : "visible";
	chartTable.style.display = "table";

	var viewportHeight = Math.max(document.documentElement.clientHeight, window.innerHeight),
		firstRowOffset = chartTable.querySelector("td:first-child").getBoundingClientRect().top || 0;

	var maxHeight;
	if (firstRowOffset > viewportHeight) {
		maxHeight = "";
	} else if (firstRowOffset < 0) {
		maxHeight = viewportHeight + "px";
	} else {
		maxHeight = Math.max(viewportHeight - firstRowOffset, 150) + "px";
	}
	// chartWrapper.style.maxHeight = maxHeight;
	chartWrapper.style.overflowY = chartHeight > parseInt(maxHeight) ? "auto" : "visible";
}

function throttle(func, delay) {
	var lastTime = 0;
	return function () {
		var currentTime = new Date().getTime();
		if (currentTime - lastTime < delay) {
			return;
		}
		lastTime = currentTime;
		func.apply(this, arguments);
	};
}

window.addEventListener("load", sizeChart);
window.addEventListener("resize", throttle(sizeChart, 1000));
window.addEventListener("scroll", throttle(sizeChart, 1000));

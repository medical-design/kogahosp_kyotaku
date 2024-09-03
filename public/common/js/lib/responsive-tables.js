// console.log(mdlib.SP_WIDTH);
var responsive_table_change_width = 1100;

document.addEventListener("DOMContentLoaded", function () {
	var switched = false;

	function updateTables() {
		var width = window.innerWidth;

		if (width <= responsive_table_change_width && !switched) {
			switched = true;
			var is_init = false;
			var tables = document.querySelectorAll("table.responsive");

			tables.forEach(function (table) {
				if (table.closest(".table-wrapper") === null) {
					splitTable(table);
					is_init = true;
				}
			});

			if (is_init) {
				var responsiveTables = document.querySelectorAll(".responsive");
				responsiveTables.forEach(function (responsiveTable) {
					responsiveTable.style.display = "block";
				});
				window.dispatchEvent(new Event("init_responsive_tables"));
			}

			return true;
		} else if (switched && width > responsive_table_change_width) {
			switched = false;
			var responsiveTables = document.querySelectorAll("table.responsive");

			responsiveTables.forEach(function (responsiveTable) {
				if (responsiveTable.closest(".responsive_table_area-pc") === null) {
					unsplitTable(responsiveTable);
				}
			});
		} else {
			var is_init = false;
			var responsiveTables = document.querySelectorAll(".responsive_table_area-pc table.responsive");

			responsiveTables.forEach(function (responsiveTable) {
				if (responsiveTable.closest(".table-wrapper") === null) {
					splitTable(responsiveTable);
					is_init = true;
				}
			});

			if (is_init) {
				var responsiveTables = document.querySelectorAll(".responsive");
				responsiveTables.forEach(function (responsiveTable) {
					responsiveTable.style.display = "block";
				});
				window.dispatchEvent(new Event("init_responsive_tables"));
			}

			return true;
		}
	}

	function splitTable(original) {
		// console.log('splitTable');
		var wrapper = document.createElement("div");
		wrapper.classList.add("table-wrapper");
		original.parentNode.insertBefore(wrapper, original);
		wrapper.appendChild(original);
		var scrollableDiv = document.createElement("div");
		scrollableDiv.classList.add("scrollable");
		original.parentNode.insertBefore(scrollableDiv, original);
		scrollableDiv.appendChild(original);
	}

	function unsplitTable(original) {
		var wrapper = original.closest(".table-wrapper");
		var pinnedDiv = wrapper.querySelector(".pinned");
		wrapper.removeChild(pinnedDiv);
		wrapper.parentNode.insertBefore(original, wrapper);
		wrapper.parentNode.removeChild(wrapper);
	}

	// responsive table 対応
	function setResponsiveTableMask() {
		var tables = document.querySelectorAll("table.responsive");
		var eventtype = mdlib.ua.Mobile ? "touchstart" : "click";

		tables.forEach(function (table) {
			var area = table.closest(".responsive_table_area");

			if (area === null) {
				var classname = "responsive_table_area";
				if (table.classList.contains("responsive-all")) {
					classname += " responsive_table_area-all";
				}

				if (table.closest(".table-wrapper") !== null) {
					table = table.closest(".table-wrapper");
				}

				var wrapper = document.createElement("div");
				wrapper.classList.add(classname);
				table.parentNode.insertBefore(wrapper, table);
				wrapper.appendChild(table);
				area = wrapper;
			} else {
				if (table.classList.contains("responsive-all")) {
					area.classList.add("responsive_table_area-all");
				}
			}

			if (table.classList.contains("_pc")) {
				area.classList.add("responsive_table_area-pc");
			}

			area = table.closest(".responsive_table_area");
			var mask = area.querySelector(".responsive_table_mask");
			var shadowMask = area.querySelector(".responsive_table_mask.shadow");

			if (!mask && !shadowMask) {
				area.insertAdjacentHTML("afterbegin", '<div class="responsive_table_mask"></div><div class="responsive_table_mask shadow"></div>');
				area.addEventListener(eventtype, function (e) {
					var shadowMask = area.querySelector(".responsive_table_mask.shadow");
					if (shadowMask.style.display !== "none") {
						shadowMask.style.display = "none";
						setTimeout(function () {
							shadowMask.remove();
						}, 1000);
					}
				});
			}
		});
	}

	window.addEventListener("redraw", function () {
		switched = false;
		updateTables();
	});

	window.addEventListener("resize", updateTables);

	window.addEventListener("start_sp", function () {
		setResponsiveTableMask();
		window.dispatchEvent(new Event("redraw"));
	});

	window.addEventListener("change_to_sp", function () {
		setResponsiveTableMask();
		window.dispatchEvent(new Event("redraw"));
	});

	var responsiveTableAreasPC = document.querySelectorAll(".responsive_table_area-pc, .responsive._pc");
	if (responsiveTableAreasPC.length) {
		setResponsiveTableMask();
		window.dispatchEvent(new Event("redraw"));
	}
});

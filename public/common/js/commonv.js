/* eslint-disable */
IS_DEBUG = 0;
IS_DRAWER_DEBUG = 0;
IS_GNAV_DEBUG = 0;
WELFARE_MODAL_DEBUG = 0;

function setCookie({ name, value, days, path = "/", domain }) {
	let expires = "";
	let cookie = `${name}=${value || ""}${expires}; path=${path}`;
	if (days) {
		const date = new Date();
		date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
		expires = `; expires=${date.toUTCString()}`;
	}
	if (domain) {
		cookie += `; domain=${domain}`;
	}
	document.cookie = cookie;
}
function getCookie(name) {
	const nameEQ = `${name}=`;
	const ca = document.cookie.split(";");
	for (let i = 0; i < ca.length; i += 1) {
		let c = ca[i];
		while (c.charAt(0) === " ") c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

document.addEventListener("DOMContentLoaded", function () {
	var isIndex = false;
	mdlib2.SmoothAnchor(["js-no_scroll", "js-open_menu_panel", "js-tab_click", "js-scroll_schedule_link"], true, true);

	if (document.querySelector(".root-index")) {
		isIndex = true;
		mdlib2.IndexReady();
	}

	// mdlib2.OpenMenuPanel();
	popuri.Ready();
	popuri.mmenu();
	popuri.headerSearchToggle();
	//popuri.showGnavSearchArea();
	popuri.readyAnimation();
	popuri.scrollToggle();

	if (document.querySelector(".select_frame")) mdlib2.selectFrame();
	if (document.querySelector(".js-select_scroll_to")) mdlib2.selectScroll();
	if (document.querySelector(".js-slider")) mdlib2.swiper();
	if (document.querySelector(".js-to_top_scroll")) mdlib2.toTopScroll();

	if (document.querySelector(".js-tab_click")) popuri.SetTabChange((selector = ".js-tab_click"));
	if (document.getElementById("js-ticker_area")) popuri.ticker(mdlib2);
	if (document.getElementById("js-iflow_bg")) popuri.iflowHover();

	// if (document.querySelector(".mw_wp_form")) popuri.mwwpform();

	if ($(".mb_YTPlayer").length > 0) {
		popuri.yt_player(mdlib2);
	}

	window.onload = function () {
		if (isIndex) {
		}
		mdlib2.SmoothAnchorOnLoad();
		popuri.ScrollTriger(isIndex);
		//  popuri.ModalSetup();
		//  popuri.SwiperTab();

		if (IS_GNAV_DEBUG) {
			document.querySelectorAll(".js-open_gnav_sub").forEach(function (item, i) {
				if (i === 2) {
					trigger(item, "mouseenter");
				}
			});
		}
	};
});

var mdlib2 = new (function () {
	// this.TB_WIDTH = 949;
	this.TB_WIDTH = 999;
	this.SP_WIDTH = 999;

	// アンカースムーズスクロール
	this.SmoothAnchor = function (notClassList) {
		if (!notClassList) {
			notClassList = [];
		}
		// https://sterfield.co.jp/designer/%E3%83%9A%E3%83%BC%E3%82%B8%E3%83%AA%E3%83%B3%E3%82%AF%E4%BB%98%E3%81%8D%E3%81%AE%E3%82%A2%E3%83%B3%E3%82%AB%E3%83%BC%E3%83%AA%E3%83%B3%E3%82%AF%E3%81%AB%E5%AF%BE%E5%BF%9C%E3%81%97%E3%81%9Fjquery/
		var aElementList = document.querySelectorAll('a[href^="#"], area[href*="#"]');

		var body = getScrollableElement();
		var duration = 0.4;
		var easing = "expo.out";

		aElementListLoop: for (var i = 0; i < aElementList.length; i++) {
			// 除外対象か検査
			for (var ii = 0; ii < notClassList.length; ii++) {
				if (notClassList[ii] && aElementList[i].classList.contains(notClassList[ii])) {
					continue aElementListLoop;
				}
			}

			aElementList[i].addEventListener("click", function (e) {
				e.preventDefault();

				// リンク先を絶対パスとして取得
				var href = this.getAttribute("href");

				// リンク先を絶対パスについて、#より前のURLを取得
				var hrefPageUrl = href.split("#")[0];

				// 現在のページの絶対パスを取得
				var currentUrl = location.href;

				// 現在のページの絶対パスについて、#より前のURLを取得
				var currentUrl = currentUrl.split("#")[0];

				// #より前の絶対パスが、リンク先と現在のページで同じだったらスムーススクロールを実行
				if (hrefPageUrl.slice(-1) === "/") {
					hrefPageUrl = hrefPageUrl.slice(0, -1);
				}
				if (currentUrl.slice(-1) === "/") {
					currentUrl = currentUrl.slice(0, -1);
				}

				if (hrefPageUrl === "" || hrefPageUrl == currentUrl) {
					//リンク先の#からあとの値を取得
					href = href.split("#");
					href = href.pop();
					href = "#" + href;

					//スムースクロールの実装
					var target = document.querySelector(href == "#" || href == "" ? "html" : href);
					var position = 0;

					if (target) {
						var header = document.querySelector(".header");
						var offset = header ? header.offsetHeight : 0;

						position = getOffsetTop(target) - offset;
					} else {
						if (href === "#top") {
							position = 0;
						} else {
							return false;
						}
					}

					gsap.to(body, {
						scrollTop: position,
						duration: duration,
						ease: easing,
					});
					return false;
				}
			});
		}
	};

	this.SmoothAnchorOnLoad = function () {
		var body = getScrollableElement();
		var duration = 0.15;
		var easing = "expo.out";

		// ハッシュある場合のスクロール
		if (window.location.hash && window.location.hash.match(/^#\w/)) {
			var hashTarget = document.querySelector(window.location.hash);
			if (hashTarget) {
				var header = document.querySelector("#header");
				var headerOffset = header ? header.offsetHeight + 10 : 0;

				var pageScrollTop = getScrollableElement().scrollTop;
				var targetOffset = getOffsetTop(hashTarget) - headerOffset;

				if (Math.round(targetOffset) !== pageScrollTop) {
					gsap.to(body, {
						scrollTop: targetOffset,
						duration: duration,
						ease: easing,
					});
				}
			}
		}
	};

	this.IndexReady = function () {
		var hero_area = document.getElementById("hero_area");
		if (hero_area) {
			imagesLoaded(document.getElementById("hero_area"), { background: true }, function (e) {
				var targetList = document.querySelectorAll(".hero_area, .header");
				document.querySelector(".hero_area").classList.remove("hero_area-init");
				window.setTimeout(function () {
					document.querySelector(".hero_area").classList.add("hero_area-inited");
					document.querySelector(".imain_content").classList.add("imain_content-inited");
				}, 100);
			});
		}
	};

	this.swiper = function () {
		document.querySelectorAll(".js-slider").forEach(function (swiperElement, i) {
			var options = {
				speed: 500,
				autoplay: 0,
				loop: false,
				autoHeight: true,
				effect: "slide",

				// 中央寄せ
				centeredSlides: false,
				slidesPerView: "auto",
				// spaceBetween: 0,

				// 初期位置
				initialSlide: 0,

				// 高さ
				calculateHeight: false,

				// drag の利用
				simulateTouch: true,
				allowTouchMove: true,
				allowSlideNext: true,
				allowSlidePrev: true,

				// 中のテキストや画像をぼやけないように調整
				roundLengths: true,

				pagination: false,
			};

			if (swiperElement.classList.contains("js-slider-gnav")) {
				var swiper = new Swiper(
					swiperElement,
					Object.assign(Object.assign({}, options), {
						effect: "fade",
						fadeEffect: {
							crossFade: true,
						},
						speed: 300,
						autoplay: 0,
						loop: false,
						initialSlide: 0,
						calculateHeight: true,
						simulateTouch: false,
						allowTouchMove: false,
						autoHeight: true,
					})
				);

				var timeoutDuration = 200;
				var timeoutId = null;
				var currentGnav = null;

				var triggerElList = document.querySelectorAll(".js-open_gnav_sub");
				var targetArea = document.getElementById("js-gnav_sub_area");
				var header = document.getElementById("header");
				var gnavCloseBtn = document.querySelectorAll(".gnav_close_btn");

				var setHideTimer = function () {
					timeoutId = setTimeout(function () {
						gnavSubHide();
					}, timeoutDuration);
				};
				var clearHideTimer = function () {
					if (timeoutId) {
						clearTimeout(timeoutId);
						// targetArea.stop();
					}
					// console.log('clearHideTimer');
				};
				var gnavSubShow = function () {
					// targetArea.stop(true, true).addClass('_show');
					targetArea.classList.add("_show");
					header.classList.add("_show_sub_menu");
					// console.log('gnavSubShow');
				};
				var gnavSubHide = function () {
					if (!IS_GNAV_DEBUG) {
						// targetArea.stop(true, true).removeClass('_show');
						targetArea.classList.remove("_show");
						header.classList.remove("_show_sub_menu");
						clearCurrentGnav();
						// console.log('gnavSubHide');
					}
				};

				triggerElList.forEach(function (triggerEl, i) {
					triggerEl.addEventListener("mouseenter", function (e) {
						e.preventDefault();

						var target = e.currentTarget;
						var targetIndex = parseInt(target.getAttribute("data-gnavindex"));

						clearHideTimer();
						clearCurrentGnav();

						setCurrentGnav(e.currentTarget);
						gnavSubShow();
						swiper.slideTo(targetIndex);
					});
				});
				triggerElList.forEach(function (triggerEl, i) {
					triggerEl.addEventListener("mouseleave", function (e) {
						setHideTimer();
					});
				});
				targetArea.addEventListener("mouseenter", function (e) {
					clearHideTimer();
				});
				targetArea.addEventListener("mouseleave", function (e) {
					setHideTimer();
				});

				gnavCloseBtn.forEach(function (btn) {
					btn.addEventListener("click", function (e) {
						setHideTimer();
					});
				});

				function setCurrentGnav(gnav) {
					currentGnav = gnav;
					currentGnav.classList.add("_hover");
				}
				function clearCurrentGnav() {
					if (currentGnav !== null) {
						currentGnav.classList.remove("_hover");
						currentGnav = null;
					}
				}
			} else if (swiperElement.classList.contains("js-slider-normal")) {
				var swiper = new Swiper(
					swiperElement,
					Object.assign(Object.assign({}, options), {
						speed: 1000,
						autoplay: false,
						loop: false,
						centeredSlides: true,
						initialSlide: 0,
						loop: true,
						updateOnWindowResize: true,
						// autoHeight: false,
						pagination: {
							el: ".js-slider-normal .swiper-pagination",
						},
						navigation: {
							nextEl: ".js-slider-normal .swiper-button-next",
							prevEl: ".js-slider-normal .swiper-button-prev",
						},
					})
				);
			} else if (swiperElement.classList.contains("js-slider-hero")) {
				var swiper2 = new Swiper(
					".js-slider-hero_btn",
					Object.assign(Object.assign({}, options), {
						loop: true,
						loopAdditionalSlides: 1,
						slidesPerView: 1,
						autoplay: false,
						effect: "fade",
						allowTouchMove: false,
					})
				);
				var swiper = new Swiper(
					swiperElement,
					Object.assign(Object.assign({}, options), {
						loop: true,
						loopAdditionalSlides: 1,
						slidesPerView: 1,
						speed: 1250,
						effect: "fade",
						fadeEffect: {
							crossFade: true,
						},
						autoplay: {
							delay: 4750,
							disableOnInteraction: false,
						},
						pagination: {
							el: ".swiper-pagination",
							type: "bullets",
							clickable: true,
						},
						controller: {
							control: swiper2,
							by: "slide",
						},
					})
				);
			}
		});
	};

	this.selectFrame = function () {
		const selectList = document.querySelectorAll(".select_frame select");

		if (selectList.length > 0) {
			selectList.forEach((select) => {
				setSelectRoot(select);
				select.addEventListener("change", (e) => {
					setSelectRoot(e.currentTarget);
				});
			});
		}

		function setSelectRoot(select) {
			const display = select.closest(".select_frame").querySelector(".select_frame__display");
			const text = select.options[select.selectedIndex].text;

			if (display) {
				display.textContent = text;
				if (select.value == "") {
					display.classList.add("default");
				} else {
					display.classList.remove("default");
				}
			}
		}
	};

	this.selectScroll = function () {
		document.querySelectorAll(".js-select_scroll_to").forEach((select) => {
			select.addEventListener("change", (e) => {
				e.preventDefault();

				var selector = e.currentTarget.value;
				if (document.querySelector(selector)) {
					gsap.to(window, {
						duration: 1,
						ease: "expo.out",
						scrollTo: {
							y: selector,
							offsetY: document.querySelector("#header").offsetHeight,
						},
					});
				}
			});
		});
	};

	this.toTopScroll = function () {
		function showToTopBtn() {
			const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
			// スクロール位置が100pxを超えている場合、指定された要素にクラスを追加
			const windowHeight = window.innerHeight;
			const element = document.querySelector(".js-to_top_scroll");

			if (element && scrollTop >= 200) {
				element.classList.add("_show");
			} else if (element) {
				element.classList.remove("_show");
			}

			// ページの一番下に到達したらボタンの位置を調整
			const documentHeight = document.documentElement.scrollHeight;
			const scrollPosition = scrollTop + windowHeight;
			const footerHeight = document.querySelector("#footer").clientHeight; // フッターの高さを取得

			if (scrollPosition >= documentHeight - footerHeight + 60) {
				element.style.bottom = windowHeight + scrollTop - 30 - documentHeight + footerHeight + "px";
			} else {
				element.style.bottom = "20px"; // 通常の位置
			}
		}
		window.addEventListener("scroll", showToTopBtn);

		document.querySelectorAll(".js-to_top_scroll").forEach((element) => {
			element.addEventListener("click", (e) => {
				e.preventDefault();

				window.scrollTo({ top: 0, behavior: "smooth" });
			});
		});
	};

	// UA検査によるモバイル判定
	this.mobilecheck = function () {
		var check = false;
		if (navigator.userAgent.match(/iPhone|Android.+Mobile/)) {
			check = true;
		}
		return check;
	};
})();

var popuri = new (function () {
	this.Ready = function () {};

	this.iflowHover = function () {
		const flow_bg = document.getElementById("js-iflow_bg");
		const flow_arrow = document.getElementById("js-iflow_arrow");

		flow_bg.addEventListener("mouseover", function () {
			flow_arrow.classList.add("hover");
		});
		flow_bg.addEventListener("mouseout", function () {
			flow_arrow.classList.remove("hover");
		});
	};

	this.ScrollTriger = function (is_index) {
		// console.log('ScrollTriger');
		var header = document.getElementById("header_container");
		var category_line = document.querySelector(".category_line");
		var hero_area = document.getElementById("hero_area");

		if (is_index) {
			var header_target = hero_area;
		} else {
			var header_target = category_line;
		}

		var defaultOption = {
			start: "top 80%",
			end: "bottom center",
			toggleActions: "play pause resume reset",

			scrub: 2,
			markers: false,
			ease: "expo.out",
		};

		ScrollTrigger.create(
			Object.assign(Object.assign({}, defaultOption), {
				trigger: header_target,
				end: "bottom 100px",
				toggleClass: { targets: "#header_container", className: "_no_border" },
			})
		);

		gsap.to("#fix_bg", {
			autoAlpha: 1,
			scrollTrigger: {
				trigger: "#calendar_area",
				start: "bottom 150px",
				end: "bottom 0",
				toggleActions: "play none none reverse",
			},
		});
	};

	this.readyAnimation = function () {
		var scrollDefaultOption = {
			start: "top 80%",
			end: "bottom center",
			toggleActions: "play pause resume reset",

			scrub: 2,
			markers: false,
			ease: "expo.out",
		};

		ScrollTrigger.matchMedia({
			"screen and (min-width: 1000px)": function () {
				var _d = Object.assign({}, scrollDefaultOption);

				if (document.querySelectorAll(".js-sopacity")) {
					gsap.set(".js-sopacity", {
						opacity: 0,
						y: 20,
						amount: 1,
						autoAlpha: 1,
						stagger: 0.15,
					});
					ScrollTrigger.batch(
						".js-sopacity",
						Object.assign(_d, {
							onEnter: function (batch) {
								gsap.to(batch, {
									duration: 1.8,
									opacity: 1,
									y: 0,
									ease: "expo.out",
								});
							},
							start: "top 70%",
							scrub: false,
							end: null,
						})
					);
				}
			},
			"screen and (max-width: 999px)": function () {
				var _d = Object.assign({}, scrollDefaultOption);

				if (document.querySelectorAll(".js-sopacity")) {
					gsap.set(".js-sopacity", {
						opacity: 0,
						y: 20,
						amount: 1,
						autoAlpha: 1,
						stagger: 0.15,
					});
					ScrollTrigger.batch(
						".js-sopacity",
						Object.assign(_d, {
							onEnter: function (batch) {
								gsap.to(batch, {
									duration: 1.8,
									opacity: 1,
									y: 0,
									ease: "expo.out",
								});
							},
							start: "top 80%",
							scrub: false,
							end: null,
						})
					);
				}
			},
		});

		if (imagesLoaded && document.querySelectorAll(".js-loaded_fade_in")) {
			const targetList = document.querySelectorAll(".js-loaded_fade_in");
			imagesLoaded(targetList, { background: true }, function (e) {
				gsap.to(targetList, {
					opacity: 1,
					duration: 1.8,
				});
			});
		}
	};

	this.ModalSetup = function () {
		var modalTrigger = document.querySelectorAll("[data-modal-trigger]");
		var modalContentList = {};
		if (modalTrigger.length > 0) {
			for (let i = 0; i < modalTrigger.length; i++) {
				var el = modalTrigger[i];
				//イベントをバインド
				_addModalEvent(el);
			}
		}
		var currentTarget = null;
		function _addModalEvent(el) {
			// console.log('_addModalEvent');
			var target = el.getAttribute("data-modal-trigger");
			var modalContent = document.querySelector('[data-modal="' + target + '"]');

			if (modalContent) {
				var listener = function (e) {
					gsap.to(".tingle-modal--visible .interview_modal .scroll_down", {
						duration: 0.2,
						delay: 0.3,
						opacity: 0,
					});
					var content = document.querySelector(".tingle-modal--visible .interview_modal .content");
					content.removeEventListener("scroll", listener);
				};
				if (!modalContentList[target]) {
					modalContentList[target] = new tingle.modal({
						onOpen: function () {
							if (target === "welfare") {
								var content = document.querySelector(".tingle-modal--visible .interview_modal .content");
								var id = currentTarget.getAttribute("data-welfare-target");
								// console.log(`currentTarget`, currentTarget);
								var scrollTarget = document.querySelector('[data-welfare-id="' + id + '"]');

								// console.log(content.scrollTop);

								var groupList = content.querySelectorAll("[data-welfare-id]");
								var offsetTop = 0;

								var contentStyle = window.getComputedStyle(content, null);
								var paddingTop = contentStyle.getPropertyValue("padding-top");

								var el;
								var elStyle;
								var currentId;
								var marginTop;

								if (paddingTop) {
									offsetTop += parseInt(paddingTop, 10);
								}
								// console.log('###start', offsetTop);
								for (var i = 0; i < groupList.length; i++) {
									el = groupList[i];
									elStyle = window.getComputedStyle(el, null);
									currentId = el.getAttribute("data-welfare-id");
									// paddingTop = elStyle.getPropertyValue('padding-top');
									marginTop = elStyle.getPropertyValue("margin-top");
									// console.log(currentId);
									// console.log(id);

									// if (paddingTop) {
									//  console.log(`paddingTop`, paddingTop);
									//  offsetTop += parseInt(paddingTop, 10);
									// }

									if (currentId !== id) {
										offsetTop += el.offsetHeight;
										// console.log('- '+ currentId + ' width', el.offsetHeight);
										// console.log('- offsetTop', offsetTop);
										if (marginTop) {
											offsetTop += parseInt(marginTop, 10);
										}
										// console.log(`- marginTop`, marginTop);
										// console.log(offsetTop);
									} else {
										break;
									}
								}

								if (id === "id1") {
									offsetTop = 0;
								}
								// console.log('offsetTop', offsetTop);
								// offsetTop = 664 - 80;
								// offsetTop -= 80;
								// console.log(getPosition(scrollTarget));
								// console.log($(scrollTarget).position());
								// console.log(scrollTarget);
								// console.log(scrollTarget.getBoundingClientRect());
								// console.log(scrollTarget.getClientRects());
								// console.log(scrollTarget.offsetParent());

								gsap.to(content, {
									duration: 0.5,
									scrollTop: offsetTop,
									ease: "expo.out",
								});
								// content.scrollTop = offsetTop;
							} else {
								// scroll が必要かどうか調べる
								var content = document.querySelector(".tingle-modal--visible .interview_modal .content");
								var content_inner = content.querySelector("._inner");
								var paddingTop = parseInt(document.defaultView.getComputedStyle(content, null).paddingTop);
								var paddingBottom = parseInt(document.defaultView.getComputedStyle(content, null).paddingBottom);

								var scrollDown = document.querySelector(".tingle-modal--visible .interview_modal .scroll_down");
								if (scrollDown) {
									if (content.offsetHeight < content_inner.offsetHeight + paddingTop + paddingBottom) {
										scrollDown.style.opacity = 1;
										content.addEventListener("scroll", listener);
									} else {
										scrollDown.style.opacity = 0;
									}
									content.scrollTop = 0;
								}
							}
						},
						beforeClose: function () {
							var content = document.querySelector(".tingle-modal--visible .interview_modal .content");
							content.removeEventListener("scroll", listener);
							return true;
						},
					});
					modalContentList[target].setContent(modalContent.innerHTML);
				}
			}

			el.addEventListener("click", function (event) {
				event.preventDefault();

				// console.log(modalContentList[target]);
				currentTarget = event.currentTarget;
				modalContentList[target].open();

				// console.log(modalContent);
				// document.querySelector('.tingle-modal--visible .interview_modal .content').addEventListener('scroll', function(e) {
				//  console.log('here');
				// });
			});
		}
	};

	this.SwiperTab = function () {
		// console.log('SwiperTab');

		var swiper = new Swiper(".js-slider", {
			speed: 500,
			autoplay: 0,
			loop: false,
			autoHeight: true,

			// drag を禁止
			simulateTouch: false,
			allowTouchMove: false,
			allowSlideNext: false,
			allowSlidePrev: false,
		});

		document.querySelectorAll("[data-tab-open-index]").forEach(function (tab, i) {
			var targetIndex = tab.getAttribute("data-tab-open-index");
			// console.log(targetIndex);
			tab.addEventListener("click", function (e) {
				// console.log('click');
				e.preventDefault();

				// tab 処理
				e.target
					.closest(".js-tab_area")
					.querySelectorAll("[data-tab-open-index]._selected")
					.forEach(function (_tab, i) {
						_tab.classList.remove("_selected");
					});
				e.target.classList.add("_selected");

				// swiper 処理
				swiper.slideTo(targetIndex);

				// var target = document.querySelector('[data-tab-content="' + targetId + '"]');
				// if (target) {
				// }
			});
		});
	};

	this.mmenu = () => {
		//const mmenu = new Mmenu(
		//	"#drawer",
		//	{
		//		navbar: {
		//			title: "menu",
		//			titleLink: "parent",
		//			add: true,
		//		},
		//		offCanvas: {
		//			page: {
		//				selector: "#root",
		//			},
		//			position: "right-front",
		//		},
		//	},
		//	{
		//		classNames: {
		//			selected: "active",
		//		},
		//	}
		//);
		const mmenu = new Mmenu(
			"#drawer",
			{
				navbar: {
					title: "MENU",
					titleLink: "parent",
					add: true,
				},
				navbars: [
					{
						position: "top",
						content: [
							"<div class='header__inner'><a class='close_btn' id='close_menu' href='#drawer'></a><div class='header__l'><div class='logo_wrap'><a href=' / '><img src='/common/img/logo.webp' alt='医療法人徳洲会 小規模多機能型居宅介護 ポプリ' loading='lazy' width='315' height='40'></a></div></div></div>",
							"close",
						],
					},
					{
						position: "bottom",
						content: [],
					},
				],
				offCanvas: {
					position: "right-front",
				},
			},
			{
				classNames: {
					selected: "active",
				},
			}
		);

		const api = mmenu.api;

		//const body = document.querySelector("body");

		//function isOpened() {
		//	return body.classList.contains("mm-wrapper--opened");
		//}

		//window.addEventListener("resize", (e) => {
		//	if (window.innerWidth > mdlib2.SP_WIDTH && isOpened()) {
		//		mmenu.API.close();
		//	}
		//});
	};

	const accordion = document.querySelectorAll(".js-accordion");
	for (let i = 0; i < accordion.length; i++) {
		accordion[i].addEventListener("click", () => {
			accordion[i].classList.toggle("opened");
			const content = accordion[i].querySelectorAll(".js-accordion_content");
			for (let i = 0; i < content.length; i++) {
				if (content[i].parentNode.classList.contains("opened")) {
					content[i].style.height = content[i].scrollHeight + "px";
				} else {
					content[i].style.height = "0";
				}
			}
		});
	}

	const sub_menu_accordion = document.querySelectorAll(".js-sub_accordion");
	for (let i = 0; i < sub_menu_accordion.length; i++) {
		const content = sub_menu_accordion[i].querySelectorAll(".sub_menu__ul2");

		// 人間ドックのコース一覧ののときはデフォルトでアコーディオン開かないようにする
		if (location.pathname !== "/checkup/course") {
			if (sub_menu_accordion[i].classList.contains("active")) {
				sub_menu_accordion[i].classList.add("opened");
				for (let i = 0; i < content.length; i++) {
					content[i].classList.add("opened");
				}
			}
		}
		const activeChild = sub_menu_accordion[i].querySelector(".active");
		if (activeChild) {
			sub_menu_accordion[i].classList.add("opened");
		}
		const accordion_btn = sub_menu_accordion[i].querySelector(".accordion_toggle");
		accordion_btn.addEventListener("click", () => {
			sub_menu_accordion[i].classList.toggle("opened");
			for (let i = 0; i < content.length; i++) {
				content[i].classList.toggle("opened");
			}
			for (let i = 0; i < content.length; i++) {
				if (content[i].parentNode.classList.contains("opened")) {
					content[i].style.height = content[i].scrollHeight + "px";
				} else {
					content[i].style.height = "0";
				}
			}
		});
	}

	const subList = document.querySelectorAll(".li2");
	for (let i = 0; i < subList.length; i++) {
		let activeFlag = subList[i].classList.contains("active");
		if (activeFlag) {
			subList[i].parentElement.classList.add("opened");
		}
	}

	this.ticker = function () {
		$("#js-ticker_area").marquee({
			easing: "easeOutQuart",
			pauseOnHover: false,
			pauseSpeed: 6000,
		});
	};

	this.headerSearchToggle = function () {
		var headerSearchToggles = document.querySelectorAll(".js-header_search_toggle");

		headerSearchToggles.forEach(function (toggle) {
			toggle.addEventListener("click", function (e) {
				e.preventDefault();
				var header = document.querySelector(".header");
				var searchInput = document.querySelector('.header__search_input_area input[type="text"]');

				if (!header.classList.contains("_open_search")) {
					header.classList.add("_open_search");
					searchInput.focus();
				} else {
					header.classList.add("_close_search");
					setTimeout(function () {
						header.classList.remove("_close_search");
						header.classList.remove("_open_search");
					}, 500);
				}
			});
		});
	};

	this.showGnavSearchArea = function () {
		const gnavSearchBtn = document.getElementById("js-gnav_search_btn");
		const gnavSearchArea = document.getElementById("js-gnav_search_area");
		const gnavSearchCloseBtn = document.getElementById("js-gnav_search_close_btn");
		gnavSearchBtn.addEventListener("click", (e) => {
			e.preventDefault();
			gnavSearchBtn.classList.add("hidden");
			gnavSearchArea.classList.add("show");
		});
		gnavSearchCloseBtn.addEventListener("click", () => {
			gnavSearchArea.classList.remove("show");
			gnavSearchBtn.classList.remove("hidden");
		});
	};

	this.scrollToggle = function () {
		const rootIndex = Boolean(document.querySelector(".root-index"));
		const header = document.querySelector("header");

		window.addEventListener("scroll", function () {
			let headerHeight = 0;
			if (rootIndex) {
				headerHeight = 120;
			} else {
				headerHeight = 120;
			}

			if (window.scrollY > headerHeight) {
				header.classList.add("_scroll");
			} else {
				header.classList.remove("_scroll");
			}
		});

		window.addEventListener("DOMContentLoaded", function () {
			let headerHeight = 0;
			if (rootIndex) {
				headerHeight = 120;
			} else {
				headerHeight = 120;
			}

			if (window.scrollY > headerHeight) {
				header.classList.add("_scroll");
			} else {
				header.classList.remove("_scroll");
			}
		});
	};

	// タブ切り替え
	this.SetTabChange = function (selector) {
		var tabClickElements = document.querySelectorAll(selector);

		function handleTabClick(event) {
			event.preventDefault();
			var id = this.getAttribute("href").substr(1);
			hide(this);
			show(this, id);
			this.classList.remove("_selected");
			this.classList.add("_selected");
		}

		for (var i = 0; i < tabClickElements.length; i++) {
			tabClickElements[i].addEventListener("click", handleTabClick);
		}

		if (window.location.hash && window.location.hash.match(/^#\w/)) {
			var hashElement = document.querySelector(window.location.hash);
			if (hashElement && hashElement.length && window.location.hash.search(/^open_tab_/)) {
				hashElement.dispatchEvent(new Event("click"));
			}
		}

		var tabSelectElements = document.querySelectorAll(".tab_select");

		function handleTabSelectChange(event) {
			event.preventDefault();
			var id = this.value;
			hide(this);
			show(this, id);
		}

		for (var j = 0; j < tabSelectElements.length; j++) {
			tabSelectElements[j].addEventListener("change", handleTabSelectChange);
		}

		function hide(el) {
			var tabArea = el.closest(".js-tab_area");

			var tabAreaContent = tabArea.querySelectorAll(".js-tab_area__content");
			for (var k = 0; k < tabAreaContent.length; k++) {
				tabAreaContent[k].classList.remove("_show");
			}

			var tabClickElements = tabArea.querySelectorAll(".js-tab_click");
			for (var l = 0; l < tabClickElements.length; l++) {
				tabClickElements[l].classList.remove("_selected");
			}
		}

		function show(el, id) {
			if (id) {
				var content = document.getElementById(id);
				if (content) {
					//content.style.display = "none";
					content.classList.add("_show");
					el.classList.add("_selected");
				}
			}
		}
	};

	this.yt_player = function (mdlib2) {
		if (mdlib2.mobilecheck()) {
			$(".hero").removeClass("hero-pc");
			$(".hero").addClass("hero-mobile");
			$("#js-yt_player_start").click(function (e) {
				e.preventDefault();
				$(".hero").removeClass("hero-mobile");
				$(".hero").addClass("hero-mobilestarted");
				start("14/5");
			});
		} else {
			start();
		}

		function start(ratio = "16/9") {
			$("#js-yt_player").YTPlayer({
				containment: "#hero",
				ratio,
			});
			$("#js-yt_player").on("YTPStart", function (e) {
				$(".hero")
					.addClass("inited")
					.delay(4000)
					.queue(function (next) {
						$(".imain_content").addClass("imain_content-inited");
						$(".hero_banner").addClass;

						next();
					});
			});
		}

		// 100vw に広がる yt player を 16:9 の比率にし続ける
		$(window).on("resize", function () {
			resize(false);
		});
		resize(false);
	};

	function resize(index_flag = true) {
		// console.log('resize');
		// var width = window.innerWidth;
		var $container = $("#yt_player_movie_container");
		var $player = $("#yt_player_movie");
		var pc_minheight = 740;
		var sp_minheight = 568;
		var sp_maxheight = 820;
		var sp_maxheight_xs = 600;
		var to_height_ratio = 1080 / 1920;
		var to_width_ratio = 1920 / 1080;

		var window_width = window.innerWidth;
		var window_height = window.innerHeight;
		var base = "";

		if (window_width * to_height_ratio > pc_minheight) {
			base = "height";
		} else {
			base = "width";
		}
		if (matchMedia("(max-width: 550px)").matches) {
			// console.log('ytplayer 550以下 sp_change_size()');
			// sp_change_size(index_flag);
		} else if (matchMedia("(max-width: 999px)").matches) {
			// 画面が sp サイズ高さ min-height 以下
			if (matchMedia("(max-height: " + sp_minheight + "px)").matches) {
				// console.log('ytplayer 999以下 sp_minheight 以下');
				change_size("height", sp_minheight, index_flag);

				// 画面が sp サイズ高さ max-height 以上
			} else if (matchMedia("(min-height: " + sp_maxheight + "px)").matches) {
				// console.log('ytplayer 999以下 sp_min-height 以上');
				change_size("height", sp_maxheight, index_flag);
			} else {
				// console.log('ytplayer 999以下 window_height');
				change_size("height", window_height, index_flag);
			}
		} else {
			if (matchMedia("(min-height: " + pc_minheight + "px)").matches) {
				// 大きい時
				// console.log('ytplayer pc window height large');

				change_size("height", window_height, index_flag);
			} else {
				// 小さい時
				// console.log('ytplayer pc window height small');

				base = "";
				if (window_width * to_height_ratio > pc_minheight) {
					base = "width";
				} else {
					base = "height";
				}

				change_size(base, pc_minheight, index_flag);
			}
		}
	}

	function change_size(base, height, index_flag) {
		// console.log(base);
		var root_padding = parseInt($(".root").css("padding-top"), 10);
		var $container = $("#yt_player_movie_container");
		var $player = $("#yt_player_movie");
		var $important_area = $("#iimportant_area");
		var $hero__main = $(".hero__main");
		var $breadcrumb_area_height = $(".breadcrumb_area").outerHeight();
		var window_width = window.innerWidth;

		// 高さ140px をタイトルと関連動画表示域として計算する
		var title_height = 350;
		var to_width_ratio = 1920 / 1080;
		var to_height_ratio = 1080 / 1920;

		var important_area_height = 0;

		if ($important_area.length > 0) {
			important_area_height = $important_area.height();
		}

		if (base === "width") {
			if (index_flag) {
				var calc_height = window_width * to_height_ratio - important_area_height - root_padding;
			} else {
				var calc_height = window_width * to_height_ratio - root_padding - $breadcrumb_area_height;
			}

			if (matchMedia("(max-width: 767px)").matches) {
				calc_height = window_width * to_height_ratio - root_padding;
			}

			if (index_flag) {
				$player.height(calc_height + title_height);
				$player.width((calc_height + title_height) * to_width_ratio);

				$container.height(calc_height);
				$hero__main.height(calc_height);
			} else {
				$player.height(window_width / to_width_ratio);
				$player.width((calc_height + title_height) * to_width_ratio);

				$container.height(window_width / to_width_ratio);
				$hero__main.height(window_width / to_width_ratio);
			}

			// $container.width(calc_height * to_width_ratio);
		} else {
			// console.log(important_area_height);

			if (index_flag) {
				var calc_height = height - important_area_height - root_padding;
				if (matchMedia("(max-width: 767px)").matches) {
					calc_height = height - root_padding;
				}
				$player.height(calc_height + title_height);
				$player.width((calc_height + title_height) * to_width_ratio);

				$container.height(calc_height);
				$hero__main.height(calc_height);
			} else {
				var calc_height = height - root_padding - $breadcrumb_area_height;
				if (matchMedia("(max-width: 767px)").matches) {
					calc_height = height - root_padding - $breadcrumb_area_height;
				}
				$player.height(window_width / to_width_ratio + title_height);
				$player.width((window_width / to_width_ratio + title_height) * to_width_ratio);

				$container.height(window_width / to_width_ratio);
				$hero__main.height(window_width / to_width_ratio);
			}

			// $container.width(height * to_width_ratio);
		}

		// 共通
		if (matchMedia("(max-width: 767px)").matches) {
			$(".hero_area").height(calc_height);
		} else {
			$(".hero_area").height(calc_height + important_area_height);
		}
	}
})();

if (window.MSInputMethodContext && document.documentMode) {
	alert("お手数ですが「Internet Explorer 11」以外のブラウザで閲覧をお願いします。");
}

// table スマホ時にスクロールさせる
document.addEventListener("DOMContentLoaded", function () {
	const table = document.querySelectorAll("table");
	const normalTable = document.querySelectorAll(".table");
	const wpTable = document.querySelectorAll(".wp-block-table");
	const wpCustomTable = document.querySelectorAll(".wp-block-advgb-table");
	const scrollableTable = [];
	const verticalTable = [];

	normalTable.forEach(function (element) {
		if (element.classList.contains("fixed_table")) {
			scrollableTable.push(element);
		}
	});
	wpTable.forEach(function (element) {
		if (element.classList.contains("fixed_table")) {
			scrollableTable.push(element.querySelectorAll("table")[0]);
		}
	});
	wpCustomTable.forEach(function (element) {
		if (element.classList.contains("fixed_table")) {
			scrollableTable.push(element);
		}
	});

	table.forEach(function (element) {
		const figure = element.closest("figure");

		if (figure !== null) {
			if (figure.classList.contains("fixed_table")) {
				scrollableTable.push(element);
			} else if (figure.classList.contains("recolumn")) {
				verticalTable.push(element);
			}
		}
		// else {
		// 	if (element.querySelector("tr:first-child > th:not([colspan]):first-child + td:not([colspan]):last-child") === null && element.querySelector("tr:first-child > *").length !== 1) {
		// 		scrollableTable.push(element);
		// 	} else if (element.querySelector("tr:first-child > th:not([colspan]):first-child + td:not([colspan]):last-child") !== null) {
		// 		verticalTable.push(element);
		// 	}
		// 	if (element.classList.contains("fixed_table")) {
		// 		scrollableTable.push(element);
		// 	}
		// }
	});

	scrollableTable.forEach(function (element) {
		const yubi = document.createElement("div");
		yubi.classList.add("_yubi");
		yubi.innerHTML = '<img src="/common/img/icon/icon_swipe.webp" alt="">';

		yubi.addEventListener("click", function () {
			this.style.display = "none";
		});
		yubi.addEventListener("touchstart", function () {
			this.style.display = "none";
		});

		element.appendChild(yubi);

		const elementWrap = element.parentElement;

		elementWrap.addEventListener("scroll", function () {
			const yubiElements = this.querySelectorAll("._yubi");
			yubiElements.forEach(function (yubiElement) {
				yubiElement.style.display = "none";
			});
		});
	});

	verticalTable.forEach(function (element) {
		element.classList.add("recolumn");
	});
});

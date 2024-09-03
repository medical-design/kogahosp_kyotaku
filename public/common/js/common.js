// JavaScript Document

IS_DEBUG = 0;
IS_DRAWER_DEBUG = 0;
GNAV_DEBUG = 0;
HERO_SUB_DEBUG = 0;

$(function () {
	"use strict";

	kokan.Init();

	var swiperClass = ".js-outpatinet_table";
	var areaClass = ".js-outpatinet_table";
	var area = $(".js-outpatient_table_swiper").closest(areaClass);
	var swiper = new Swiper(".swiper", {
		slidesPerView: 1,
		on: {
			slideChangeTransitionStart: function () {
				document.querySelectorAll(".js-slide_day").forEach(function (_link, i) {
					if (swiper.activeIndex !== i) {
						_link.classList.remove("active");
					} else {
						_link.classList.add("active");
						//setTitleDate(_link.getAttribute('data-utime'), _link.closest(areaClass));
					}
				});
			},
		},
	});
	document.querySelectorAll(".js-slide_day").forEach(function (link, i) {
		link.addEventListener("click", function (e) {
			console.log("here");
			e.preventDefault();
			//setTitleDate(link.getAttribute('data-utime'), link.closest(areaClass));
			// document.querySelectorAll('.js-slide_day').forEach(function(_link, i) {
			// 	if (_link !== link) {
			// 		_link.classList.remove('active');
			// 	}
			// });
			// link.classList.add('active');
			var w = link.getAttribute("data-w");
			swiper.slideTo(w - 1);
		});
		// link.setAttribute('data-event', key);
	});

	const mediaSwiper = new Swiper(".media_swiper", {
		slidesPerView: "auto",
		freeMode: true,
		//preventLinks: false,
		//freeModeFluid: true,
		//mousewheelControl: true,
		scrollbar: {
			el: ".swiper-scrollbar",
			hide: false,
			draggable: true,
		},
	});

	if ($(".root-index").length > 0) {
		kokan.index(mdlib);
	}

	if ($(".hero_sub_menu").length > 0) {
		kokan.hero_sub_menu(mdlib);
	}

	if ($(".js-slider").length > 0) {
		kokan.slick_start();
	}

	if ($("#js-ticker_area").length > 0) {
		kokan.ticker(mdlib);
	}
	if ($(".int_hero").length > 0) {
		kokan.interview_init(mdlib);
	}

	if ($(".js-outpatient_pagelink").length > 0) {
		kokan.outpatient_pagelink(mdlib);
	}

	if ($(".js-sticky_schedule").length > 0) {
		mdlib.sticky($(".js-sticky_schedule"), $(".schedule_box"), 0, 0, true);

		$(".js-sticky_schedule").width($(".schedule_box").width());
		// $('.js-sticky_schedule').height($('.schedule_box__head').height());
		$(window).on("resize", function (e) {
			$(".js-sticky_schedule").width($(".schedule_box").width());
			// $('.js-sticky_schedule').height($('.schedule_box__head').height());
		});
	}

	if ($(".js-loading-oacity").length > 0) {
		kokan.loading_oacity();
	}

	if ($("img[usemap]").length) {
		$("img[usemap]").rwdImageMaps();
	}

	// if ($('.js-open_menu_panel').length > 0) {
	// 	kokan.open_menu_panel(mdlib);
	// }

	// グロナビのサブメニューを表示する
	// kokan.submenu(mdlib, $('#menu'), $('#menu .gnav__li'), $('#menu .gnav__a'), 'gnav__sub', 'gnav__sub-show');

	mdlib.changeHeaderByScroll(5);

	if (IS_DRAWER_DEBUG) {
		$(window)
			.delay(500)
			.queue(function (next) {
				$("#open_menu").trigger("click");
				next();
			});
	}

	// mdlib.mwwp_form(false);

	// アンカースムーズスクロール
	mdlib.SmoothAnchor(
		"#open_menu, #close_menu, .js-tab_click, .js-newstab_click, .js-remodal_target, .js-accordion_toggle, .form_button_area a, .js-noscroll, .js-outpatient_pagelink, .js-header_search_toggle, .schedule_person",
		true,
		true
	);

	// 文字サイズ変更
	mdlib.ChangeStyleSheet();

	// サイト内検索の文字をクリックしたときに消す
	// mdlib.ClearSearchBox(".searchBox");

	// pdfにリンクしてるのはtarget=_blank指定
	mdlib.PdfTargetBlank();

	// 画像ロールオーバー
	// mdlib.RollOverImage("_off.", "_on.", "rollOverImage");

	mdlib.select_frame();

	// スマホ以外の場合はteltoリンクを削除する
	mdlib.RemoveTelLink();

	// スマホメニュー開くボタン
	// mdlib.SpNavMenuBtn('#header_menubtn', '#hmenu_overlay', '#hmenu_sp');

	// アコーディオン
	mdlib.SetAccordion();
	mdlib.SetAccordion2();
	mdlib.SetTabChange2();

	// 右下の Page Top
	mdlib.ScrollToTop("#scroll_to_top");

	// スクロール監視
	mdlib.scrollCheck();

	// mmenu - watchWindowSize() に依存している
	mdlib.mmenu();

	mdlib.windowPrint(".js-print");

	// sticky - watchWindowSize() に依存している
	// if ($('.pc_sticky_area-sub').length) {
	// 	mdlib.sticky($('.pc_sticky_area'), $('.root'), 240, 60);
	// } else {
	// 	mdlib.sticky($('.pc_sticky_area'), $('.root'), 160, 60);
	// }

	// window サイズによって カスタムイベントを dispatch
	mdlib.watchWindowSize();

	if (GNAV_DEBUG) {
		$("#menu .gnav__li:nth-child(2) > a").trigger("mouseover");
	}
});

var mdlib = new (function () {
	"use strict";

	// this.TB_WIDTH = 949;
	this.TB_WIDTH = 999;
	this.SP_WIDTH = 999;

	// アンカースムーズスクロール
	this.SmoothAnchor = function (notClass, is_pc_offset, is_sp_offset) {
		// https://sterfield.co.jp/designer/%E3%83%9A%E3%83%BC%E3%82%B8%E3%83%AA%E3%83%B3%E3%82%AF%E4%BB%98%E3%81%8D%E3%81%AE%E3%82%A2%E3%83%B3%E3%82%AB%E3%83%BC%E3%83%AA%E3%83%B3%E3%82%AF%E3%81%AB%E5%AF%BE%E5%BF%9C%E3%81%97%E3%81%9Fjquery/
		var $a = $("a[href*='#'], area[href*='#']");
		if (isset(notClass)) {
			$a = $a.not(notClass);
		}
		$a.click(function () {
			var speed = 400, // ミリ秒(この値を変えるとスピードが変わる)
				href = $(this).prop("href"), //リンク先を絶対パスとして取得
				hrefPageUrl = href.split("#")[0], //リンク先を絶対パスについて、#より前のURLを取得
				currentUrl = location.href, //現在のページの絶対パスを取得
				currentUrl = currentUrl.split("#")[0]; //現在のページの絶対パスについて、#より前のURLを取得

			//#より前の絶対パスが、リンク先と現在のページで同じだったらスムーススクロールを実行

			if (hrefPageUrl.slice(-1) === "/") {
				hrefPageUrl = hrefPageUrl.slice(0, -1);
			}
			if (currentUrl.slice(-1) === "/") {
				currentUrl = currentUrl.slice(0, -1);
			}

			if (hrefPageUrl == currentUrl) {
				//リンク先の#からあとの値を取得
				href = href.split("#");
				href = href.pop();
				href = "#" + href;

				var matches = [];
				if ((matches = href.match(/^#click_(.*)$/))) {
					if (matches[1] && $("#" + matches[1]).length) {
						$("#" + matches[1]).trigger("click");
					}
					return false;
				}

				//スムースクロールの実装
				var target = $(href == "#" || href == "" ? "html" : href);
				var position = 0;
				var body = "html,body";
				var easing = "easeOutExpo";

				if (target.length) {
					position = target.offset().top;
				} else {
					if (href === "#top") {
						position = 0;
					} else {
						return false;
					}
				}
				var offset = 100;
				// var offset = $('.header').outerHeight(true);
				// if (mdlib._is_small_window()) {
				offset = $(".header").outerHeight(true);
				// }
				$(body).animate({ scrollTop: position - offset }, speed, easing);
				return false;
			}
		});

		// ハッシュある場合のスクロール
		if (window.location.hash && window.location.hash.match(/^#\w/)) {
			if ($(window.location.hash)[0] && $(window.location.hash).length) {
				var offset = $(".header").outerHeight(true);

				// var offset = (mdlib._is_small_window() === false) ? 0 : offset;
				if (Math.round($(window.location.hash).offset().top - offset) !== $(window).scrollTop()) {
					$("html,body")
						.stop()
						.delay(100)
						.queue(function (next) {
							if (window.location.hash.search(/^open_tab_/)) {
								$(window.location.hash).trigger("click");
							}
							// console.log($(window.location.hash).offset().top);
							$(this)
								.animate(
									{
										scrollTop: $(window.location.hash).offset().top - offset,
									},
									500,
									"easeOutExpo"
								)
								.dequeue();
						});
				}
			}
		}
	};

	// 文字サイズを変更する
	this.ChangeStyleSheet = function () {
		this.cookieName = "fontsize"; // クッキーの名前

		$("a[data-csstitle]")
			.off("click")
			.on(
				"click",
				function (e) {
					this.setActiveStyleSheet($(e.currentTarget).data("csstitle"));
					return false;
				}.bind(this)
			);

		$(window).on(
			"beforeunload",
			function () {
				var activeCSS = null;
				$("link[rel*='stylesheet'][title]").each(function () {
					if (!this.disabled) {
						activeCSS = $(this).attr("title");
					}
				});
				document.cookie = this.cookieName + "=" + activeCSS + "; path=/";
			}.bind(this)
		);

		this.setActiveStyleSheet = function (title) {
			$("link[rel*='stylesheet'][title]").each(function () {
				// 謎の記述（chromeのバグ対策）
				this.disabled = false;
				this.disabled = true;
				this.disabled = $(this).attr("title") !== title;
			});
			$("html").trigger("changeFontSize");
			$("html").trigger("changeFontSize" + "_" + title);
		};

		var title = "";
		var nameEQ = this.cookieName + "=";
		var ca = document.cookie.split(";");
		for (var i = 0; i < ca.length; i++) {
			while (ca[i].charAt(0) === " ") {
				ca[i] = ca[i].substring(1, ca[i].length);
			}
			if (ca[i].indexOf(nameEQ) === 0) {
				title = ca[i].substring(nameEQ.length, ca[i].length);
			}
		}

		if (!title) {
			$("link[rel^='stylesheet'][title]").each(function () {
				title = $(this).attr("title");
			});
		}

		this.setActiveStyleSheet(title);
	};

	// サイト内検索の文字をクリックしたときに消す
	this.ClearSearchBox = function (target) {
		$(target).one("click", function () {
			if ($(this).val() === "サイト内検索") {
				$(this).val("");
			}
		});
	};

	// pdfにリンクしてるのはtarget=_blank指定
	this.PdfTargetBlank = function () {
		// console.log($(".wpnews__content a[href$='.pdf']").length);
		if ($(".wpnews__content a[href$='.pdf']").length) {
			$(".wpnews__content a[href$='.pdf']").addClass("icon_pdf").attr("target", "_blank");
		}
	};

	// ロールオーバー
	this.RollOverImage = function (suffixOff, suffixOn, validImgClass) {
		var $images = $("a img");
		if (isset(validImgClass)) {
			$images = $images.filter(function (i) {
				return $(this).hasClass(validImgClass);
			});
		}
		if ($images.length > 0) {
			$images.each(function () {
				if ($(this).attr("src").indexOf(suffixOff) >= 0) {
					this.orgsrc = $(this).attr("src");
					this.newsrc = $(this).attr("src").replace(suffixOff, suffixOn);
					var onImg = new Image();
					onImg.src = this.newsrc;

					$(this).on("mouseover", function () {
						$(this).attr("src", this.newsrc);
					});
					$(this).on("mouseout", function () {
						$(this).attr("src", this.orgsrc);
					});
				}
			});
		}
	};

	// PC、タブレットはtel:リンク削除
	this.RemoveTelLink = function () {
		if (!this.ua.Mobile) {
			// console.log('here');
			$("a[href^='tel:']").each(function () {
				$(this).removeAttr("href").removeClass("tel_link").addClass("tel_link-no");
			});
		}
	};

	// スマホ用メニューボタン
	this.SpNavMenuBtn = function (btn, overlay, menu) {
		$(btn + (overlay === null ? "" : "," + overlay))
			.off("click")
			.on("click", function () {
				$(this).toggleClass("active");
				$(menu).toggleClass("active");
				$(overlay).fadeToggle();
				return false;
			});
	};

	// タブ切り替え
	this.SetTabChange = function (baseId, tab_suffix, content_suffix) {
		$(baseId + tab_suffix + " a")
			.off("click")
			.on("click", function () {
				var activeTab = $(baseId + tab_suffix + " a.active");
				activeTab.removeClass("active");
				$(this).addClass("active");

				$(baseId + content_suffix + " > .active")
					.removeClass("active")
					.slideUp();
				$($(this).attr("href")).addClass("active").slideDown();

				return false;
			});
	};

	this.SetTabChange2 = function () {
		if ($(".js-tab_click").length) {
			$(".js-tab_click").click(function (e) {
				e.preventDefault();
				var id = $(this).attr("href").substr(1);
				hide($(this));
				show($(this), id);
				$(this).removeClass("_selected");
				$(this).addClass("_selected");
			});

			// ハッシュある場合 open_tab_#{element} でクリックを監視
			if (window.location.hash && window.location.hash.match(/^#\w/)) {
				if ($(window.location.hash)[0] && $(window.location.hash).length && window.location.hash.search(/^open_tab_/)) {
					$(window.location.hash).trigger("click");
				}
			}
		}
		if ($(".tab_select").length) {
			$(".tab_select").change(function (e) {
				e.preventDefault();
				var id = $(this).val();
				hide($(this));
				show($(this), id);
			});
			// $('.tab_select').trigger('change');
		}

		function hide($el) {
			var $tab_area = $el.closest(".js-tab_area");

			$tab_area.find(".js-tab_area__content").removeClass("_show");
			$tab_area.find(".js-tab_click").removeClass("_selected");
		}
		function show($el, id) {
			if (id) {
				var $content = $("#" + id);
				if ($content.length) {
					$content.stop(true, true).queue(function (next) {
						$content.addClass("_show");
						next();
					});
					$el.addClass("_selected");
				}
			}
		}
	};

	this.select_frame = function () {
		var $select = $(".select_frame select");

		if ($select.length > 0) {
			$select.each(function () {
				set_select_root(this);
			});
			$select.on("change", function (e) {
				set_select_root(this);
				if ($(this).closest(".select_frame").hasClass("page_link")) {
					$(this).blur();
					jump_to(this.value);
				}
				if ($(this).closest(".select_frame").hasClass("link")) {
					location.href = this.value;
				}
			});
		}
		$(window).on("select_changes", function () {
			$(".select_frame select").each(function (i, el) {
				set_select_root(el);
			});
		});
		function set_select_root(select) {
			if (select.options[select.selectedIndex]) {
				var select_display = $(select).closest(".select_frame").find(".select_frame__display");
				select_display.text(select.options[select.selectedIndex].text);
				if ($(select).val() == "") {
					select_display.addClass("default");
				} else {
					select_display.removeClass("default");
				}
			}
		}

		if ($(".js-select_scroll_to").length) {
			$(".js-select_scroll_to").change(function (e) {
				e.preventDefault();
				var id = $(this).val().substr(1);
				if (document.getElementById(id) && $("#" + id).length) {
					//スムースクロールの実装
					var target = $("#" + id);
					var position = 0;
					var body = "html,body";
					var easing = "easeOutExpo";
					position = target.offset().top;

					var offset = 0;
					if (mdlib._is_small_window()) {
						offset = $(".header").outerHeight(true);
					}
					$(body).animate({ scrollTop: position - offset }, 400, easing);
				}
			});
		}
	};

	//アコーディオン（対象が表のセルだとうまくいかないのでその場合は個別に対応すること）
	this.SetAccordion = function () {
		var $cb = $(".js-accordion .js-accordion_cb");

		if ($cb.length) {
			$cb.each(function (i) {
				var $container = $(this).closest(".js-accordion");
				var $content = $container.find(".js-accordion_content");
				var $toggle_btn = $container.find(".toggle_btn");
				var speed = 600;

				if ($container.data("speed")) {
					speed = $container.data("speed");
				}
				if ($(this).data("target")) {
					$content = $("#" + $(this).data("target"));
				}

				$(this).on("change", function (e) {
					execute(this, $content, $toggle_btn, speed);
				});
				execute(this, $content, $toggle_btn, speed, true);
			});

			function execute(_this, $content, $toggle_btn, speed, is_init) {
				var status = $(_this).prop("checked");
				var slide_option = {
					duration: 500,
					easing: "easeOutQuint",
				};
				if (status) {
					if ($toggle_btn) {
						$toggle_btn.addClass("_opened");
					}
					if (is_init) {
						$content.show();
					} else {
						// $content.slideDown(slide_option);
						$content.animate(
							{
								height: "show",
								opacity: 1,
							},
							speed,
							"easeOutQuint",
							function () {
								$content.show();
							}
						);
					}
				} else {
					if ($toggle_btn) {
						$toggle_btn.removeClass("_opened");
					}
					if (is_init) {
						$content.hide();
					} else {
						// $content.slideUp(slide_option);
						$content.animate(
							{
								height: "hide",
								opacity: 0,
							},
							speed,
							"easeOutQuint",
							function () {
								$content.hide();
							}
						);
					}
				}
			}
		}
	};

	// .accordion .accordion__toggle がクリックされた時、 .accordion .accordion__content に .opened クラス名をつける
	// .accordion .accordion__toggle[data-for="{値}"]があった時、 data-name={値} に .opened クラス名をつける
	this.SetAccordion2 = function () {
		var $link = $(".js-accordion2 .js-accordion_toggle .js-toggle");

		if ($link.length > 0) {
			if ($(".js-accordion_toggle").length) {
				$(".js-accordion_toggle").each(function (i, el) {
					if ($(el).find(".js-toggle").length) {
						$(el).on("click", function (e) {
							e.preventDefault();
							execute($(el).find(".js-toggle"));
						});
						$(el)
							.find(".js-toggle")
							.on("click", function (e) {
								e.preventDefault();
								e.stopPropagation();
								execute(this);
							});
					} else {
						// $(el).on('click', function(e) {
						// 	e.preventDefault();
						// 	execute(this);
						// });
						$(el)
							.find(".js-toggle")
							.on("click", function (e) {
								e.preventDefault();
								e.stopPropagation();
								execute(this);
							});
					}
				});
			}

			function execute(_this) {
				var $content = null;
				var $accordion = $(_this).closest(".js-accordion2");

				if ($(_this).attr("data-for")) {
					$content = $('[data-name="' + $(_this).attr("data-for") + '"]');
				} else {
					$content = $accordion.find(".js-accordion_content");
				}
				if ($content.length) {
					// console.log($content);
					$content.toggleClass("_opened");
					$(_this).toggleClass("_opened");
				}
				// console.log($(this));
				// $(this).toggleClass('_opened');
			}
			if ($(".sub_menu .li1.active.js-accordion2").length && $(".sub_menu .li1.active.js-accordion2").find(".li2.active").length === 0) {
				execute($(".sub_menu .li1.active .js-toggle"));
			} else if ($(".sub_menu .li2.active").closest(".js-accordion2").find(".js-toggle").length) {
				execute($(".sub_menu .li2.active").closest(".js-accordion2").find(".js-toggle"));
			} else if ($(".sub_menu .li3.active").closest(".js-accordion2").find(".js-toggle").length) {
				execute($(".sub_menu .li3.active").closest(".js-accordion2").find(".js-toggle"));
			}
		}
	};

	// useragent
	this.useragent = window.navigator.userAgent.toLowerCase();

	// IE かどうかを判定
	this.isIE = this.useragent.indexOf("msie") >= 0 || this.useragent.indexOf("trident") >= 0;

	// スマホかタブレットかをuaに格納
	this.ua = (function (u) {
		return {
			Tablet:
				(u.indexOf("windows") !== -1 && u.indexOf("touch") !== -1 && u.indexOf("tablet pc") === -1) ||
				u.indexOf("ipad") !== -1 ||
				(u.indexOf("android") !== -1 && u.indexOf("mobile") === -1) ||
				(u.indexOf("firefox") !== -1 && u.indexOf("tablet") !== -1) ||
				u.indexOf("kindle") !== -1 ||
				u.indexOf("silk") !== -1 ||
				u.indexOf("playbook") !== -1,
			Mobile:
				(u.indexOf("windows") !== -1 && u.indexOf("phone") !== -1) ||
				u.indexOf("iphone") !== -1 ||
				u.indexOf("ipod") !== -1 ||
				(u.indexOf("android") !== -1 && u.indexOf("mobile") !== -1) ||
				(u.indexOf("firefox") !== -1 && u.indexOf("mobile") !== -1) ||
				u.indexOf("blackberry") !== -1,
		};
	})(window.navigator.userAgent.toLowerCase());

	this._is_small_window = function () {
		if (this.SP_WIDTH >= window.innerWidth) {
			return true;
		} else {
			return false;
		}
	};
	this._is_tb_window = function () {
		if (this.TB_WIDTH >= window.innerWidth) {
			return true;
		} else {
			return false;
		}
	};
	this._is_sp_window = function () {
		if (this.SP_WIDTH >= window.innerWidth) {
			return true;
		} else {
			return false;
		}
	};

	this._mode = "";
	this.watchWindowSize = function () {
		var _this = this;
		var watch = function () {
			if (_this._is_sp_window()) {
				if (_this._mode === "") {
					$(window).trigger("start_sp");
					// console.log('start_sp');
					_this._mode = "sp";
				} else if (_this._mode === "pc" || _this._mode === "tb") {
					$(window).trigger("change_to_sp");
					// console.log('change_to_sp');
					_this._mode = "sp";
				}
			} else if (_this._is_tb_window()) {
				if (_this._mode === "") {
					$(window).trigger("start_tb");
					// console.log('start_tb');
					_this._mode = "tb";
				} else if (_this._mode === "pc" || _this._mode === "sp") {
					$(window).trigger("change_to_tb");
					// console.log('change_to_tb');
					_this._mode = "tb";
				}
			} else {
				if (_this._mode === "") {
					$(window).trigger("start_pc");
					// console.log('start_pc');
					_this._mode = "pc";
				} else if (_this._mode === "tb" || _this._mode === "sp") {
					$(window).trigger("change_to_pc");
					// console.log('change_to_pc');
					_this._mode = "pc";
				}
			}
		};
		$(window).on("resize", watch);
		watch();
	};

	this.scrollCheck = function () {
		var _this = this;
		$(window).on("scroll", function () {
			var loadingClass = "init";
			var loadedClass = "inited";
			var margin = 200;

			if (_this._is_sp_window()) {
				margin = 50;
			}
			var currentPos = $(window).scrollTop() + window.innerHeight;
			$("." + loadingClass).each(function (i, el) {
				if (currentPos > $(el).offset().top + margin) {
					$(el)
						.removeClass(loadingClass)
						.delay(1000)
						.queue(function (next) {
							$(el).addClass(loadedClass);
							next();
						});
				}
			});
		});
		$(window).trigger("scroll");
	};

	this.mmenu = function () {
		var mdlib = this;
		var mmenu_exist = false;
		var mmenu_ready = false;
		var use_fixed_element = true;
		var option2 = {};

		$("#drawer a[href='" + location.pathname + "']")
			.closest("li")
			.addClass("mm-selected");

		if (use_fixed_element) {
			option2 = {
				classNames: {
					fixedElements: {
						fixed: "MM-FIXED",
					},
				},
			};
		}

		var make_mmenu = function () {
			// console.log('make_mmenu');
			var $drawer = $("#drawer");
			$drawer.ready(function () {
				$drawer.mmenu(
					{
						offCanvas: {
							position: "right",
							// blockUI: true,
							moveBackground: false,
						},
						// ドラッグジェスチャーでの開閉を許可
						dragOpen: true,

						// サブメニューをスライド
						slidingSubmenus: true,

						// navbars: [{
						// 	content: '<li class="drawer__head"><span class="drawer__hero"></span></li>',
						// 	height: 2,
						// 	position: 'top'
						// }],

						extensions: [
							"fullscreen",
							// 'border-offset',
							"border-full",
							"effect-menu-fade",
							// "effect-listitems-fade"
							"effect-listitems-slide",
						],
					},
					option2
				);
			});
			$("#drawer").addClass("drawer-show");
		};
		var reinit_mmenu = function () {
			if (use_fixed_element) {
				$(".contents").prependTo(".mm-page");
				$(".header").appendTo("body");
				$("#drawer").addClass("mm-menu");
				$("#drawer").addClass("drawer-show");
			}
			mmenu_ready = true;
		};
		var destroy_mmenu = function () {
			if (use_fixed_element) {
				$(".contents").prependTo("body");
				$("#header").prependTo("#header_container");
				$(".header_clone").prependTo(".header_default_wrapper");
				$("#drawer").removeClass("mm-menu");
				$("#drawer").removeClass("drawer-show");
			}
			mmenu_ready = false;
		};

		$("#close_menu").on("click", function () {
			var api = $("#drawer").data("mmenu");
			api.close();
		});

		$("#open_menu").on("click", function (e) {
			if ($("html").hasClass("mm-opened")) {
				var api = $("#drawer").data("mmenu");
				api.close();
				e.preventDefault;
				return;
			}
		});

		$(window).on("change_to_sp start_sp change_to_tb start_tb", function () {
			if (mmenu_exist === false) {
				make_mmenu();
				mmenu_exist = true;
				mmenu_ready = true;
			} else {
				if (mmenu_ready === false) {
					reinit_mmenu();
					mmenu_ready = true;
				}
			}
		});
		$(window).on("change_to_pc start_pc", function () {
			if (mmenu_exist === true) {
				destroy_mmenu();
				mmenu_ready = false;
			}
		});
	};

	// UA検査によるモバイル判定
	this.mobilecheck = function () {
		var check = false;
		(function (a) {
			if (
				/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(
					a
				) ||
				/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
					a.substr(0, 4)
				)
			)
				check = true;
		})(navigator.userAgent || navigator.vendor || window.opera);

		// var ua = window.navigator.userAgent.toLowerCase();
		// var isiOS = ua.indexOf('iphone') > -1 || ua.indexOf('ipad') > -1 || ua.indexOf('macintosh') > -1 && 'ontouchend' in document;
		var isiOS = false;
		if (
			navigator.platform == "iPad" || // -iOS12
			(navigator.platform == "MacIntel" && // iPadOS
				navigator.userAgent.indexOf("Safari") != -1 &&
				navigator.userAgent.indexOf("Chrome") == -1 &&
				navigator.standalone !== undefined)
		) {
			isiOS = true;
		}

		return check || isiOS;
	};

	this.sticky = function ($slide_item, $container, offset_top, offset_bottom, is_calc_header_height) {
		// config
		var is_bottom_base = true;

		// var
		var is_fixed = false;
		var min_move = null;
		var max_move = null;
		var margin_bottom = null;

		init();
		scroll();
		bind();

		function init() {
			min_move = $container.offset().top - offset_top;
			max_move = Math.ceil($container.offset().top + $container.outerHeight() - offset_top);

			if (is_bottom_base) {
				// console.log('$slide_item.outerHeight() : ' + $slide_item.outerHeight());
				// console.log('offset_bottom : ' + offset_bottom);
				// console.log('_max_move : ' + _max_move);
				max_move = max_move - $slide_item.innerHeight();
			}

			// console.log('$slide_item.innerHeight()' + $slide_item.innerHeight());

			// console.log( '$container.offset().top : ' + $container.offset().top );
			// console.log( '$container.outerHeight( true ) : ' + $container.outerHeight( true ) );
			// console.log( '$slide_item.innerHeight() : ' + $slide_item.innerHeight() );
			// console.log( 'offset_top : ' + offset_top );
			margin_bottom = max_move - min_move;
		}
		function bind() {
			$(window).bind("resize", init);
			$(window).bind("resize", scroll);
			$(window).bind("scroll", scroll);
		}
		function unbind() {
			$(window).unbind("resize", init);
			$(window).unbind("resize", scroll);
			$(window).unbind("scroll", scroll);
		}
		function scroll() {
			// if (mdlib._is_small_window()) {
			// 	cancel_fixed();
			// 	return;
			// }
			var header_height = 0;
			var wst = $(window).scrollTop();
			var _min_move = min_move;
			var _max_move = max_move;
			// console.log(_max_move);

			if (is_calc_header_height) {
				_min_move = _min_move - $(".header").outerHeight(true);
				_max_move = _max_move - $(".header").outerHeight(true);
				// console.log(_max_move);
			}

			// console.log('wst : ' + wst);
			// console.log('_min_move : ' + _min_move);
			// console.log('_max_move : ' + _max_move);

			/************************************************************************
			 * スクロール値が $container 要素の高さ内にいる時以下
			 ************************************************************************/
			if (wst > _min_move && wst < _max_move - offset_bottom) {
				// console.log( '## process1 ##' );
				set_fixed();
				/************************************************************************
				 * スクロールした値が min_move（$container要素の高さより小さい）以下の場合
				 ************************************************************************/
			} else if (wst <= min_move) {
				// console.log( '## process2 ##' );
				cancel_fixed(0);
				/************************************************************************
				 * スクロールした値が _max_move （$container要素の高さより大きい）以上の場合以下
				 ************************************************************************/
			} else if (wst >= _max_move - offset_bottom) {
				// console.log( '### process3 ###' );
				cancel_fixed(_max_move - offset_bottom - offset_top - _min_move);
				// execute($slide_item, );
			}
		}

		function set_fixed(_offset_top) {
			if (!isset(_offset_top)) {
				_offset_top = offset_top;
			}
			if (is_calc_header_height) {
				_offset_top = _offset_top + $(".header").outerHeight(true);
			}
			if (!is_fixed) {
				$slide_item.css({
					position: "fixed",
					top: _offset_top,
					"margin-top": 0,
				});
				is_fixed = true;
			}
		}
		function cancel_fixed(top) {
			if (is_fixed) {
				$slide_item.css({
					position: "absolute",
					"margin-top": 0,
					top: top,
				});
				is_fixed = false;
			}
		}
	};
	this.ScrollToTop = function (selector) {
		if (!isset(selector)) {
			selector = "#scroll_to_top";
		}
		this.fixedHeader = false;
		this.headerThreshold = 300;
		this.totopThreshold = 50;
		this.totopBtnVisible = false;
		this.defaultBottom = 0;

		var is_stop = false;
		$(window).scroll(
			function () {
				var ftop = 0;
				var wtop = $(window).scrollTop();
				var wheight = window.innerHeight;
				var offset = 0;

				/* if (! mdlib._is_small_window()) {
				ftop = $('.footer__bottom_area._pc').offset().top;
				offset = 0;
			} else {
				ftop = $('.footer__bottom_area._sp').offset().top;
				offset = -10;
			} */

				if (wtop + wheight > ftop + offset) {
					$(".footer").addClass("footer-scroll_to_top_stop");
					// $(selector).stop(true, true).css({bottom: ''});
					is_stop = true;
				} else {
					if (is_stop === true) {
						$(".footer").removeClass("footer-scroll_to_top_stop");
						is_stop = false;
						if (!mdlib._is_small_window()) {
							$(selector).css({ bottom: this.defaultBottom });
						} else {
							$(selector).css({ bottom: this.defaultBottom });
						}
					}
					// console.log('here');
					if ($(window).scrollTop() < this.totopThreshold && this.totopBtnVisible) {
						this.totopBtnVisible = false;
						if (!mdlib._is_small_window()) {
							$(selector).animate({ bottom: -200 }, 600, "easeOutQuint");
						} else {
							$(selector).animate({ bottom: -100 }, 400, "easeOutQuint");
						}
					} else if ($(window).scrollTop() > this.totopThreshold && !this.totopBtnVisible) {
						this.totopBtnVisible = true;
						if (!mdlib._is_small_window()) {
							$(selector).animate({ bottom: this.defaultBottom }, 600, "easeOutQuint");
						} else {
							$(selector).animate({ bottom: this.defaultBottom }, 400, "easeOutQuint");
						}
					}
				}
			}.bind(this)
		);
		this.totopBtnVisible = false;
		if (!mdlib._is_small_window()) {
			$(selector).animate({ bottom: -200 }, 400, "linear");
		} else {
			$(selector).css({ bottom: -100 });
		}
	};

	this.changeHeaderByScroll = function (point, class_active, class_start, class_end, duration) {
		if (!isset(point)) {
			point = $("#header").outerHeight(true);
		}
		if (!isset(class_active)) {
			class_active = "header-fixed";
		}

		$(window).on("scroll resize", function (e) {
			scroll(e);
		});
		var is_active = false;
		var scroll = function (e) {
			var scroll = $(window).scrollTop();

			if (point < scroll) {
				if (!is_active) {
					$("#header").addClass(class_active);
					$("#header").trigger("header_fixed");
					is_active = true;
				}
			} else {
				if (is_active) {
					$("#header").removeClass(class_active);
					$("#header").trigger("header_fixed_remove");
					is_active = false;
				}
			}
		};
		scroll();
	};

	this.windowPrint = function ($selector) {
		$($selector).on("click", function (e) {
			e.preventDefault();
			window.print();
		});
	};

	this.mwwp_form = function (use_ajaxzip3) {
		if ($(".mw_wp_form_input").length) {
			$(".input_text").show();
			$(".confirm_text").hide();
		} else if ($(".mw_wp_form_confirm").length) {
			$(".input_text").hide();
			$(".confirm_text").show();
		} else if ($(".mw_wp_form_complete").length) {
			$(".mwwp_form__head").hide();
		}
		if (use_ajaxzip3 && $('input[name="zip[data][1]"]').length) {
			$('input[name="zip[data][1]"]').on("change", function (e) {
				AjaxZip3.zip2addr("zip[data][0]", "zip[data][1]", "address", "address");
			});
		}
	};
})();

var kokan = new (function () {
	"use strict";

	this.Init = function () {
		// fontsize
		// $('html').on('changeFontSize_medium', function() {
		// 	$('.fontsize').addClass('fontsize-medium');
		// 	$('.fontsize').removeClass('fontsize-large');
		// });
		// $('html').on('changeFontSize_large', function() {
		// 	$('.fontsize').removeClass('fontsize-medium');
		// 	$('.fontsize').addClass('fontsize-large');
		// });

		$(".js-header_search_toggle").click(function (e) {
			console.log("js-header_search_toggle###");

			e.preventDefault();
			if (!$(".header").hasClass("_open_search")) {
				$(".header").addClass("_open_search");
				$('.header__search_input_area input[type="text"]').focus();
			} else {
				$(".header")
					.addClass("_close_search")
					.delay(500)
					.queue(function (next) {
						$(".header").removeClass("_close_search");
						$(".header").removeClass("_open_search");
						next();
					});
			}
		});
	};

	this.interview_init = function (mdlib) {
		$(".int_hero").imagesLoaded({ background: true }, function (e) {
			$(".int_hero").removeClass("_init");
			$(".int_hero").addClass("_loaded");
		});
	};

	this.index = function (mdlib) {
		var debug = false;

		if (debug) {
			$(".hero__main").css({
				"background-image": "url('/common/img/index/hero.jpg')",
				"background-position": "center center",
				"background-size": "cover",
				"background-repeat": "no-repeat",
				"background-color": "transparent",
			});
			$(".hero_area").imagesLoaded({ background: true }, function (e) {
				$(".hero_area")
					.removeClass("hero_area-init")
					.delay(2000)
					.queue(function (next) {
						$(".hero_area").addClass("hero_area-inited");

						$(".imain_content").addClass("imain_content-inited");
						next();
					});
			});
		} else {
			this.yt_player(mdlib);
			$("#yt_player").on("YTPStart", function (e) {
				// console.log('YTPStart');
				$(".hero_area")
					.removeClass("hero_area-init")
					.delay(2000)
					.queue(function (next) {
						$(".hero_area").addClass("hero_area-inited");
						$(".imain_content").addClass("imain_content-inited");

						next();
					});
			});
		}

		// 100vw に広がる yt player を 16:9 の比率にし続ける
		$(window).on("resize", function () {
			resize();
		});
		resize();

		function resize() {
			// console.log('resize');
			// var width = window.innerWidth;
			var $container = $("#yt_player_movie_container");
			var $player = $("#yt_player_movie");
			var pc_minheight = 780;
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
				sp_change_size();
			} else if (matchMedia("(max-width: 999px)").matches) {
				// 画面が sp サイズ高さ min-height 以下
				if (matchMedia("(max-height: " + sp_minheight + "px)").matches) {
					// console.log('ytplayer 999以下 sp_minheight 以下');
					change_size("height", sp_minheight);

					// 画面が sp サイズ高さ max-height 以上
				} else if (matchMedia("(min-height: " + sp_maxheight + "px)").matches) {
					// console.log('ytplayer 999以下 sp_min-height 以上');
					change_size("height", sp_maxheight);
				} else {
					// console.log('ytplayer 999以下 window_height');
					change_size("height", window_height);
				}
			} else {
				if (matchMedia("(min-height: " + pc_minheight + "px)").matches) {
					// 大きい時
					// console.log('ytplayer pc window height large');

					change_size("height", window_height);
				} else {
					// 小さい時
					// console.log('ytplayer pc window height small');

					base = "";
					if (window_width * to_height_ratio > pc_minheight) {
						base = "width";
					} else {
						base = "height";
					}

					change_size(base, pc_minheight);
				}
			}
		}

		function change_size(base, height) {
			// console.log(base);
			var root_padding = parseInt($(".root").css("padding-top"), 10);
			var $container = $("#yt_player_movie_container");
			var $player = $("#yt_player_movie");
			var $important_area = $("#iimportant_area");
			var $hero__main = $(".hero__main");
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
				var calc_height = window_width * to_height_ratio - important_area_height - root_padding;

				if (matchMedia("(max-width: 767px)").matches) {
					calc_height = window_width * to_height_ratio - root_padding;
				}

				$player.height(calc_height + title_height);
				$player.width((calc_height + title_height) * to_width_ratio);

				$container.height(calc_height);
				$hero__main.height(calc_height);
				// $container.width(calc_height * to_width_ratio);
			} else {
				// console.log(important_area_height);
				var calc_height = height - important_area_height - root_padding;

				if (matchMedia("(max-width: 767px)").matches) {
					calc_height = height - root_padding;
				}

				$player.height(calc_height + title_height);
				$player.width((calc_height + title_height) * to_width_ratio);

				$container.height(calc_height);
				$hero__main.height(calc_height);
				// $container.width(height * to_width_ratio);
			}

			// 共通
			if (matchMedia("(max-width: 767px)").matches) {
				$(".hero_area").height(calc_height);
			} else {
				$(".hero_area").height(calc_height + important_area_height);
			}
		}

		function sp_change_size() {
			style_cancel_for_sp();
			// console.log(base);
			var $container = $("#yt_player_movie_container");
			var $player = $("#yt_player_movie");
			var $hero__main = $(".hero__main");
			var window_width = window.innerWidth;

			// 高さ140px をタイトルと関連動画表示域として計算する
			var title_height = 350;
			var to_width_ratio = 320 / 300;
			var to_height_ratio = 300 / 320;

			var calc_height = window_width * to_height_ratio;
			$player.height(calc_height + title_height);
			$player.width((calc_height + title_height) * to_width_ratio);

			$container.height(calc_height);
			$hero__main.height(calc_height);
			// $container.width(calc_height * to_width_ratio);

			// 共通
			$(".hero_area").height(calc_height);
		}
		function style_cancel_for_sp() {
			// console.log('here');
			var $container = $("#yt_player_movie_container");
			var $player = $("#yt_player_movie");
			var $hero__main = $(".hero__main");
			var window_width = window.innerWidth;
			var to_height_ratio = 1080 / 1920;

			$(".hero_area").removeAttr("style");
			$player.removeAttr("style");
			$hero__main.removeAttr("style");

			// $container.height(window_width * to_height_ratio);
		}

		// hero より スクロールしたら header を表示する
		var is_show = false;
		// var header_height = get_header_height();
		var $header = $(".header");
		$(window).on("scroll", function (e) {
			// header_height = get_header_height();
			var header_bottom = $(".hero_area").height();
			var scroll = $(window).scrollTop();

			if (scroll > header_bottom) {
				header_show();
			} else {
				header_hide();
			}
		});

		$(window).on("start_pc change_to_pc", function (e) {
			header_hide();
		});

		function get_header_height() {
			return $(".header").height();
		}
		function header_show() {
			if (is_show === false) {
				if (!mdlib._is_small_window()) {
					// $('.header').appendTo('.header_default_wrapper');
					$header.removeClass("_hide");
					$header.addClass("_show");
				}
				is_show = true;
				// console.log('show');
			}
		}

		function header_hide() {
			if (is_show === true) {
				if (!mdlib._is_small_window()) {
					$header.removeClass("_show");
					$header
						.addClass("_hide")
						.delay(160)
						.queue(function (next) {
							$header.removeClass("_hide");
							// $('.header').appendTo('.header_index_wrapper');
							next();
						});
				}
				is_show = false;
				// console.log('hide');
			}
		}
	};

	this.hero_sub_menu = function (mdlib) {
		// console.log('hero_sub_menu');
		var timeout_duration = 200;
		var timeout_id = null;
		var $current_gnav = null;

		$(".js-open_hero_sub").on("mouseenter", function (e) {
			e.preventDefault();
			clear_hide_timer();
			clear_current();

			set_current(this);
			show(this);
		});
		$(".js-open_hero_sub").on("mouseleave", function (e) {
			console.log(".js-open_hero_sub mouseleave");
			set_hide_timer();
		});

		$(".js-hero_sub_area ._inner").on("mouseenter", function () {
			// console.log('.js-hero_sub_area ._inner mouseenter');
			clear_hide_timer();
		});
		$(".js-hero_sub_area ._inner").on("mouseleave", function () {
			// console.log('.js-hero_sub_area ._inner mouseleave');
			set_hide_timer();
		});

		$(".hero_sub_menu_body").on("mouseenter", function () {
			// console.log('.hero_sub_menu_body mouseenter');
			clear_hide_timer();
		});
		$(".hero_sub_menu_body").on("mouseleave", function () {
			// console.log('.hero_sub_menu_body mouseleave');
			clear_hide_timer();
		});

		function set_hide_timer() {
			console.log("set_hide_timer");
			timeout_id = setTimeout(function () {
				// console.log('set_hide_timer hide');
				hide();
			}, timeout_duration);
			// console.log('set_hide_timer');
		}

		function clear_hide_timer() {
			// console.log('clear_hide_timer');
			if (timeout_id) {
				clearTimeout(timeout_id);
				$(".js-hero_sub_area").stop(true, true);
			}
		}

		function show() {
			$(".js-hero_sub_area").stop(true, true).addClass("_show");
			$(".js-hero_sub_area").fadeIn(200);

			// console.log('show');
		}
		function hide() {
			if (!HERO_SUB_DEBUG) {
				$(".js-hero_sub_area").stop(true, true).removeClass("_show");
				$(".js-hero_sub_area").fadeOut(200);
				clear_current();
				// console.log('hide');
			}
		}

		function set_current(_this) {
			$current_gnav = $(_this);
			console.log("$current_gnav___00", $current_gnav);
			$current_gnav.addClass("_hover");

			$(_this).closest("li").find(".hero_sub_menu_body").show();
		}

		function clear_current() {
			console.log("$current_gnav___11", $current_gnav);

			if ($current_gnav !== null) {
				$current_gnav.removeClass("_hover");
				$current_gnav = null;
			}

			$(".hero_sub_menu_body").hide();
		}
	};

	this.outpatient_pagelink = function (mdlib) {
		$(".js-outpatient_pagelink").click(function (e) {
			e.preventDefault();
			var dep_slug = $(this).attr("href").split("#")[1];
			var target = $('.js-tab_area__content._show *[data-dep="' + dep_slug + '"]');
			var speed = 400;

			if (target.length > 0) {
				var body = "html,body";
				var easing = "easeOutExpo";
				var position = target.offset().top;
				var offset = $(".header").outerHeight() + $(".schedule_box__head").outerHeight();

				$(body).animate({ scrollTop: position - offset }, speed, easing);
			}
		});
	};

	this.submenu = function (mdlib, $menu, $li, $a, sub_class, sub_show_class) {
		var mdlib = mdlib;
		if ($menu.length > 0) {
			var duration = 300;
			var delay = 0;
			var is_stop = false;
			var open = function (e, _this) {
				// console.log('li:mouseenter', _this);
				var _delay = delay;

				$(_this)
					.delay(_delay)
					.queue(function (next) {
						$li.each(function (i, el) {
							if (el == _this) {
								show_submenu_content(this);
							} else {
								hide_submenu_content(this);
							}
						});
						// $(_this).find('.gnav__a').addClass('hover');
						next();
					});
			};
			var close = function (_this) {
				// console.log('li:mouseleave', _this);
				var $sub = $(_this).find("." + sub_class);
				$(_this).stop(true, true);
				hide_submenu_content(_this, 0);
			};
			if (!mdlib.mobilecheck()) {
				$li.hover(
					function (e) {
						open(e, this);
					},
					function (e) {
						close(this);
					}
				);
			} else {
				delay = 0;
				$li.on("click", function (e) {
					if ($(this).find("." + sub_class).length) {
						var _li = this;
						var $_a = $(this).find($a);
						var is_open = $(this).data("is_open");

						$li.each(function (i, el) {
							if (el === this) {
								hide_submenu_content(el);
								$(el).data("is_open", "");
							}
						});
						if (is_open !== "true") {
							$(_li).data("is_open", "true");
							show_submenu_content(this);
							e.preventDefault();
							e.stopPropagation();
						} else {
							$(_li).data("is_open", "");
							// hide_submenu_content(this);
							// e.preventDefault();
							// e.stopPropagation();
						}
						$(window).on("touchend", function (e) {
							if ($(e.target).closest($menu).length === 0) {
								$li.each(function (i, el) {
									hide_submenu_content(el);
									$(el).data("is_open", "");
								});
								$(window).off("touchend");
							}
						});
					}
				});
			}
		}

		function show_submenu_content(_this) {
			if (!mdlib._is_sp_window()) {
				// console.log('show_submenu_content : ', );
				var $sub = $(_this).find("." + sub_class);
				if ($sub.length > 0) {
					// $sub.stop(true, true).fadeIn( duration );
					$sub.addClass(sub_show_class);
				}
			}
		}

		function hide_submenu_content(_this) {
			if (!mdlib._is_sp_window()) {
				// console.log('hide_submenu_content : ', _this);
				var $sub = $(_this).find("." + sub_class);
				if ($sub.length > 0) {
					// $sub.stop(true, true).fadeOut(duration);
					$sub.removeClass(sub_show_class);
				}
			}
		}
	};

	this.ticker = function () {
		$("#js-ticker_area").marquee({
			easing: "easeOutQuart",
			pauseOnHover: false,
			pauseSpeed: 6000,
		});
	};

	this.slick_start = function () {
		if ($(".js-slider-fbanner").length) {
			var $sfbanner = $(".js-slider-fbanner");
			if ($sfbanner.children().length < 5) {
				while ($sfbanner.children().length < 5) {
					$sfbanner.children().each(function (i, el) {
						$(el).clone().appendTo($sfbanner);
					});
				}
			}
		}

		var option = {
			autoplay: true,
			pauseOnFocus: false,
			pauseOnHover: false,
			pauseOnDotsHover: false,
			centerPadding: 0,
			autoplaySpeed: 1000,
			arrows: false,
			dots: false,
			cssEase: "cubic-bezier(0.165, 0.84, 0.44, 1)",
			// easing: 'easeOutQuart',
			speed: 1300,
			// waitForAnimate: false,
		};
		$(".js-slider").each(function (i, _slider) {
			console.log("swiper__");

			var $slider = $(_slider);
			if ($slider.hasClass("js-slider-gnav")) {
				var timeout_duration = 200;

				var timeout_id = null;
				var $current_gnav = null;
				$(".js-open_gnav_sub").on("mouseenter", function (e) {
					e.preventDefault();
					clear_hide_timer();
					clear_current_gnav();

					var data_sub = parseInt($(this).attr("data-gnav-sub"));
					if ($("#gnav_sub" + data_sub).length) {
						console.log("data_sub###");
						var gnav_sub = $("#gnav_sub" + data_sub);
						var parent = gnav_sub.parent();
						var index = $(gnav_sub).index();
						set_current_gnav(this);
						gnav_sub_show();
						$slider.slick("slickGoTo", index);
					} else {
						console.log("set_hide###");
						set_hide_timer();
					}
				});
				$(".js-open_gnav_sub").on("mouseleave", function (e) {
					console.log("set_hide###2222");
					set_hide_timer();
				});
				$("#js-gnav_sub_area").on("mouseenter", function () {
					clear_hide_timer();
				});
				$("#js-gnav_sub_area").on("mouseleave", function () {
					set_hide_timer();
				});

				function set_hide_timer() {
					timeout_id = setTimeout(function () {
						gnav_sub_hide();
					}, timeout_duration);
					// console.log('set_hide_timer');
				}

				function clear_hide_timer() {
					if (timeout_id) {
						clearTimeout(timeout_id);
						$("#js-gnav_sub_area").stop();
					}
				}

				function gnav_sub_show() {
					console.log("gnav_sub_show");
					$("#js-gnav_sub_area").stop(true, true).addClass("_show");
					$("#header").addClass("_show_sub_menu");
					// console.log('gnav_sub_show');
				}

				function gnav_sub_hide() {
					console.log("gnav_sub_hide_01");
					if (!GNAV_DEBUG) {
						console.log("gnav_sub_hide_02");
						$("#js-gnav_sub_area").stop(true, true).removeClass("_show");
						$("#header").removeClass("_show_sub_menu");
						clear_current_gnav();
						// console.log('gnav_sub_hide');
					}
				}

				function set_current_gnav(gnav) {
					$current_gnav = $(gnav);
					$current_gnav.addClass("_hover");
				}
				function clear_current_gnav() {
					if ($current_gnav !== null) {
						$current_gnav.removeClass("_hover");
						$current_gnav = null;
					}
				}

				$slider.slick(
					$.extend({}, option, {
						autoplay: false,
						speed: 300,
						infinite: false,
						initialSlide: 0,
						adaptiveHeight: false,
						cssEase: "cubic-bezier(0.445, 0.05, 0.55, 0.95)", // easeInOutSine
						fade: true,
						waitForAnimate: false,
						responsive: [
							{
								breakpoint: 767,
								settings: {
									speed: 200,
								},
							},
						],
					})
				);
			} else if ($slider.hasClass("js-slider-news")) {
				$(".js-newstab_click").on("click", function (e) {
					e.preventDefault();
					var index = parseInt($(this).attr("href").match(/(\d+)/)[1], 10) - 1;
					$slider.slick("slickGoTo", index);
					$(".js-newstab_click").removeClass("_selected");
					$(this).addClass("_selected");
				});
				$slider.on("afterChange", function (slick, currentSlide, nextSlide) {
					$(".js-newstab_click").removeClass("_selected");
					// console.log(nextSlide);
					$(".js-newstab_click").eq(nextSlide).addClass("_selected");
				});
				$slider.slick(
					$.extend({}, option, {
						autoplay: false,
						speed: 600,
						infinite: false,
						initialSlide: 0,
						adaptiveHeight: true,
						cssEase: "cubic-bezier(0.445, 0.05, 0.55, 0.95)", // easeInOutSine
						responsive: [
							{
								breakpoint: 767,
								settings: {
									speed: 500,
									adaptiveHeight: true,
								},
							},
						],
					})
				);
			} else if ($slider.hasClass("js-slider-topics")) {
				$slider.slick(
					$.extend({}, option, {
						autoplay: false,
						speed: 600,
						infinite: false,
						initialSlide: 0,
						adaptiveHeight: false,
						cssEase: "cubic-bezier(0.445, 0.05, 0.55, 0.95)", // easeInOutSine

						arrows: true,
						appendArrows: "#topics_arrows",

						dots: true,
						appendDots: "#topics_dots",

						responsive: [
							{
								breakpoint: 767,
								settings: {
									speed: 500,
									adaptiveHeight: true,
								},
							},
						],
					})
				);
			} else if ($slider.hasClass("js-slider-fbanner")) {
				$slider.slick(
					$.extend({}, option, {
						autoplay: false,
						autoplaySpeed: 3 * 1000,
						infinite: true,
						// centerMode: true,
						initialSlide: 0,
						slidesToShow: 4,
						slidesToScroll: 1,
						speed: 900,
						cssEase: "cubic-bezier(0.445, 0.05, 0.55, 0.95)", // easeInOutSine
						// variableWidth: true,

						dots: false,

						arrows: true,
						appendArrows: "#fbanner_arrows",

						pauseOnFocus: true,
						pauseOnHover: true,
						pauseOnDotsHover: true,

						centerPadding: "0px",

						responsive: [
							{
								breakpoint: 1200,
								settings: {
									slidesToShow: 3,
								},
							},
							{
								breakpoint: 1000,
								settings: {
									slidesToShow: 2,
								},
							},
							{
								breakpoint: 680,
								settings: {
									slidesToShow: 1,
									speed: 800,
								},
							},
						],
					})
				);
			} else {
				$slider.slick(option);
			}
		});
	};

	this.yt_player = function (mdlib) {
		var IS_MOBILE_DEBUG = false;
		var id_array = ["-J8tJ9288lY"];

		var id = id_array[0];
		var unit = 1 / id_array.length;
		var random = Math.random();

		id = id_array[Math.floor(random / unit)];

		// document
		// https://github.com/pupunzi/jquery.mb.YTPlayer/wiki

		if (!IS_DEBUG) {
			if (IS_MOBILE_DEBUG !== true && !mdlib.mobilecheck()) {
				start();
			} else {
				$(".hero").removeClass("hero-pc");
				$(".hero").addClass("hero-mobile");
				$("#js-yt_player_start").click(function (e) {
					e.preventDefault();
					$(".hero").removeClass("hero-mobile");
					$(".hero").addClass("hero-mobilestarted");
					start();
				});
			}
		}

		function start() {
			// console.log('start');
			$("#yt_player").YTPlayer({
				videoURL: "https://www.youtube.com/watch?v=" + id + "&rel=0",
				containment: "#yt_player_movie",
				mute: true,
				showControls: false,
				showYTLogo: false,
				loop: true,
				autoPlay: true,
				ratio: "3/4",
				optimizeDisplay: false,
				rel: 0,
				autohide: 1,
				showinfo: 0,
				modestbranding: 1,
				// useOnMobile: true,
				// containment: 'yt_body',
				stopMovieOnBlur: false,
				playOnlyIfVisible: true,
				// mobileFallbackImage: '/common/img/main_sp.jpg',
				// onReady: function() {
				//	resize();
				// }
			});

			$("#yt_player").on("YTPStart", function (e) {
				$(".hero__sp_movie_btn_area").addClass("_started");
				ready_herotext_loop();
				// console.log('########################################');
				herotext_loop(true);
			});
		}

		// shadow 用に複製
		function ready_herotext_loop() {
			$("#js-herotext .line").each(function () {
				var first = $(this).children("._text");
				var clone = $(first).clone();

				clone.removeClass("_text");
				clone.addClass("_shadow");

				$(this).append(clone);
			});
		}
		function init_herotext_loop() {
			// console.log('init_herotext_loop');
			$("#js-herotext .slide").removeAttr("style");
			$("#js-herotext .line").removeAttr("style");
			$("#js-herotext .line > ._text").removeAttr("style");
			$("#js-herotext .line > ._shadow").removeAttr("style");
			$("#js-herotext .line > ._text > span").removeAttr("style");
			$("#js-herotext .line > ._shadow > span").removeAttr("style");

			// $('#js-herotext .line').each(function(i, line) {
			// 	$(line).children().each(function(i, child) {
			// 		$(child).empty();
			// 		$(child).html($(line).data('original_text'));
			// 	})
			// });
		}

		function herotext_loop(is_first_play) {
			// console.log('################ herotext_loop start');

			var reload_delay = 0;
			if (isset(is_first_play) && is_first_play === true) {
				reload_delay = 0.5;
			}

			// $('#js-herotext').removeClass('_scene2');
			// $('#js-herotext').removeClass('_scene3');
			// $('#js-herotext').removeClass('_scene4');
			// $('#js-herotext').addClass('_scene1');

			// var scene1_duration = 13 + reload_delay;
			// var scene2_duration = 17;
			// var scene3_duration = 30;
			// var scene4_duration = 25;

			var scene1_duration = 18 + reload_delay;
			var scene2_duration = 20;
			var scene3_duration = 19;
			var scene4_duration = 20;
			var ending_wait = 7;

			// var scene1_duration = 5 + reload_delay;
			// var scene2_duration = 5;
			// var scene3_duration = 5;
			// var scene4_duration = 5;
			// var ending_wait = 5;

			$("#js-herotext ._scene1 .line > *")
				.delay(reload_delay * 1000)
				.queue(function (next) {
					// console.log('scene1 start');
					$(this).textyleF({
						duration: 700,
						delay: 200,
						easing: "easeOutQuint",
						callback: null,
					});
					next();
				});
			// console.log('################ here next ' + scene1_duration * 1000);
			$("#js-herotext")
				.delay(scene1_duration * 1000)
				.queue(function (next) {
					// console.log('scene1_duration ' + scene1_duration + ' delay end');
					scene_hide($("#js-herotext ._scene1"));
					// $('#js-herotext').addClass('_scene2');

					$("#js-herotext ._scene2 .line > *")
						.stop(true, true)
						.delay((reload_delay + 1) * 1000)
						.queue(function (_next) {
							// console.log('scene2 start');
							$(this).textyleF({
								duration: 700,
								delay: 100,
								easing: "easeOutQuint",
								callback: null,
							});
							_next();
						});

					next();
				})
				.delay(scene2_duration * 1000)
				.queue(function (next) {
					// console.log('scene2_duration ' + scene2_duration + ' delay end');
					scene_hide($("#js-herotext ._scene2"));

					$("#js-herotext ._scene3 .line > *")
						.stop(true, true)
						.delay((reload_delay + 1) * 1000)
						.queue(function (_next) {
							// console.log('scene3 start');
							$(this).textyleF({
								duration: 700,
								delay: 75,
								easing: "easeOutQuint",
								callback: null,
							});
							_next();
						});
					next();
				})
				.delay(scene3_duration * 1000)
				.queue(function (next) {
					// console.log('scene3_duration ' + scene3_duration + ' delay end');
					scene_hide($("#js-herotext ._scene3"));

					$("#js-herotext ._scene4 .line > *")
						.stop(true, true)
						.delay((reload_delay + 1) * 1000)
						.queue(function (_next) {
							// console.log('scene4 start');
							$(this).textyleF({
								duration: 700,
								delay: 50,
								easing: "easeOutQuint",
								callback: null,
							});
							_next();
						});
					next();
				})
				.delay(scene4_duration * 1000)
				.queue(function (next) {
					// console.log('scene4_duration ' + scene4_duration + ' delay end');
					scene_hide($("#js-herotext ._scene4"));
					next();
				})
				.delay(ending_wait * 1000)
				.queue(function (next) {
					// console.log('ending_wait ' + ending_wait + ' delay end');
					init_herotext_loop();
					herotext_loop();

					next();
				});

			function scene_hide($el) {
				$el.fadeOut(300);
			}
		}
	};

	// this.sticky_schedule = function(mdlib) {

	// 	var sticky_item = null;
	// 	function start() {
	// 		console.log('start');
	// 		sticky_item = stickybits('.js-sticky_schedule', {
	// 			useStickyClasses: true,
	// 			useFixed: true,
	// 			stickyBitStickyOffset: $('.header').outerHeight(true)
	// 		});
	// 	}

	// 	$(window).on('change_to_sp change_to_tb change_to_pc', function(e) {
	// 		sticky_item.cleanup();
	// 		console.log('update' + $('.header').outerHeight(true));
	// 		sticky_item = stickybits('.js-sticky_schedule', {
	// 			useStickyClasses: true,
	// 			useFixed: true,
	// 			stickyBitStickyOffset: $('.header').outerHeight(true)
	// 		})
	// 		start();
	// 	});

	// 	start();
	// },

	this.loading_oacity = function () {
		$(".js-loading-oacity").each(function (i, el) {
			var height_percent = $(el).data("height");

			if (height_percent) {
				// console.log(height_percent);
				var height_pixel = $(".main_content_area").width() * (height_percent / 100);
				// console.log(height_pixel);
				$(el).css("min-height", height_pixel);
			}
			$(el).imagesLoaded({ background: true }, function (e) {
				// console.log(el);
				$(el).addClass("_loaded");
			});
		});
	};
	this.open_menu_panel = function (mdlib) {
		var event_start = mdlib.mobilecheck() ? "click" : "click";
		var event_end = mdlib.mobilecheck() ? "touchend" : "click";
		var $panel = $("#menu_panel");
		var $button = $(".js-open_menu_panel");

		// menu_panel 共通のボタンの処理
		$button.on(event_start, function (e) {
			e.preventDefault();
			e.stopPropagation();

			if (!$panel.hasClass("_open")) {
				open($(this));
			} else {
				close($(this));
			}
			return false;
		});

		// menu_panel 共通のパネルを押したら閉じる処理
		$panel.click(function (e) {
			if ($(e.target).closest("a").length === 0) {
				close();
				return false;
			}
		});

		// menu_panel 共通の開く
		function open($button) {
			// $button.addClass('_open');
			$panel.appendTo("body").queue(function (next) {
				$panel.show();
				$panel.addClass("_open");
				$panel.focus();
				next();
			});
		}

		// menu_panel 共通の閉じる
		function close() {
			if ($panel.hasClass("_open")) {
				// $button.removeClass('_open');
				$panel
					.addClass("_close")
					.delay(1000)
					.queue(function (next) {
						$panel.removeClass("_open");
						$panel.removeClass("_close");
						next();
					});

				// $panel.fadeOut(3000, function() {
				// 	$panel.removeClass('_open');
				// 	// $panel.css({
				// 	// 	'height': 0
				// 	// });
				// 	$panel.stop(true).delay(10).queue(function() {
				// 		$panel.hide();
				// 	});
				// });
			}
		}
	};
})();

function isset(data) {
	return typeof data != "undefined";
}

/**************************
 /access/ ページ用の google maps callback関数
*/
function make_google_maps() {
	var id = "gmap";
	var scale = 16;
	var p1 = 35.468603;
	var p2 = 139.458637;
	_make_google_maps(id, scale, p1, p2);
}

/**************************
 トップページ用の google maps callback関数
*/
function make_google_maps_index() {
	var id = "gmap";
	var scale = 16;
	var p1 = 35.468603;
	var p2 = 139.458637;

	var marker = {
		position: new google.maps.LatLng(p1, p2),
		icon: {
			url: "/common/img/pin_index.png",
			scaledSize: new google.maps.Size(240, 90),
		},
	};
	_make_google_maps(id, scale, p1, p2, marker);
}

function _make_google_maps(id, scale, p1, p2, marker) {
	// 地図
	var map = new google.maps.Map(document.getElementById(id), {
		zoom: scale,
		center: new google.maps.LatLng(p1, p2),
		scrollwheel: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: false,
	});

	if (!marker) {
		marker = {
			position: new google.maps.LatLng(p1, p2),
			map: map,
			// icon: {
			// 	url: '/common/img/pin.png',
			// 	scaledSize: new google.maps.Size(180, 62)
			// }
		};
	} else {
		marker.map = map;
	}
	// マーカー
	new google.maps.Marker(marker);

	// google.maps.event.addListener(map,dragstart,
	// 	function() {
	// 	infoWindow.close();
	// });
}

/********************************************
 *
 * アスペクト比 を固定
 *
 * http://shanabrian.com/web/javascript/resize-aspect.php
 *
 ********************************************/
function resizeMAR(originWidth, originHeight, resizeNumber, resizeMove, otherSideNumber) {
	var result = false;
	if (originWidth && originHeight && resizeNumber && resizeMove) {
		if (String(originWidth).match(/^[0-9]+$/) && String(originHeight).match(/^[0-9]+$/) && String(resizeNumber).match(/^[0-9]+$/) && resizeMove.match(/^(width|height)$/)) {
			var newWidth = 0,
				newHeight = 0,
				reResizeMove = "";

			if (resizeMove === "width") {
				newHeight = (resizeNumber * originHeight) / originWidth;
				newWidth = (newHeight * originWidth) / originHeight;
				reResizeMove = "height";
			} else {
				newWidth = (resizeNumber * originWidth) / originHeight;
				newHeight = (newWidth * originHeight) / originWidth;
				reResizeMove = "width";
			}

			if (otherSideNumber && String(otherSideNumber).match(/^([0-9]+|auto)$/) && newHeight > otherSideNumber) {
				reResult = resizeMAR(newWidth, newHeight, otherSideNumber, reResizeMove);
				if (reResult) {
					result = reResult;
				}
			} else {
				result = {
					width: newWidth,
					height: newHeight,
				};
			}
		}
	}
	return result;
}

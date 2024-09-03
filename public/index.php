<?php $use_wordpress=1; ?>
<?php $is_toppage=1 ?>
<?php require_once 'include/index_init.php'; ?>
<?php require_once 'include/common.php'; ?>
<?php $page_title = SITE_NAME; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title><?php echo $page_title ?></title><?php include DIR_SITE_INCLUDE . 'head.php'; ?>
	<link rel="stylesheet" href="/common/css/calendar.css" media="all">
	<link rel="stylesheet" href="/common/css/index.css?202405" media="all">
	<link rel="stylesheet" href="/common/css/index_animation.css" media="screen and (min-width:768px), print">
	<!-- Ptengine Tag -->
	<script src="https://js.ptengine.jp/742jblpe.js"></script>
	<!-- End Ptengine Tag -->
</head>
<body>
	<?php include DIR_SITE_INCLUDE . 'body_top.php'; ?>
	<div class="root root-index">
		<?php include DIR_SITE_INCLUDE . 'header.php'; ?>
		<div id="sitesearch_content">
			<div class="imain_content" id="main_content">
				<div class="hero_area hero_area-init" id="hero_area">
					<div class="hero">
						<div class="img_wrap">
							<img class="bg" src="/common/img/top/mv/main.webp" alt="" loading="lazy">
							<img class="deco _bottom" src="/common/img/top/mv/bg_deco.webp" alt="" loading="lazy">
							<img class="deco _tree" src="/common/img/top/mv/deco.webp" alt="" loading="lazy" width="135" height="160">
						</div>
					</div>
				</div>

				<div class="inews">
					<div class="container">
						<div class="news_area">
							<div class="common_title news_title">
								<div class="title_box">
									<span class="title _en">news</span>
									<span class="title _ja">
										<img src="/common/img/top/title/news.webp" alt="お知らせ" loading="lazy" width="152" height="35">
									</span>
								</div>
								<div class="btn_box">
									<a class="common_btn" href="/news/">一覧へ</a>
								</div>
							</div>
							<ul class="newsline_list">

									<p>お知らせはありません。</p>
							</ul>
						</div>
					</div>
				</div>
				<div class="iabout">
					<div class="container">
						<div class="about_area">
							<div class="img_box">
								<div class="inner">
									<img class="image" src="/common/img/top/about/img_01.webp" alt="" loading="lazy" width="540" height="438">
									<img class="deco _01" src="/common/img/top/illust/01.webp" alt="" loading="lazy" width="215" height="135">
								</div>
							</div>
							<div class="text_box">
								<div class="common_title">
									<div class="title_box">
										<span class="title _en">about</span>
										<span class="title _ja">
											<img src="/common/img/top/title/about.webp" alt="" loading="lazy" width="272" height="34">
										</span>
									</div>
								</div>
								<div class="body">
									<p>私たちは小規模多機能型居宅介護として「通い」を中心に、ご利用者様の機能や希望に応じて、「訪問」や「泊まり」を組み合わせたサービスを提供し、在宅での生活が継続できるように支援いたします。</p>
									<div class="btn_box">
										<a class="common_btn" href="/about/">小規模多機能型居宅介護とは</a>
									</div>
								</div>
								<img class="deco _02 isp_none" src="/common/img/top/illust/02.webp" alt="" loading="lazy" width="275" height="250">
							</div>
						</div>
						<img class="deco _02 ipc_none" src="/common/img/top/illust/02.webp" alt="" loading="lazy" width="275" height="250">
					</div>
					<img class="bg" src="/common/img/top/service/bg.webp" alt="" loading="lazy">
				</div>
				<div class="iservice">
					<div class="container">
						<div class="service_area">
							<div class="title_wrap">
								<img class="title_deco" src="/common/img/top/title/deco/01.webp" alt="" loading="lazy" width="70" height="30">
								<span class="title _ja">
									<img src="/common/img/top/title/service.webp" alt="サービス" loading="lazy" width="151" height="35">
								</span>
								<span class="_en">service</span>
							</div>
							<ul class="service_list">
								<li>
									<div class="inner">
										<div class="img_box">
											<img src="/common/img/top/service/img_01.webp" alt="" loading="lazy" width="311" height="170">
										</div>
										<div class="text_box">
											<span class="num _pink">01</span>
											<span class="title"class="title">通いのサービス</span>
											<p>
												家庭的な雰囲気で利用者の方がなじみやすく、安心してすごせる環境を作ります。<br>
												<span class="careful">※1日15名様まで</span>
											</p>
										</div>
									</div>
									<div class="btn_box">
										<a class="common_btn _pink" href="/service/#section_01">詳しくはこちら</a>
									</div>
								</li>
								<li>
									<div class="inner">
										<div class="img_box">
											<img src="/common/img/top/service/img_02.webp" alt="" loading="lazy" width="311" height="170">
										</div>
										<div class="text_box">
											<span class="num _blue">02</span>
											<span class="title">泊まりのサービス</span>
											<p>
												家庭的な雰囲気で利用者の方がなじみやすく、安心してすごせる環境を作ります。<br>
												<span class="careful">※1日9名様まで</span>
											</p>
										</div>
									</div>
									<div class="btn_box">
										<a class="common_btn _blue" href="/service/#section_02">詳しくはこちら</a>
									</div>
								</li>
								<li>
									<div class="inner">
										<div class="img_box">
											<img src="/common/img/top/service/img_03.webp" alt="" loading="lazy" width="311" height="170">
										</div>
										<div class="text_box">
											<span class="num _yellow">03</span>
											<span class="title">訪問介護のサービス</span>
											<p>
												ご自宅でお過ごしの時には、見守り、安否確認、身の回りの介護などのためにスタッフがお伺いいたします。<br>
												お電話での安否確認も行います。
											</p>
										</div>
									</div>
									<div class="btn_box">
										<a class="common_btn _yellow" href="/service/#section_03">詳しくはこちら</a>
									</div>
								</li>
							</ul>
						</div>
						<img class="deco _01" src="/common/img/top/illust/05.webp" alt="" loading="lazy" width="200" height="216">
						<img class="deco _02" src="/common/img/top/illust/03.webp" alt="" loading="lazy" width="135" height="162">
					</div>
					<div class="bg_bottom">
						<img class="_01" src="/common/img/top/service/bg_bottom_01.webp" alt="" loading="lazy" width="750" height="375">
						<img class="_02" src="/common/img/top/service/bg_bottom_02.webp" alt="" loading="lazy" width="1217" height="495">
					</div>
				</div>
				<div class="iinfo">
					<div class="container">
						<div class="info_area">
							<div class="info_1">
								<div class="common_title _info_title">
									<div class="title_box">
										<span class="title _en">infomation</span>
										<span class="title _ja">
											<img src="/common/img/top/title/infomation.webp" alt="施設情報" loading="lazy" width="155" height="35">
										</span>
									</div>
								</div>
								<div class="info_list">
									<div class="info_item">
										<div class="title_box">
											<img src="/common/img/icon/01.webp" alt="" loading="lazy" width="25" height="25">
											<span class="title">施設名</span>
										</div>
										<div class="text">小規模多機能型居宅介護ポプリ</div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<img src="/common/img/icon/02.webp" alt="" loading="lazy" width="25" height="25">
											<span class="title">住所</span>
										</div>
										<div class="text">〒306-0045　<span class="address">茨城県古河市駒ヶ崎14-1</span></div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<img src="/common/img/icon/03.webp" alt="" loading="lazy" width="25" height="25">
											<span class="title">営業日</span>
										</div>
										<div class="text">365日</div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<img src="/common/img/icon/04.webp" alt="" loading="lazy" width="25" height="25">
											<span class="title">営業時間</span>
										</div>
										<div class="text">9：00 ～ 16：00（通い）</div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<img src="/common/img/icon/05.webp" alt="" loading="lazy" width="25" height="25">
											<span class="title">訪問</span>
										</div>
										<div class="text">24時間</div>
									</div>
								</div>
							</div>
							<div class="info_2">
								<div class="map_wrap">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1742.4014078211487!2d139.70571512666226!3d36.17068967569332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018b54c6cef390f%3A0xb6fb5e851bf15232!2z44CSMzA2LTAwNDUg6Iyo5Z-O55yM5Y-k5rKz5biC6aeS44Kx5bSO77yR77yU!5e0!3m2!1sja!2sjp!4v1718704608239!5m2!1sja!2sjp" width="1800" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="icontact">
					<div class="container">
						<div class="contact_wrap">
							<img class="deco" src="/common/img/top/illust/04.webp" alt="" loading="lazy" width="390" height="375">
							<div class="top">
								<img src="/common/img/top/title/contact.webp" alt="お問い合わせ" loading="lazy" width="194" height="35">
							</div>
							<div class="bottom">
								<span class="text">お問い合わせ、お申し込みなどはこちらまでお願いします。</span>
								<ul class="contact_list">
									<li>
										<img src="/common/img/icon/tel.webp" alt="" loading="lazy" width="42" height="42">
										<div class="title">
											<span class="num"><a href="tel:0280-47-4306">0280-47-4306</a></span>
											<span class="rear_text">（ポプリ直通）</span>
										</div>
									</li>
									<li>
										<img src="/common/img/icon/fax.webp" alt="" loading="lazy" width="42" height="42">
										<div class="title">
											<span class="num"><a href="tel:0280-47-4306">0280-47-4306</a></span>
										</div>
									</li>
									<li>
										<img src="/common/img/icon/mail.webp" alt="" loading="lazy" width="42" height="42">
										<div class="title">
											<span class="mail">popuri@kogahosp.jp</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include DIR_SITE_INCLUDE . 'sidebar.php'; ?>
		<?php include DIR_SITE_INCLUDE . 'footer.php'; ?>
	</div>
	<?php include DIR_SITE_INCLUDE . 'menu/sp_menu.php'; ?>
	<?php include DIR_SITE_INCLUDE . 'script.php'; ?>
	<script src="/common/js/calendar.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="/common/js/lib/jquery.marquee.min.js"></script>
	<script src="/common/js/lib/ytplayer/jquery.mb.YTPlayer.min.js"></script>
</body>
</html>

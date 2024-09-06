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
						</div>
					</div>
				</div>

				<div class="pagelink_area" id="js-anchor_link">
					<ul class="pagelink_list cancel">
						<li class="pagelink"><a href="#section1"><span>居宅介護<br>支援事業とは</span></a></li>
						<li class="pagelink"><a href="#section2"><span>新規御相談</span></a></li>
						<li class="pagelink"><a href="#section3"><span>業務内容</span></a></li>
						<li class="pagelink"><a href="#section4"><span>介護保険内<br>サービス</span></a></li>
						<li class="pagelink"><a href="#section5"><span>施設情報</span></a></li>
						<li class="pagelink"><a href="https://www.kogahosp.jp/recruit/shiki/" target="_blank"><span class="ext">採用情報</span></a></li>
					</ul>
				</div>
				<div class="igreeting" id="section1">
					<div class="greeting_container">
						<div class="common_title greeting_title">
							<div class="title_box">
								<h2 class="title">
									ごあいさつ
								</h2>
							</div>
						</div>
						<div class="text_box">
							<div class="administrator_name">
								<span>医療法人徳洲会</span>
								<span>古河総合病院居宅介護支援事業所　管理者</span>
							</div>
							<div class="greeting_desc">
								<p>私たちは、医療法人徳洲会 古河総合病院の居宅介護支援事業所として、医療やリハビリなどの専門職と併設された訪問看護・訪問介護・通所リハビリ・小規模多機能ケアとの連携が強く、情報共有もスムーズに行えます。そのため速やかに介護サービスに繋げることができる利点があります。</p>
								<p>利用者様の意向に沿ったサービスを丁寧に説明し、その生活を支えていくために職員一同日々向上に努めてまいります。</p>
							</div>
						</div>
						<div class="deco _01"><img src="/common/img/top/deco/leaf_deco.webp" alt=""></div>
						<div class="deco _02"><img src="/common/img/top/deco/leaf_deco.webp" alt=""></div>
					</div>
				</div>
				<div class="iabout">
					<div class="about_title"><img src="/common/img/top/about/about_title.webp" alt="居宅介護支援事業とは"></div>
					<p>居宅介護支援事業所ではケアマネジャーが関係市町村、地域の保険・医療・福祉サービスとの綿密な連携を図り介護保険や介護の相談などを承り総合的な介護サービス提供が受けられるよう調整を行わせていただいております。</p>
				</div>

				<div class="inews">
					<div class="container">
						<div class="image_wrapper">
							<img src="/common/img/top/news/news_image.webp" alt="">
							<div class="deco"><img src="/common/img/top/deco/flower_deco.webp" alt=""></div>
						</div>
						<div class="news_area">
							<div class="common_title news_title">
								<div class="title_box">
									<h2>
										お知らせ
									</h2>
								</div>

							</div>
							<ul class="newsline_list">
								<li>
									<a class="newsline" href="https://koga-shiki.md-dev3.com/archives/uncategorized/73">
										<div class="head">
											<div class="date">
												<span class="year">2024</span>.<span class="month">08</span>.<span class="day">01</span>
											</div>
										</div>
										<div class="body">
											<div class="ex  ">テスト</div>
										</div>
									</a>
								</li>
								<li>
									<a class="newsline  " href="https://koga-shiki.md-dev3.com/archives/uncategorized/73">
										<div class="head">
											<div class="date">
												<span class="year">2024</span>.<span class="month">08</span>.<span class="day">01</span>
											</div>
										</div>
										<div class="body">
											<div class="ex  ">テスト</div>
										</div>
									</a>
								</li>
							</ul>
							<div class="btn_box">
								<a class="common_btn" href="/news/">一覧を見る</a>
							</div>
						</div>
					</div>
				</div>
				<div class="iconsul">
					<div class="container">
						<div class="title_box">
							<h2>新規御相談</h2>
						</div>
						<ul class="consul_list">
							<li>
								<div class="num"><span class="small">#</span>01</div>
								<div class="inner">
									<div class="icon_box">
										<div><img src="/common/img/top/consul/consul_icon01.webp" alt=""></div>
									</div>
									<div class="text_box">
										<h3><span>相談</span></h3>
										<p>古河総合病院居宅介護支援事業所にお電話またはご来所ください。</p>
									</div>
								</div>
							</li>
							<li>
								<div class="num"><span class="small">#</span>02</div>
								<div class="inner">
									<div class="icon_box">
										<div><img src="/common/img/top/consul/consul_icon02.webp" alt=""></div>
									</div>
									<div class="text_box">
										<h3><span>申請の代行</span></h3>
										<p>介護保険の申請を行なっていない場合は申請の代行をさせていただきます。</p>
									</div>
								</div>
							</li>
							<li>
								<div class="num"><span class="small">#</span>03</div>
								<div class="inner">
									<div class="icon_box">
										<div><img src="/common/img/top/consul/consul_icon03.webp" alt=""></div>
									</div>
									<div class="text_box">
										<h3><span>ヒアリング</span></h3>
										<p>ケアマネジャーがご自宅や入院先に訪問させていただき健康状態や生活のご様子、ご希望などをお聞きさせていただきます。</p>
									</div>
								</div>
							</li>
							<li>
								<div class="num"><span class="small">#</span>04</div>
								<div class="inner">
									<div class="icon_box">
										<div><img src="/common/img/top/consul/consul_icon04.webp" alt=""></div>
									</div>
									<div class="text_box">
										<h3><span>サービス計画書作成</span></h3>
										<p>ご本人・ご家族の方と相談しながらご希望の生活が実現するようサービス計画書を作成させていただきます。</p>
									</div>
								</div>
							</li>
							<li>
								<div class="num"><span class="small">#</span>05</div>
								<div class="inner">
									<div class="icon_box">
										<div><img src="/common/img/top/consul/consul_icon05.webp" alt=""></div>
									</div>
									<div class="text_box">
										<h3><span>契約</span></h3>
										<p>サービス事業所と契約を結びます。スムーズにサービスが導入できるよう調整させていただきます。</p>
									</div>
								</div>
							</li>
							<li>
								<div class="num"><span class="small">#</span>06</div>
								<div class="inner">
									<div class="icon_box">
										<div><img src="/common/img/top/consul/consul_icon06.webp" alt=""></div>
									</div>
									<div class="text_box">
										<h3><span>経過観察</span></h3>
										<p>経過の観察させていただき状況に応じてプランの変更をさせていただきます。</p>
									</div>
								</div>
							</li>
						</ul>
						<div class="deco _02"><img src="/common/img/top/deco/leaf_deco.webp" alt=""></div>

					</div>

				</div>
				<div class="iwork">
					<div class="container">
						<div class="text_area">
							<div class="common_title work_title">
								<div class="title_box">
									<h2>業務内容</h2>
								</div>

							</div>
							<p>要介護者等や介護者の相談援助、申請及び更新申請の代行、介護支援サービスのための課題分析、介護サービス計画書の作成、サービス担当者会議の開催、サービスに関する説明と同意の確認、サービス実施事業所との連絡調整、要介護者等の継続的な状況把握、在宅から介護施設に入所する場合の援助など、給付業務</p>
						</div>
						<div class="image_wrapper">
							<img src="/common/img/top/work/work_image.webp" alt="">
							<div class="deco"><img src="/common/img/top/deco/flower_deco.webp" alt=""></div>
						</div>

					</div>
				</div>
				<div class="iservice">
					<div class="inner">
						<div class="service_image">
							<img src="/common/img/top/service/service_image.webp" alt="">
						</div>
					</div>
					<div class="container">
						<div class="title_box">
							<h2>在宅で介護保険の使えるサービス</h2>
						</div>
						<div class="service_column">
							<div class="l">
								<div class="h3_box">
									<h3>支援1・2</h3>
								</div>

								<p>介護予防支援、介護予防訪問介護、介護予防訪問入浴、介護予防居宅療養管理指導、介護予防訪問介護、介護予防通所介護、介護予防所リハビリテーション、介護予防特定施設入所者生活介護、介護予防短期入所療養介護、介護予防福祉用具貸与、介護予防住宅改修費支給、特定介護予防福祉用具購入</p>
							</div>
							<div class="r">
								<div class="h3_box">
									<h3>要介護1〜5</h3>
								</div>
								<p>居宅介護支援、訪問介護、訪問入浴、居宅療養管理指導、訪問介護、通所介護、通所リハビリテーション、特定施設入居者生活介護、短期入所生活介護、短期入所療養介護、福祉用具貸与、居宅介護住宅改修費支給、特定福祉用具購入</p>

							</div>
						</div>
					</div>

				</div>
				<div class="iinfo">

					<div class="container">
						<div class="title_box">
							<h2>施設情報</h2>
						</div>
						<div class="info_area">
							<div class="info_2">
								<div class="map_wrap">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1742.4014078211487!2d139.70571512666226!3d36.17068967569332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018b54c6cef390f%3A0xb6fb5e851bf15232!2z44CSMzA2LTAwNDUg6Iyo5Z-O55yM5Y-k5rKz5biC6aeS44Kx5bSO77yR77yU!5e0!3m2!1sja!2sjp!4v1718704608239!5m2!1sja!2sjp" width="1800" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								</div>
							</div>
							<div class="info_1">
								<div class="info_list">
									<!-- <div class="info_item">
										<div class="title_box">
											<img src="/common/img/icon/01.webp" alt="" loading="lazy" width="25" height="25">
											<span class="title">施設名</span>
										</div>
										<div class="text">小規模多機能型居宅介護ポプリ</div>
									</div> -->
									<div class="info_item">
										<div class="title_box">
											<span class="title">住所</span>
										</div>
										<div class="text">〒0280-47-1106　<span class="address">茨城県古河市鴻巣1175-1</span></div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<span class="title">TEL</span>
										</div>
										<div class="text">0280-47-1106（居宅介護支援事業所直通）</div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<span class="title">FAX</span>
										</div>
										<div class="text">0280-47-1107</div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<span class="title">実施地域</span>
										</div>
										<div class="text">茨城県古河市、埼玉県旧北川辺町、旧大利根町</div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<span class="title">営業時間</span>
										</div>
										<div class="text">8：30～17：00</div>
									</div>
									<div class="info_item">
										<div class="title_box">
											<span class="title">利用料金</span>
										</div>
										<div class="text">全額介護保険からの給付となるため自己負担の発生はありません</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="icontact">
					<div class="container">
						<h2>お問い合わせはこちら</h2>
						<div class="tel_box">
							<span class="contact_icon"><img src="/common/img/icon/contact_icon.webp" alt=""></span>
							<span class="num"><a href="tel:0280-47-4306">0280-47-4306</a></span><span class="desc">（居宅介護支援事業所直通）</span>

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

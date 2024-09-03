<?php $use_wordpress=0; ?>
<?php require_once '../include/common.php'; ?>
<?php $page_title = "サービス" ?>
<?php
	use MedicalDesign as MD;
	require_once DIR_SITE_LIB . 'Helper.php';
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $page_title ?> | <?= SITE_NAME ?></title><?php include DIR_SITE_INCLUDE . 'head.php'; ?>
		<link rel="stylesheet" href="/common/css/service.css" media="all" />
	</head>
	<body>
		<div class="root">
			<?php include DIR_SITE_INCLUDE . 'header.php'; ?>
			<div class="category_line">
				<div class="category_line_inner">
					<div class="category_title">
						<img class="deco" src="/common/img/category/title_deco.webp" alt="" loading="lazy" width="70" height="30">
						<img class="ja" src="/common/img/category/title_service.webp" alt="サービス" loading="lazy" width="149" height="32.5">
						<span class="en">service</span>
					</div>
				</div>
			</div>

			<div class="main_content_area">
				<div class="container">
					<div class="breadcrumb_area">
						<span class="line"></span>
						<ul class="bread_crumb cancel">
							<li class="level-1 top"><a href="/">トップ</a></li>
							<li class="level-2 sub current">サービス</li>
						</ul>
					</div>

					<section class="main_content" id="main_content">
						<section class="section _01" id="section_01">
							<div class="_top">
								<div class="_l">
									<div class="image_wrapper">
										<img src="/common/img/service/serviceimage_01.webp" alt="">
									</div>
								</div>
								<div class="_r">
									<h2>通いのサービス</h2>
									<p>家庭的な雰囲気で利用者の方がなじみやすく、安心してすごせる環境を作ります。</p>
									<p class="alert">※1日15名様まで</p>
								</div>
							</div>
							<div class="_bottom">
								<h3>ご利用料金(介護保険対象内)</h3>
								<table  class="table responsive">
									<tr>
										<th>要支援1</th>
										<th>要支援2</th>
										<th>要介護1</th>
										<th>要介護2</th>
										<th>要介護3</th>
										<th>要介護4</th>
										<th>要介護5</th>
									</tr>
									<tr>
										<td><div><span class="fee">4,498</span>円</div></td>
										<td><div><span class="fee">8,047</span>円</div></td>
										<td><div><span class="fee">11,505</span>円</div></td>
										<td><div><span class="fee">16,432</span>円</div></td>
										<td><div><span class="fee">23,439</span>円</div></td>
										<td><div><span class="fee">25,765</span>円</div></td>
										<td><div><span class="fee">28,305</span>円</div></td>
									</tr>
								</table>
								<p class="alert">※登録期間が1ヶ月に満たない場合は日割りになります。</p>
								<h3>通所介護（デイサービス）</h3>
								<p>食事、入浴の提供や、日常動作訓練、レクリエーションなどが受けられます。</p>
							</div>
						</section>
						<section class="section _02" id="section_02">
							<div class="_top">
								<div class="_l">
									<div class="image_wrapper">
										<img src="/common/img/service/serviceimage_02.webp" alt="">
									</div>
								</div>
								<div class="_r">
									<h2>泊まりのサービス</h2>
									<p>通いの延長で、そのままお泊まりいただくこともできます。なじみのスタッフが付き添うので、安心しておやすみいただけます。</p>
									<p class="alert">※1日9名様まで</p>
								</div>
							</div>
							<div class="_bottom">
								<h3>自費</h3>
								<table class="table responsive">
									<tr>
										<th>食費</th>
										<th>宿泊代</th>
										<th>おむつ代</th>
										<th>娯楽費</th>
										<th>その他</th>
									</tr>
									<tr>
										<td>
											<div>
												<p>
													<span class="fee_wrapper"><span>朝 /</span><span class="fee">400</span><span>円</span></span>
													<span class="fee_wrapper"><span>昼 /</span><span class="fee">500</span><span>円</span></span>
													<span class="fee_wrapper"><span>夜 /</span><span class="fee">450</span><span>円</span></span>
													<span class="alert">※昼はおやつ代含</span>
												</p>
											</div>
										</td>
										<td>
											<div>
												<div>
													<span class="fee_wrapper"><span>1日  /</span><span><span class="fee">2,500</span><span>円</span></span></span>
													<span class="alert">※1泊2日の場合</span>
												</div>
											</div>
										</td>
										<td><div class="txt">実費</div></td>
										<td><div><span class="fee_wrapper"><span>1日  /</span><span class="fee">100</span><span>円</span></span></div></td>
										<td><div class="txt">日常生活上の便宜にかかる費用（実費）</div></td>
									</tr>
								</table>
								<h3>ショートステイ</h3>
								<p>なじみのスタッフが付き添うので、安心してお泊まりいただくことができます。</p>
							</div>
						</section>
						<section class="section _03" id="section_03">
							<div class="_top">
								<div class="_l">
									<div class="image_wrapper">
										<img src="/common/img/service/serviceimage_03.webp" alt="">
									</div>
								</div>
								<div class="_r">
									<h2>訪問介護のサービス</h2>
									<p>ご自宅でお過ごしの時には、見守り、安否確認、身の回りの介護などのためにスタッフがお伺いいたします。<br>
									お電話での安否確認も行います。</p>
								</div>
							</div>
							<div class="_bottom">
								<h3>デイサービス1日の流れ</h3>
								<ul class="flow_list">
									<li><div><span class="flow_num"><span>1</span></span>送迎</div></li>
									<li><div><span class="flow_num"><span>2</span></span>健康チェック</div></li>
									<li><div><span class="flow_num"><span>3</span></span>入浴</div></li>
									<li><div><span class="flow_num"><span>4</span></span>口腔体操・昼食</div></li>
									<li><div><span class="flow_num"><span>5</span></span>レクリエーション</div></li>
									<li><div><span class="flow_num"><span>6</span></span>おやつ</div></li>
									<li><div><span class="flow_num"><span>7</span></span>送迎</div></li>
								</ul>
							</div>
						</section>

					</section>
				</div>
			</div>
			<?php include DIR_SITE_INCLUDE . 'sidebar.php'; ?>
			<?php include DIR_SITE_INCLUDE . 'footer.php'; ?>
		</div>
		<?php include DIR_SITE_INCLUDE . 'menu/sp_menu.php'; ?>
		<?php include DIR_SITE_INCLUDE . 'script.php'; ?>
		<!--<script src="/common/js/lib/ytplayer/jquery.mb.YTPlayer.js"></script>-->
		<!--<script src="/common/js/lib/textyleF.min.js"></script>-->
		<script src="/common/js/lib/jquery.marquee.min.js"></script>
	</body>
</html>

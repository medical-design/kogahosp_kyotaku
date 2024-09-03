<?php $use_wordpress=0; ?>
<?php require_once '../include/common.php'; ?>
<?php $page_title = "小規模多機能型居宅介護とは？" ?>
<?php
	use MedicalDesign as MD;
	require_once DIR_SITE_LIB . 'Helper.php';
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $page_title ?> | <?= SITE_NAME ?></title><?php include DIR_SITE_INCLUDE . 'head.php'; ?>
	</head>
	<body>
		<div class="root">
			<?php include DIR_SITE_INCLUDE . 'header.php'; ?>
			<div class="category_line">
				<div class="category_line_inner">
					<div class="category_title">
						<img class="deco" src="/common/img/category/title_deco.webp" alt="" loading="lazy" width="70" height="30">
						<img class="ja" src="/common/img/category/title_about.webp" alt="小規模多機能型居宅介護とは？" loading="lazy" width="541" height="33">
						<span class="en">about</span>
					</div>
				</div>
			</div>

			<div class="main_content_area">
				<div class="container">
					<div class="breadcrumb_area">
						<span class="line"></span>
						<ul class="bread_crumb cancel">
							<li class="level-1 top"><a href="/">トップ</a></li>
							<li class="level-2 sub current">小規模多機能型居宅介護とは？</li>
						</ul>
					</div>

					<section class="main_content" id="main_content">
						<section class="content_section">
							<h2>小規模多機能型居宅介護とは？</h2>
							<p>平成18年4月からの介護保険制度改正により、今後増加が見込まれる高齢者が、できる限り住み慣れた地域での生活が継続できるように、新たなサービス体系として地域密着型サービスが創設されました。<br>
							小規模多機能型居宅介護では、「通い（デイサービス）」を中心として、要介護者の様態や希望に応じて、随時「訪問（訪問介護）」や「泊まり（ショートステイ）」を組み合わせてサービスを提供する施設は、地域に根ざした小規模の施設であるため「通い」「訪問」「泊まり」等のサービスを利用するときに同じスタッフが対応できますので、連続性のあるケアを利用できます。</p>
							<h3>こんな方はご相談ください！</h3>
							<ul>
								<li>急な泊まりにも対応してほしい</li>
								<li>夜間一人で不安なことがある</li>
								<li>大人数で過ごすことが苦手</li>
								<li>退院後の生活をどうしようか</li>
							</ul>

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

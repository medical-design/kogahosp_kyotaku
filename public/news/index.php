<?php
	use MedicalDesign as MD;
	$use_wordpress=1;
	require_once '../include/common.php';
	require_once DIR_SITE_LIB . 'Pager.php';

	$page_title = "お知らせ";

	$pager = null;
	$list = null;

	$slug = "";
	//if (isset($_GET["cat"])) {
	//	$slug = htmlspecialchars($_GET["cat"]);
	//}

	$all = get_topics_posts($slug, $rows = -1, $enable_sticky = true, $taxnomy = '');
	$pager = new MD\Pager(15);
	$list = $pager->getList($all);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $page_title ?> | <?= SITE_NAME ?></title><?php include DIR_SITE_INCLUDE . 'head.php'; ?>
	</head>
	<body>
		<div class="root _news">
			<img class="fix_bg" src="/common/img/bg.webp" alt="" loading="lazy">
			<?php include DIR_SITE_INCLUDE . 'header.php'; ?>
			<div class="main_content_area">

				<div class="category_line">
					<div class="category_line_inner">
					<div class="category_title">
						<img class="deco" src="/common/img/category/title_deco.webp" alt="" loading="lazy" width="70" height="30">
						<img class="ja" src="/common/img/category/title_news.webp" alt="お知らせ" loading="lazy" width="156" height="35">
						<span class="en">news</span>
					</div>
					</div>
				</div>

				<div class="container">
					<div class="breadcrumb_area">
						<span class="line"></span>
						<ul class="bread_crumb cancel">
							<li class="level-1 top"><a href="/">トップ</a></li>
							<li class="level-2 sub current">お知らせ一覧</li>
						</ul>
					</div>

					<section class="main_content" id="main_content">
						<section class="content_section">
							<h2>お知らせ一覧</h2>
							<div class="news_wrap _news_page">
								<ul class="newsline_list _news_page cancel">
<?php
									/********************************************************
									*
									*	お知らせ一覧
									*
									********************************************************/
									view_topics_list($list, $style = "default", $echo = true);

									//<li>
									//	<a class="newsline" href="/news/detail.php">
									//		<div class="head">
									//			<div class="date">2023.10.10</div>
									//		</div>
									//		<div class="body">
									//			<div class="ex">新型コロナウイルス感染症　⾯会制限の解除について</div>
									//		</div>
									//	</a>
									//</li>
?>
								</ul>
<?php
								if (true || WP_ENABLE) {
									$uri = '';
									if ($pager->isResultEmpty === false) {
?>
								<div class="news_pager_area">
									<div class="news_pager">
<?php
										$prev_link_class = $pager->isExistPrev ? '' : ' prev_link-passive ';
										$url = $uri . '?pager=' . $pager->pagePrev . '&cat=' . $slug;
										echo '<div class="news_pager__box"><a href="' . $url . '" class="prev_link ' . $prev_link_class . '"><img src="/common/img/icon/arrow/arrow_03.webp" alt=""></a></div>';

										for ($i = $pager->pageStart; $i <= $pager->pageEnd; $i++) {
											// $url = $uri . '?pager=' . $i . '&year=' . $year;
											$url = $uri . '?pager=' . $i . '&cat=' . $slug;
											$selected = $pager->pageCurrent == $i ? ' current' : '';
?>
										<div class="news_pager__box">
											<a href="<?php echo $url; ?>" class="<?php echo $selected ?>"><?= $i; ?></a>
										</div>
<?php
										}

										$next_link_class = $pager->isExistNext ? '' : ' next_link-passive ';
										$url = $uri . '?pager=' . $pager->pageNext . '&cat=' . $slug;
										echo '<div class="news_pager__box"><a href="' . $url . '" class="next_link ' . $next_link_class . '"><img src="/common/img/icon/arrow/arrow_03.webp" alt=""></a></div>';
?>
									</div>
								</div>
<?php
									}
								}

								//<div class="news_pager_area">
								//	<div class="news_pager">
								//		<div class="news_pager__box news_pager__box-prev"><a href="?pager=0" class="prev_link prev_link-passive"></a></div>
								//		<div class="news_pager__box"><a href="?pager=1" class="">1</a></div>
								//		<div class="news_pager__box"><a href="?pager=2" class="current">2</a></div>
								//		<div class="news_pager__box"><a href="?pager=3" class="">3</a></div>
								//		<div class="news_pager__box news_pager__box-next"><a href="?pager=2" class="next_link"></a></div>
								//	</div>
								//</div>
?>
							</div>
						</section>
					</section>
				</div>
			</div>
			<?php include DIR_SITE_INCLUDE . 'footer.php'; ?>
		</div>
		<?php include DIR_SITE_INCLUDE . 'menu/sp_menu.php'; ?>
		<?php include DIR_SITE_INCLUDE . 'script.php'; ?>
		<!--<script src="/common/js/lib/ytplayer/jquery.mb.YTPlayer.js"></script>-->
		<!--<script src="/common/js/lib/textyleF.min.js"></script>-->
		<script src="/common/js/lib/jquery.marquee.min.js"></script>
	</body>
</html>

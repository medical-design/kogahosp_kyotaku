<?php $use_wordpress=0; ?>
<?php require_once '../include/common.php'; ?>
<?php $page_title = "ページが見つかりません" ?>
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
						<img class="ja" src="/common/img/category/title_news.webp" alt="お知らせ" loading="lazy" width="156" height="35">
						<span class="en">news</span>
					</div>
				</div>
			</div>

			<div class="main_content_area">
				<div class="container">
					<div class="breadcrumb_area">
						<span class="line"></span>
						<ul class="bread_crumb cancel">
							<li class="level-1 top"><a href="/">トップ</a></li>
							<li class="level-2 sub current"><a href="/">お知らせ</a></li>
							<li class="level-2 sub current">サンプル</li>
						</ul>
					</div>

					<section class="main_content" id="main_content">>
						<p>誠に申し訳ございませんがお客様がアクセスしようとしたページが見つかりませんでした。<br>以下の原因が考えられます。</p>
						<ul class="mb-2">
							<li>一時的にアクセス出来ない状況にあるか、移動もしくは削除された可能性があります。</li>
							<li>Webブラウザのアドレスバーに、URLの綴りを誤って入力されている可能性があります。</li>
						</ul>
						<p class="center"><a href="/" class="btn">トップページはこちら</a></p>
					</section>
				</div>
			</div>
			<?php include DIR_SITE_INCLUDE . 'footer.php'; ?>
		</div>
		<?php include DIR_SITE_INCLUDE . 'menu/sp_menu.php'; ?>
		<?php include DIR_SITE_INCLUDE . 'script.php'; ?>
	</body>
</html>

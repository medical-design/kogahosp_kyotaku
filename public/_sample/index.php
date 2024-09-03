<?php $use_wordpress=0; ?>
<?php require_once '../include/common.php'; ?>
<?php $page_title = "サンプルページ" ?>
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

					<section class="main_content" id="main_content">
						<section class="content_section">
							<h2>記事サンプルページ</h2>
							<div class="article_head">
								<div class="date_wrap">
									<span class="date">
										<span class="year">2024</span>年<span class="month">00</span>月<span class="day">00</span>日
								</div>
								<div class="cate_wrap">
									<a class="cate" href="">カテゴリー</a>
									<a class="cate" href="">カテゴリー</a>
								</div>
							</div>
							<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。</p>
							<h3>h3タイトルh3タイトルh3タイトルh3タイトル</h3>
							<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。</p>
							<h4>h4タイトルh4タイトルh4タイトルh4タイトル</h4>
							<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。</p>
							<h5>h5タイトルh5タイトルh5タイトルh5タイトル</h5>
							<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。</p>
						</section>

						<section class="content_section">
							<h2>リンク・ボタン</h2>
							<h3>リンク</h3>
							<div class="mb_1em">
								<a class="link" href="">リンク1</a>
							</div>
							<div class="mb_1em">
								<a class="link_text" href="">リンク2(文章中など)</a>
							</div>
							<div class="mb_1em">
								<a href="#" class="pdf">PDFリンク</a>
							</div>
							<div class="mb_1em">
								<a href="#" class="ext">外部リンク</a>
							</div>
							<h3>ボタン</h3>
							<div>
								<a class="btn" href="">ボタン</a>
							</div>
							<div>
								<a class="btn pdf" href="">ボタン</a>
							</div>
							<div>
								<a class="btn ext" href="">ボタン</a>
							</div>
						</section>

						<section class="content_section">
							<h2>リスト</h2>
							<h3>ulリスト</h3>
							<ul>
								<li>リスト</li>
								<li>リスト</li>
								<li>リスト</li>
							</ul>
							<h3>olリスト</h3>
							<ol>
								<li>リスト</li>
								<li>リスト</li>
								<li>リスト</li>
							</ol>
						</section>

						<section class="content_section">
							<h2>画像</h2>
							<h3>中画像</h3>
							<div class="img_column">
								<img src="/_sample/img/sample_img.webp" alt="">
								<img src="/_sample/img/sample_img.webp" alt="">
							</div>
							<h3>文章と中画像</h3>
							<div class="set">
								<div class="left">
									<p>私も今ほぼある不足ようというののためをいたろです。さきほど時間に試験顔は何だかこの失敗たたくらいにするているなけれがも批評聴きないたて、そうにはいうないましうん。害で移ろあっ事はもし生涯にはたしてうないです。私も今ほぼある不足ようというののためをいたろです。</p>
								</div>
								<div class="right fix" style="padding-left: 40px; flex-basis: 450px;">
									<img src="/_sample/img/sample_img.webp" alt="">
								</div>
							</div>
							<h3>小画像</h3>
							<div class="img_list">
								<img src="/_sample/img/sample_img.webp" alt="">
								<img src="/_sample/img/sample_img.webp" alt="">
								<img src="/_sample/img/sample_img.webp" alt="">
							</div>
						</section>

						<div class="article_foot">
							<div>
								<a class="link" href="">一覧へ戻る</a>
							</div>
						</div>

						<!--<section class="content_section">
							<h2>テーブル</h2>
							<h4>通常</h4>
							<div class="indent">
								<figure class="table_wrapper">
									<table>
										<thead>
											<tr>
												<th>テーブルth</th>
												<th>テーブルth</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波</td>
											</tr>
										</tbody>
									</table>
								</figure>
							</div>

							<h4>スクロール</h4>
							<div class="indent">
								<figure class="table_wrapper fixed_table">
									<table>
										<thead>
											<tr>
												<th>テーブルth</th>
												<th>テーブルth</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波</td>
											</tr>
										</tbody>
									</table>
								</figure>
							</div>
							<h4>theadなし</h4>
							<div class="indent">
								<figure class="table_wrapper">
									<table>
										<tbody>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>テーブルtdテーブルtd</td>
											</tr>
											<tr>
												<th>テーブルth</th>
												<td>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波</td>
											</tr>
										</tbody>
									</table>
								</figure>
							</div>


							<h3>リスト</h3>
							<h4>ulリスト</h4>
							<ul>
								<li>リスト</li>
								<li>リスト</li>
								<li>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。</li>
							</ul>
							<h4>olリスト</h4>
							<ol>
								<li>リスト</li>
								<li>リスト</li>
								<li>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波。</li>
							</ol>
							<h4>リンクリスト</h4>
							<ul class="cancel indent">
								<li>
									<a href="#" class="link">リンク</a>
								</li>
								<li>
									<a href="#" class="pdf">PDFリンク</a>
								</li>
								<li>
									<a href="#" class="ext">外部リンク</a>
								</li>
							</ul>
							<h4>特別なリスト</h4>
							<ul class="list cancel">
								<li>
									<div class="head">見出し</div>
									<div class="body">
										<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら。</p>
									</div>
								</li>
								<li>
									<div class="head">見出し</div>
									<div class="body">
										<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら。</p>
									</div>
								</li>
								<li>
									<div class="head">見出し</div>
									<div class="body">
										<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら。</p>
									</div>
								</li>
								<li>
									<div class="head">見出し</div>
									<div class="body">
										<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら。</p>
									</div>
								</li>
								<li>
									<div class="head">見出し見出し見出し見出し</div>
									<div class="body">
										<p>あのイーハトーヴォのすきとおった風、夏でも底に冷たさをもつ青いそら、うつくしい森で飾られたモリーオ市、郊外のぎらぎらひかる草の波</p>
									</div>
								</li>
							</ul>
						</section>-->
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

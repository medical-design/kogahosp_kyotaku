<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package koga
 */

require_once DIR_SITE_INCLUDE . 'common.php';

get_header(); ?>
	<div class="main_content_area">
		<div class="category_line">
			<div class="category_line_inner">
				<div class="category_title">
					<img class="deco" src="/common/img/category/title_deco.webp" alt="" loading="lazy" width="70" height="30">
					<img class="ja" src="/common/img/category/title_404.webp" alt="404" loading="lazy" width="88" height="38">
					<span class="en">not_found</span>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="breadcrumb_area">
				<div class="breadcrumb_area breadcrumb_area">
					<ul class="bread_crumb">
						<li class="level-1 top"><a href="/">TOP</a></li>
						<li class="level-2 sub tail current">404</li>
					</ul>
				</div>
			</div>

			<section class="main_content" id="main_content">
				<div class="title_box">
					<h2>お探しのページが見つかりません</h2>
					<div class="content_section content_section-sm">
					<p>誠に申し訳ございませんがお客様がアクセスしようとしたページが見つかりませんでした。<br>以下の原因が考えられます。</p>
					<ul>
						<li>一時的にアクセス出来ない状況にあるか、移動もしくは削除された可能性があります。</li>
						<li>Webブラウザのアドレスバーに、URLの綴りを誤って入力されている可能性があります。</li>
					</ul>
				</div>

				</div>
			</section>
		</div>
	</div>
<?php
get_footer();

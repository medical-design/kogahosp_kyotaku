<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package koga
 */
/********************************************************
 * お知らせ post ではない (カスタム投稿) の場合は 404 リダイレクト
 ********************************************************/
if (! is_singular('post')) { wp_redirect("/404"); }

require_once DIR_SITE_INCLUDE . 'common.php';

get_header();
?>
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
              <li class="level-2 sub current"><a href="/">お知らせ</a></li>
              <li class="level-2 sub current">サンプル</li>
            </ul>
          </div>

					<section class="main_content" id="main_content">

            <?php
                        while ( have_posts() ) : the_post();
            ?>
						<div class="content_section">
							<div class="wpnews__head">
                <div class="title_box">
                  <h2><?php the_title(); ?></h2>
                </div>
                <div class="article_head">
                  <div class="date_wrap">
                    <span class="date">
                      <span class="year"><?php the_time(__('Y.m.d')); ?></span>日
                  </div>
                  <div class="cate_wrap">
                    <a class="cate" href="">カテゴリー</a>
                    <a class="cate" href="">カテゴリー</a>
                  </div>
                </div>
							</div>
							<div class="wpnews__body">
								<?php the_content(); ?>
							</div>
              <div class="article_foot">
                <div>
                  <a class="link" href="/news/">一覧へ戻る</a>
                </div>
              </div>
						</div>
<?php
						endwhile; // End of the loop.
?>
					</section>
				</div>
			</div>
<?php
get_footer();

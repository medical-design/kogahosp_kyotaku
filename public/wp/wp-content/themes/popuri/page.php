<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package koga
 */


// if (! defined('SUB_MENU_CATEGORY_SLUG') && ! defined('SUB_MENU_CATEGORY_SLUG')) {
// 	define('SUB_MENU_CATEGORY_SLUG', 'info');
// 	define('SUB_MENU_CATEGORY_LABEL', 'このサイトについて');
// }

require_once DIR_SITE_INCLUDE . 'common.php';

// リダイレクト設定 がされていれば リダイレクトを実行する。
$redirect_url = get_field('redirect_url');
if ($redirect_url) {
	wp_redirect($redirect_url);
}

get_header(); ?>
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

      <div class="breadcrumb_area breadcrumb_area">
            <?php
              $args = array(
                'home_label' => 'TOP',
                'li_class' => '',
              );
              if ( function_exists( 'bread_crumb' ) ) { bread_crumb($args); }
            ?>
          </div>
    </div>

			<section class="main_content" id="main_content">

				<div class="title_box">
					<h2><?php the_title(); ?></h2>
				</div>
				<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile; // End of the loop.
				?>
			</section>
		</div>
	</div>
<?php
get_footer();

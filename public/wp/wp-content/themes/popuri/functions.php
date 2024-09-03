<?php
/**
 * shintokyo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package marianna
 */

//define('USE_WORDPRESS', true);
include 'block/config.php';

// 親スタイル読み込み
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css' );
}

function change_post_label() {
	global $menu;
	global $submenu;

	$menu[5][0] = 'お知らせ';
	$submenu['edit.php'][5][0] = 'お知らせ一覧';
	$menu[10][0] = '投稿画像';
	$menu[20][0] = '下層ページ';

	if (! current_user_can('administrator')) {
		unset($menu[25]); // コメント削除
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
		remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
		remove_submenu_page('edit.php?post_type=page', 'post-new.php?post_type=page');
		remove_submenu_page('edit.php?post_type=page', 'edit-tags.php?taxonomy=approval&amp;post_type=page');
		remove_submenu_page('edit.php?post_type=page', 'edit-tags.php?taxonomy=template&amp;post_type=page');
	}
}
add_action('admin_menu', 'change_post_label');

function revcon_change_post_object() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'お知らせ一覧';
	$labels->singular_name = 'お知らせ';
	$labels->add_new = '新規追加';
	$labels->add_new_item = 'お知らせを追加';
	$labels->edit_item = 'お知らせの編集';
	$labels->new_item = 'お知らせ';
	$labels->view_item = 'お知らせの表示';
	$labels->search_items = 'お知らせを検索';
	$labels->not_found = 'お知らせが見つかりませんでした。';
	$labels->not_found_in_trash = 'ゴミ箱内にお知らせが見つかりませんでした。';
	$labels->all_items = 'お知らせ一覧';
	$labels->menu_name = 'お知らせ';
	$labels->name_admin_bar = 'お知らせ';

	$labels = &$wp_post_types['page']->labels;
	$labels->name = '下層ページ一覧';
	$labels->singular_name = '下層ページ';
	$labels->add_new = '新規追加';
	$labels->add_new_item = '下層ページを追加';
	$labels->edit_item = '下層ページの編集';
	$labels->new_item = '下層ページ';
	$labels->view_item = '下層ページの表示';
	$labels->search_items = '下層ページを検索';
	$labels->not_found = '下層ページが見つかりませんでした。';
	$labels->not_found_in_trash = 'ゴミ箱内に下層ページが見つかりませんでした。';
	$labels->all_items = '下層ページ一覧';
	$labels->menu_name = '下層ページ';
	$labels->name_admin_bar = '下層ページ';
}
add_action('init', 'revcon_change_post_object');

/**
 * 固定ページのみ自動整形機能を無効化
 *
 */
function disable_page_wpautop() {
	if ( is_page() ) {
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_content', 'wptexturize' );
	}
}
add_action( 'wp', 'disable_page_wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


function override_mce_options( $init_array ) {
	global $allowedposttags;

	$init_array['valid_elements']          = '*[*]';
	$init_array['extended_valid_elements'] = '*[*]';
	$init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';
	$init_array['indent']                  = true;
	$init_array['wpautop']                 = false;
	$init_array['force_p_newlines']        = false;

	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'override_mce_options' );

/**
 * ページごとの読み込みカスタマイズ
 */
function custom_wp_enqueue_style()  {
	// フォーム
	if (is_page_template('page_form.php')) {
		wp_enqueue_style('form', '/../common/css/form.css', array(), '1.0.0');
	}

	// サイトマップ
	if (is_page_template('page_sitemap.php')) {
		wp_enqueue_style('sitemap', '/../common/css/sitemap.css', array(), '1.0.0');
	}
}
add_action('wp_enqueue_scripts', 'custom_wp_enqueue_style');

/**
 * 外来担当表の投稿画面をカスタマイズする
 */
function custom_outpatient_editor() {
	global $post;
	if ($post->post_type === 'custom_outpatient'):
		?>
			<style>
				.wp-block-post-content {
					display: none;
				}
				#outpatient_field_wrap .acf-field {
					padding: 6px;
				}
				#outpatient_field_wrap .acf-table > tbody > tr > th,
				.acf-table > tbody > tr > td,
				.acf-table > thead > tr > th,
				.acf-table > thead > tr > td {
					padding: 4px !important;
				}
			</style>
		<?php
	endif;
}
add_action('admin_footer', 'custom_outpatient_editor');

/**
 * リダイレクト
 */
function custom_redirect() {
	if (function_exists('get_field')) {
		$redirect_url = get_field('redirect_url');

		if ($redirect_url) wp_redirect($redirect_url);
	}
}
add_action('template_redirect', 'custom_redirect');

/**
 * 画像パスのショートコード
 * 例: [dir_img]/about/img/image1.jpg
 *		↓
 *	/wp/wp-content/themes/sendai/about/img/image1.jpg
 *
 */
function allow_sc_template_dir($atts,$content='') {
	global $wp_query;
	if (! empty($wp_query->query['pagename'])) {
		return get_stylesheet_directory_uri() . '/asset/' . $wp_query->query['pagename'] . '/' . $content;
	} else {
		return get_stylesheet_directory_uri() . '/asset/' . $content;
	}
}
add_shortcode('dir_asset','allow_sc_template_dir');


/**
 * インクルードファイルのショートコード
 * 例: [include_php file='/parts/section/sec_tougoua/tab.php']
 *	↓
 *	/home/md-test2/www/sendai-kousei-wp/wp/wp-content/themes/sendai/parts/section/sec_tougoua/tab.php
 */
function Include_my_php($params = array()) {
	extract(shortcode_atts(array(
		'file' => 'default'
	), $params));
	if (file_exists(get_theme_root() . '/' . get_stylesheet() . '/' . $file)) {
		ob_start();
		include get_theme_root() . '/' . get_stylesheet() . '/' . $file;
		return ob_get_clean();
	} else {
		return '';
	}
}
add_shortcode('include_php', 'Include_my_php');


/**
 * お知らせ一覧表示のショートコード
 * 例: [the_topics_list slug='news_nurse', rows=3]
 */
function shortcode_the_topics_list($params = array()) {
	extract(shortcode_atts(array(
		'slug' => 'news',
		'rows' => -1,

	), $params));
	ob_start();
	the_topics_list($slug = $slug, $rows = $rows, $style = '', $echo = true);
	return ob_get_clean();
}
add_shortcode('the_topics_list', 'shortcode_the_topics_list');


/**
 * 挿入画像から「a要素」「class」「title」「width」「height」を削除
 *
 */
function remove_image_attribute($html){
	$html = preg_replace('/(width|height)="\d*"\s/', '', $html);
	$html = preg_replace('/class=[\'"]([^\'"]+)[\'"]/i', '', $html);
	$html = preg_replace('/title=[\'"]([^\'"]+)[\'"]/i', '', $html);
	$html = preg_replace('/<a href=".+">/', '', $html);
	$html = preg_replace('/<\/a>/', '', $html);
	return $html;
}
add_filter('image_send_to_editor', 'remove_image_attribute', 10);
add_filter('post_thumbnail_html', 'remove_image_attribute', 10);



add_theme_support( 'post-thumbnails' );
add_image_size('btn_link_list', 260, 142, true);
add_image_size('doctor_img', 220, 300, true);


// get_topics_metaで設定するタグのカスタマイズ
global $tmpl_config;
$tmpl_config = (object) array(
	'category_label_prefix' => '',
	'new_icon_string' => '<span class="new">NEW</span>',
	'is_hospital' => true,
);

/**
 * 取得済みの posts 配列を引数にとり、整形して html に変換し、echo または return する
 *
 * @author hiroyuki_watanabe <hiroyuki_watanabe@medical-design.co.jp>
 * @access public
 * @param array $posts 投稿オブジェクトの配列
 * @param string $style 表示方法の種類。トップページと新着一覧ページで表示が違う時などに利用する
 * @param bool $echo true なら結果を echo する。 false なら結果を return する
 * @return mixed $echo の引数次第で変わる。
 */
if (!function_exists('view_topics_list')) {
	function view_topics_list($posts, $style = '', $echo = true) {
		global $tmpl_config;
		$content = '';

		if (!empty($posts)) {
			foreach ($posts as $post) {
				if ($style === '' || $style === 'default') {
					$meta = get_topics_meta($post);
					$important_class = '';
					$year = date("Y", strtotime($meta->date));
					$month = date("m", strtotime($meta->date));
					$day = date('d', strtotime($meta->date));

					$content .= <<<EOM
<li>
	<a class="newsline {$important_class} {$meta->link_disable_classname}" href="{$meta->link}" {$meta->ext} {$meta->link_disable_tabindex}>
		<div class="head">
			<div class="date">
				<span class="year">{$year}</span>.<span class="month">{$month}</span>.<span class="day">{$day}</span>
			</div>
		</div>
		<div class="body">
			<div class="ex {$meta->pdf_icon} {$meta->ext_icon}">{$post->post_title}{$meta->new_icon}</div>
		</div>
	</a>
</li>

EOM;
				} else if($style === 'index') {
					$meta = get_topics_meta($post);
					$year = date("Y", strtotime($meta->date));
					$month = date("m", strtotime($meta->date));
					$day = date('d', strtotime($meta->date));

					$content .= <<<EOM
<li>
	<a class="newsline {$meta->link_disable_classname}" href="{$meta->link}" {$meta->ext}>
		<div class="head">
			<div class="date">{$year}.{$month}.{$day}</div>
		</div>
		<div class="body">
			<div class="ex {$meta->pdf_icon} {$meta->ext_icon}">{$post->post_title}{$meta->new_icon}</div>
		</div>
	</a>
</li>
EOM;
				}
			}
			if ($echo) {
				echo $content;
				return true;
			} else {
				return $content;
			}
		} else {
			if ($echo) {
				echo '<li class="no_news">該当する記事が見つかりませんでした。</li>';

				return false;
			}
			return false;
		}
		return false;

	}
}

if (!function_exists('get_title_style'))
{
	function get_title_style($post)
	{
		$style = [];
		if ($post)
		{
			$color = get_field('color', $post->ID);
			if ($color)
			{
				$style[] = "color: {$color};";
			}
			$bold = get_field('is_bold', $post->ID);
			if ($bold)
			{
				$style[] = "font-weight: bold;";
			}
		}
		$style = implode('', $style);
		if ($style)
		{
			$style = <<<EOM
				style="{$style}"
			EOM;
		}
		return $style;
	}
}

/**
 * 診療科 taxonomy を1つしか選択できないように javascript で制限
 *
 * @author hiroyuki_watanabe <hiroyuki_watanabe@medical-design.co.jp>
 */
add_action('admin_print_footer_scripts', 'limit_tax_outpatient_department_select');
function limit_tax_outpatient_department_select() {
	?>
	<script type="text/javascript">
	jQuery( function($) {
		// 投稿画面
		$('#taxonomy-tax_outpatient_department input[type=checkbox]').each( function() {
			$(this).replaceWith( $(this).clone().attr('type', 'radio'));
		});

		// 一覧画面
		var tax_outpatient_department_checklist = $('.tax_outpatient_department-checklist input[type=checkbox]');
		tax_outpatient_department_checklist.click(function() {
			$(this).parents('.tax_outpatient_department-checklist').find(' input[type=checkbox]').attr('checked', false);
			$(this).attr('checked', true);
		});
	} );
	</script>
	<?php
}


// 404 ページのタイトルを指定
function title_404($title) {
	if (is_404()) {
		$title = 'ページが見つかりません';
	}
	return $title;
}
add_filter('the_title', 'title_404');

function delete_preview_button() {
	echo <<<EOM
	<style>
	.post-type-custom_outpatient #post-preview,
	.post-type-custom_outpatient #tax_outpatient_typediv,
	.post-type-custom_outpatient #tax_outpatient_timeframediv,
	.post-type-custom_outpatientpdf #post-preview,
	.post-type-custom_doctor #post-preview,
	.post-type-custom_cooperation #post-preview,
	.post-type-custom_cooperation #tax_cooperation_prefdiv {
		display: none !important;
	}
	</style>
EOM;
}
add_action('admin_print_styles', 'delete_preview_button');


function page_list_style() {
	//	最上位のリストの色を変える
	echo <<<EOM
	<style>
	.type-page.level-0  {
		background-color: #e9fdf1;;
	}
	.alternate.type-page.level-0,
	.striped > tbody > .type-page.level-0:nth-child(2n+1),
	ul.striped > .type-page.level-0:nth-child(2n+1) {
		background-color: #d8f4e0;
	}
	</style>
EOM;
}
add_action('admin_print_styles', 'page_list_style');


/**
 * MW WP Form の外観を調整する css ファイルを読み込む
 *
 * @author hiroyuki_watanabe <hiroyuki_watanabe@medical-design.co.jp>
 * @param string $form_key フォーム識別子
 */
function my_mwform_after_exec_shortcode($form_key) {
	// wp_enqueue_style('mw_form', '/../common/css/mwwpform.css');
	wp_enqueue_style('mw_form', '/../common/css/form.css');
}
add_action('mwform_after_exec_shortcode', 'my_mwform_after_exec_shortcode');

/**
 * MW WP FORM とバッティングする jquery の対応
 *
 * @author hiroyuki_watanabe <hiroyuki_watanabe@medical-design.co.jp>
 * @access public
 * @param type $arg1 $arg1の説明
 * @param type $arg2 $arg2の説明
 * @return type 戻り値の説明
 */
function load_scripts() {
	if (defined('MWWPFORM_PAGE') && MWWPFORM_PAGE) {
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), '3.5.1');
	}
}
add_action( 'wp_enqueue_scripts', 'load_scripts' );

/**
 * フォーム、自動改行処理無効
 *
 * @author hiroyuki_watanabe <hiroyuki_watanabe@medical-design.co.jp>明
 */
if ( class_exists( 'MW_WP_Form_Admin' ) ) {
	$mw_wp_form_admin = new MW_WP_Form_Admin();
	$forms = $mw_wp_form_admin->get_forms();
	foreach ( $forms as $form ) {
		add_filter( 'mwform_content_wpautop_mw-wp-form-' . $form->ID, '__return_false' );
	}
}


/**
 * 医師情報取得
 *
 */
if (! function_exists('_getDoctorPostMeta')) {
	function _getDoctorPostMeta($post)
	{
		$result = array();
		// プレビュー表示では無く、かつ公開ステータス以外の場合
		if (! isset($_GET['preview']) && $post->post_status != 'publish') {
			// post_meta に保存しておいた最後に公開された内容のリビジョンにあたるpost_idを取得
			$lastId = get_post_meta($post->ID, 'last_publish_rev_id', true);
			if (! empty($lastId)) {
				$lastPost = get_post($lastId);
				if (! empty($lastPost)) $post = $lastPost;
			}
		}

		$result['post'] = $post;

		// 医師のタクソノミーを取得
		$terms = get_the_terms($post->ID, 'departments');
		if (!empty($terms)) {
			foreach ($terms as $term) {
				$result['term'] = $term;
			}
		}

		// カスタムフィールドを取得
		$result['img']    = get_field('img', $post->ID, true);
		$result['name_sei']       = get_post_meta($post->ID, 'name_sei', true);
		$result['name_mei']       = get_post_meta($post->ID, 'name_mei', true);
		$result['gender']       = get_post_meta($post->ID, 'gender', true);
		$result['position']       = get_post_meta($post->ID, 'position', true);
		$result['field']       = get_post_meta($post->ID, 'field', true);
		$result['box_contents']       = get_field('box_contents', $post->ID, true);
		$result['detail_url']       = get_post_meta($post->ID, 'detail_url', true);
		$result['interview_url']       = get_post_meta($post->ID, 'interview_url', true);
		$result['interview_img']    = get_field('interview_img', $post->ID, true);

		return $result;
	}
}
/**
 * 診療科タクソノミーのスラッグから、該当診療科の医師一覧を取得する
 */
if (! function_exists('getDoctorList')) {
	function getDoctorList($department_slug = []) {

		$args = array(
			'post_type' => 'custom_doctor', 
			'posts_per_page' => 500, 
			'post_status' => 'publish', 
			'orderby' => 'menu_order', 
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'departments', 
					'field'    => 'slug', 
					'terms'    => $department_slug,
					'include_children' => false,
				),
			),
		);

		$query = new WP_Query( $args );

		if (isset($_GET['preview'])) {
			$args['post_status'] = array('draft', 'pending', 'publish', 'private');
		} else {
			$args['post_status'] = array('draft', 'pending', 'publish');
		}

		$ret = array();

		if (! empty($query->posts)) {
			foreach ($query->posts as $key => $value) {
				if (isset($_GET['preview']) && isset($_GET['id']) && $value->post_status != 'publish' && $_GET['id'] != $value->ID) {
					continue;
				}
				$ret[] = _getDoctorPostMeta($value);
			}
		}

		return $ret;
	}
}

/**
 * 固定ページ一覧をjson形式で出力する
 */
// 全てのページを再帰的に取得し、入れ子構造の配列を作成する関数
function get_nested_pages($parent_id) {
	$pages = get_pages(array(
		'parent' => $parent_id, // 親ページのIDで子ページを取得
		'post_type' => 'page',
		'sort_column' => 'menu_order', // メニューオーダーで並び替え
		'sort_order' => 'asc', // 昇順で並び替え
	));

	$nested_pages = array();

	foreach ($pages as $page) {
		$is_hidden_menu = get_post_meta($page->ID,'hide_link_in_menu',true);
		$nested_page = array(
			'id' => $page->ID,
			'title' => $page->post_title,
			'url' => get_permalink($page->ID),
			'path' => '/' . get_page_uri($page->ID),
			'post_name' => $page->post_name,
			'is_hidden_menu' => $is_hidden_menu,
			'children' => array(),
		);

		$nested_page['children'] = get_nested_pages($page->ID); // 子ページを再帰的に取得

		$nested_pages[$page->post_name] = $nested_page;
	}

	return $nested_pages;
}
if (! function_exists('page_json_generate')) {
	function page_json_generate() {
		$filename = realpath(dirname(__FILE__)."/../../../../") . "/include/data/sitemap.json";
		file_put_contents($filename, "", LOCK_EX);

		// ルートページ（親ページが存在しないページ）を取得
		$root_pages = get_pages(array(
			'numberposts' => -1,
			'parent' => 0, // 親ページが存在しないページを取得
			'post_type' => 'page',
			'sort_column' => 'menu_order', // メニューオーダーで並び替え
			'sort_order' => 'asc', // 昇順で並び替え
		));

		// ルートページから再帰的にページの入れ子構造を取得する
		$nested_pages = array();

		foreach ($root_pages as $root_page) {
			$is_hidden_menu = get_post_meta($root_page->ID,'hide_link_in_menu',true);

			$nested_page = array(
				'id' => $root_page->ID,
				'title' => $root_page->post_title,
				'url' => get_permalink($root_page->ID),
				'path' => '/' . get_page_uri($root_page->ID),
				'post_name' => $root_page->post_name,
				'is_hidden_menu' => $is_hidden_menu,
				'children' => array(),
			);

			$nested_page['children'] = get_nested_pages($root_page->ID);

			$nested_pages[$root_page->post_name] = $nested_page;
		}

		$arr = json_encode($nested_pages);
		file_put_contents($filename, print_r($arr, true), LOCK_EX);
	}
}
add_action('save_post', 'page_json_generate', 10000);


// wp form 管理者宛メール送信先設定
function autoback_my_mail( $Mail_raw, $values, $Data ) {
	$Mail_raw->to .= ',';

    if ($Data->get('kind') === '外来受診・入院等について') {
        $Mail_raw->to .= 'psw@st-marianna.com,jimukyoku@st-marianna.com,ymatsuzaki@st-marianna.com';
    }
	if (strpos($Data->get('kind'),'採用について') !== false){
        $Mail_raw->to .= 'jimukyoku@st-marianna.com';
    }
	if (strpos($Data->get('kind'),'その他のお問い合わせ') !== false){
        $Mail_raw->to .= 'jimukyoku@st-marianna.com';
    }
    return $Mail_raw;
}
add_filter( 'mwform_admin_mail_mw-wp-form-636', 'autoback_my_mail', 10, 3 );

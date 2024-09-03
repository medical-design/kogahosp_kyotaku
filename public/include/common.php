<?php
/**
 * サイト共通設定ファイル
 *
 *  ※サイト毎の設定は ./config.php で設定をしてください
 *  ※WP関連のメソッドは ./wp.php で実装してください
 *
 *
 *
 * 【前提条件】
 *   ※ドキュメントルートの直下に include/ というディレクトリを作成し、その中にこのファイルを設置する
 *   ※WordPressはドキュメントルートの直下に wp/ というディレクトリ名で設置する
 *   ※テスト環境は本番のドキュメントルートの直下に /_test/ というディレクトリ名を設けてアクセスがされているか、
 *     設定したテスト用のドメインでアクセスがされる
 *
 * 【定数】
 *    config.php で定義するもの(※サイト毎に設定してください)
 *      DOMAIN_LIVE_HTTP  @var string 本番環境 HTTP アクセス時のドメイン
 *      DOMAIN_LIVE_HTTPS @var string 本番環境 HTTPS アクセス時のドメイン
 *      DOMAIN_TEST_HTTP  @var string テスト環境(サーバ側) HTTP アクセス時のドメイン
 *      DOMAIN_TEST_HTTPS @var string テスト環境(サーバ側) HTTPS アクセス時のドメイン
 *      DIR_NAME_TEST     @var string テスト環境のディレクトリ名（本番環境の中にテスト環境ディレクトリを設ける場合）
 *      ENABLE_HTTPS      @var bool   本番環境でのHTTPS接続の有無
 *      ENABLE_TEST_HTTPS @var bool   テスト環境でのHTTPS接続の有無
 *      SERVER_USER_NAME  @var string サーバのユーザ名（/home/aaa/www/ のaaaの部分）
 *
 *
 *
 *    このファイルで定義されるもの(※環境に応じて動的に設定されます)
 *      ENV_HTTP    @var string HTTPアクセス時のサイトTOPのURI ※最後の / は無し
 *      ENV_HTTPS   @var string HTTPSアクセス時のサイトTOPのURI ※最後の / は無し
 *      IS_TEST     @var bool テスト環境判定フラグ
 *      IS_LOCAL    @var bool ローカル環境判定フラグ
 *      SITEMAP_JSON_DATA    @var array サイトマップのリスト
 *      CUR_URI     @var string
 *      DIR_CURRENT @var string
 *      SITE_ROOT   @var string サイトのルートに当たるディレクトリ名（HTTPSアクセス時はHTTPのURIを設定する）
 *      META_DESCRIPTION @var string アクセス中ページのmetaデスクリプション
 *      META_KEYWORDS    @var string アクセス中ページのmetaキーワード
 *      WP_INSTALLED_DIR @var string WordPress インストールディレクトリのパス
 *      WP_ENABLE @var bool WordPress 有効・無効フラグ
 */

// IS_TEST = true の時は display_errors 出力するように変更
ini_set( 'display_errors', 0 );


// 共通設定
if (! defined('ENV_HTTP')) {
	/*******************************************************************************
	 * サイト毎の設定のロード
	 *******************************************************************************/
	require_once realpath(dirname(__FILE__)) . '/config.php';



	/*******************************************************************************
	 * 環境により自動的に判別される設定
	 *******************************************************************************/

	/**
	 * 環境の判別
	 */
	$isTest = false;
	$isLocal = false;



	// ローカル環境(ローカルネットワーク内を含む)
	if (preg_match('/^127\.0\.0\.1/', $_SERVER['REMOTE_ADDR']) || preg_match('/\.local$/', $_SERVER['SERVER_NAME']) || preg_match('/^localhost/', $_SERVER['SERVER_NAME']) || preg_match('/^localhost:3000/', $_SERVER['SERVER_NAME']) || preg_match('/^192\.168/', $_SERVER['HTTP_HOST'])) {
		$domainHttp  = 'http://' . $_SERVER['SERVER_NAME'];
		$domainHttps = 'http://' . $_SERVER['SERVER_NAME'];
		$isTest = true;
		$isLocal = true;
	// テスト環境
	} elseif (
		preg_match('/' . DOMAIN_TEST_HTTP . '$/i', $_SERVER['SERVER_NAME']) ||
		preg_match('/' . DOMAIN_TEST_HTTPS . '$/i', $_SERVER['SERVER_NAME'])
	) {
		$domainHttp  = 'http://' . DOMAIN_TEST_HTTP;
		$domainHttps = ENABLE_TEST_HTTPS ? 'https://' . DOMAIN_TEST_HTTPS : 'http://' . DOMAIN_TEST_HTTPS;
		$isTest = true;

	// 本番環境
	} else {
		$domainHttp  = 'http://' . DOMAIN_LIVE_HTTP;
		$domainHttps = ENABLE_HTTPS ? 'https://' . DOMAIN_LIVE_HTTPS : 'http://' . DOMAIN_LIVE_HTTPS;
	}

	// 環境判別の定数を定義
	if (! defined('ENV_HTTP')) define('ENV_HTTP', $domainHttp);
	if (! defined('ENV_HTTPS')) define('ENV_HTTPS', $domainHttps);
	if (! defined('IS_TEST')) define('IS_TEST', $isTest);
	if (! defined('IS_LOCAL')) define('IS_LOCAL', $isLocal);

	if (IS_TEST) {
		ini_set( 'display_errors', 1 );
		error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);
	}

	/**
	 * ディレクトリ関連の変数設定
	 */
	// 現在のドキュメントルート相当のディレクトリからのパスを定義する（/_test/ があった場合には除く）
	define('CUR_URI', str_replace('/^\/' . DIR_NAME_TEST . '\//', '/', $_SERVER['REQUEST_URI']));
	define('DIR_CURRENT', dirname(CUR_URI));

	// ドキュメントルートに相当するディレクトリ名を定義
	$DIR_DOC_ROOT = preg_match('/^\/' . DIR_NAME_TEST . '\//', $_SERVER['REQUEST_URI']) ? '/' . DIR_NAME_TEST :  '/';

	if (isset($_SERVER['HTTPS']) || isset( $_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])) {
		if (defined('IS_SSL_SITE') && IS_SSL_SITE) {
			define('SITE_ROOT', $DIR_DOC_ROOT);
		} else {
			define('SITE_ROOT', ENV_HTTP . $DIR_DOC_ROOT );
		}
	} else {
		define('SITE_ROOT', $DIR_DOC_ROOT);
	}

	// 共通 include に相当するディレクトリ名を定義
	if(! defined('DIR_SITE_INCLUDE')) {
		define('DIR_SITE_INCLUDE', realpath(dirname(__FILE__)) . '/');
	}

	// システム系ファイルを保存するディレクトリ名を定義
	if(! defined('DIR_SITE_LIB')) {
		define('DIR_SITE_LIB', realpath(dirname(__FILE__) . '/../') . '/lib/');
	}

	// フォーム系ファイルを保存するディレクトリ名を定義
	if(! defined('DIR_SITE_FORM')) {
		define('DIR_SITE_FORM', realpath(dirname(__FILE__) . '/../') . '/form/');
	}

	// フォーム系ファイルを保存するディレクトリ名を定義
	if(! defined('DIR_SITE_DATA')) {
		define('DIR_SITE_DATA', realpath(dirname(__FILE__) . '/../') . '/data/');
	}

	// フォーム系ファイルを保存するディレクトリ名を定義
	if(! defined('DIR_SITE_CALENDAR_LIB')) {
		define('DIR_SITE_CALENDAR_LIB', realpath(dirname(__FILE__) . '/../') . '/lib/Calendar/');
	}

	// フォーム系ファイルを保存するディレクトリ名を定義
	if(! defined('DIR_SITE_FORM')) {
		define('DIR_SITE_FORM', realpath(dirname(__FILE__) . '/../') . '/form/');
	}

	// ユーザーデータ保存場所の定義
	if (IS_TEST || preg_match('/\/www\/html_test\//', __FILE__) || preg_match('/^\/_test\//', $_SERVER['REQUEST_URI'])) {
		/**************************************************
		 *
		 *  水戸健診
		 *
		 **************************************************/
		define('DIR_SAVEDATA', realpath(dirname(__FILE__) . '/../../') . '/data_test/');
		define('DIR_SAVEDATA_FORM', realpath(dirname(__FILE__) . '/../../') . '/data_test/form/checkup/');
	} else {
		/**************************************************
		 *
		 *  水戸健診
		 *
		 **************************************************/
		define('DIR_SAVEDATA', realpath(dirname(__FILE__) . '/../../') . '/data/');
		define('DIR_SAVEDATA_FORM', realpath(dirname(__FILE__) . '/../../') . '/data/form/checkup/');
	}

	/**
	 * menu表示のためのsitemap.jsonを読み込む
	 */
	$jsonUrl = DIR_SITE_INCLUDE . "data/sitemap.json";
	if (file_exists($jsonUrl)) {
		$json = file_get_contents($jsonUrl);
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
		$sitemap = json_decode($json, true);

		if (! defined('SITEMAP_JSON_DATA')) define('SITEMAP_JSON_DATA', $sitemap);
	}

	// 診療科の include
	//if(! defined('DIR_DEPARTMENT_INCLUDE')) {

	//	if (function_exists('get_theme_file_path')) {
	//		define('DIR_DEPARTMENT_INCLUDE', get_theme_file_path('parts/department/'));
	//	}
	//}

	/**
	 * meta description / keywords の設定
	 */
	$metaAry = require_once(dirname(__FILE__) . '/meta.php');
	if (! empty($metaAry)) {
		foreach ($metaAry as $ptn => $setting) {
			if (preg_match('/\/$/', $ptn)) {
				$ptn = preg_replace('/\/$/', '(/index.php|/index.html|/)?$', $ptn);
			}
			$reg = str_replace('/', '\/', $ptn);
			$reg = str_replace('.', '\.', $reg);
			if (preg_match('/^' . $reg . '/', $_SERVER['REQUEST_URI'])) {
				if (! defined('META_DESCRIPTION') && isset($setting['description']) && ! empty($setting['description'])) {
					if (isset($setting['descriptionCommon']) && $setting['descriptionCommon'] === false) {
						define('META_DESCRIPTION', $setting['description']);
					} else {
						define('META_DESCRIPTION', $metaDescriptionCommon . $setting['description']);
					}
				}

				if (! defined('META_KEYWORDS') && isset($setting['keywords']) && ! empty($setting['keywords'])) {
					if (isset($setting['keywordsCommon']) && $setting['keywordsCommon'] === false) {
						define('META_KEYWORDS', $setting['keywords']);
					} else {
						define('META_KEYWORDS', $metaKeywordsCommon . $setting['keywords']);
					}
				}
			}
		}
	}

	if (! defined('META_DESCRIPTION')) define('META_DESCRIPTION', $metaDescriptionDefault);
	if (! defined('META_KEYWORDS')) define('META_KEYWORDS', $metaKeywordsDefault);




	/*******************************************************************************
	 * WordPress のロード
	 *   ※WP関連のメソッドは ./wp.php で実装してください
	 *******************************************************************************/

	// WPインストールディレクトリの定義
	define('WP_INSTALLED_DIR', realpath(dirname(__FILE__) . '/../') . '/wp/');

	if (! defined('USE_WORDPRESS')) {
		if(isset($use_wordpress) && !empty($use_wordpress)) {
			define('USE_WORDPRESS', true);
		} else {
			define('USE_WORDPRESS', false);
		}
	}

	if (! IS_LOCAL && USE_WORDPRESS && is_readable(WP_INSTALLED_DIR . 'wp-load.php')) {
		$wpIncludeFile = WP_INSTALLED_DIR . 'wp-load.php';
		if(! defined('WP_ENABLE')) define('WP_ENABLE', true);
	} else {
		if(! defined('WP_ENABLE')) define('WP_ENABLE', false);
	}

	// WordPressをロード
	if (WP_ENABLE === true) {
		require_once $wpIncludeFile;
	}

	function getUrlParam($path = 0)
	{
		if (empty($path) || ! is_numeric($path)) {
			return false;
		}
		$uri = explode('/', $_SERVER['REQUEST_URI']);
		if (! empty($uri)) {
			$i = 1;
			foreach ($uri as $key => $value) {
				if (empty($value)) continue;
				if ($path == $i) return $value;
				$i++;
			}
		}

		return false;
	}

	function getActiveClass($uri, $no_echo = false, $delAttribute = false, $uri_is_reg = false, $active_text = '')
	{
		/********************************************************
		 *	single ページで、サイドカラムなどに active をつける
		 ********************************************************/
		if (getUrlParam(1) === 'archives') {
			// 文頭に ^ があれば削除
			$_uri = preg_replace('|^\^|', '', $uri);
			// 文末に /news があれば削除
			$_uri = preg_replace('|\(/\)\?\$?$|', '', $_uri);

			// 文末に /news があるときのみ
			if (preg_match('|/news\$?$|', $_uri)) {
				// 文末に /news があれば削除
				$_uri = preg_replace('|/news\$?$|', '', $_uri);

				$uri = '^/archives' . $_uri . '/\d{1,}';
			}
		}

		if ($active_text === '') {
			$active_text = ACTIVE_CLASS;
		}
		if ($delAttribute and $uri_is_reg === false) {
			$uri = preg_replace('/\.(html|htm|php|cgi)/', '', $uri);
		}
		if ($uri_is_reg === false ) {
			$uri = '/' . str_replace(array('/', '.'), array('\/', '\.'), $uri) . '/';
		}
		if( ! $no_echo ) {
			if (preg_match( $uri , CUR_URI))
				echo $active_text;
			else
				return false;
		} else {
			if (preg_match( $uri , CUR_URI))
				return $active_text;
			else
				return false;
		}
	}

	function isReadableDetailCss()
	{
		$path = 'css/' . getDirname() . '.css';
		if (is_readable($path)) {
			return true;
		}
		return false;
	}

	function getDirname()
	{
		preg_match('#/([^/]+)(?:/)?(?:index.php)?$#', $_SERVER['REQUEST_URI'], $matches);

		if (! empty($matches)) {
			return $matches[1];
		}
	}



	#########################################################
	//iphoneまたはipodで閲覧されているかどうかを判定
	function is_iphone()
	{
	  $ua = $_SERVER['HTTP_USER_AGENT'];
	  if(
		  strpos($ua, 'iPhone')!== false
		or  strpos($ua, 'iPod')!== false
	  ) {
		return true;
	  } else {
		return false;
	  }
	}
	#########################################################
	//iphoneまたはipodで閲覧されているかどうかを判定
	function is_ipad()
	{
	  $ua = ! empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	  if(
		  strpos($ua, 'iPad')!== false
	  ) {
		return true;
	  } else {
		return false;
	  }
	}
	#########################################################
	//iphoneまたはipodで閲覧されているかどうかを判定
	function is_ios()
	{
	  $ua = $_SERVER['HTTP_USER_AGENT'];
	  if(
		  is_iphone()
		or  is_ipad()
	  ) {
		return true;
	  } else {
		return false;
	  }
	}
	//androidスマートフォンで閲覧されているかどうかを判定する関数
	//「mobile」文字列の有無を見ることで、タブレット端末をfalse判定
	function is_android()
	{
	  $ua = $_SERVER['HTTP_USER_AGENT'];
	  if(
		  (
			strpos($ua, 'Android')!== false
		  or  strpos($ua, 'android')!== false
		) and strpos($ua, 'Mobile')!== false
	  ) {
		return true;
	  } else {
		return false;
	  }
	}
	//Mozillaが開発するスマートフォン用OS「Firefox OS」の判定関数
	function is_firefox_os()
	{
	  $ua = $_SERVER['HTTP_USER_AGENT'];
	  if(
		  strpos($ua, 'Android')=== false
		and strpos($ua, 'Firefox')!== false
		and strpos($ua, 'Mobile')!== false
	  ) {
		return true;
	  } else {
		return false;
	  }
	}
	//Windows Phoneで閲覧されているかどうかを判定する関数
	//「mobile」文字列の有無を確認することで、タブレット端末をfalse判定
	function is_windows_phone()
	{
	  $ua = $_SERVER['HTTP_USER_AGENT'];
	  if(
		  strpos($ua, 'Windows')!== false
		and strpos($ua, 'Phone')!== false
	  ) {
		return true;
	  } else {
		return false;
	  }
	}
	//BlackBerryで閲覧されているかどうかを判定する関数
	function is_blackberry()
	{
	  $ua = $_SERVER['HTTP_USER_AGENT'];
	  if(
		  strpos($ua, 'BlackBerry')!== false
	  ) {
		return true;
	  } else {
		return false;
	  }
	}
	//ガラケーで閲覧されているかどうか判定する関数
	function is_ktai()
	{
	  $ua = $_SERVER['HTTP_USER_AGENT'];
	  if(
		  strpos($ua, 'DoCoMo')!== false
		or  strpos($ua, 'KDDI')!== false
		or  strpos($ua, 'UP.Browser')!== false
		or  strpos($ua, 'MOT-')!== false
		or  strpos($ua, 'J-PHONE')!== false
		or  strpos($ua, 'WILLCOM')!== false
		or  strpos($ua, 'Vodafone')!== false
		or  strpos($ua, 'SoftBank')!== false
	  ) {
		return true;
	  } else {
		return false;
	  }
	}

	/*****
	is_ktai()、is_iphone()、is_android()、
	is_firefox_os()、is_windows_phone()、
	is_blackberry()のどれかがTRUEを返すと
	is_mymobile()はTRUEを返します。
	つまりガラケー･スマホでの閲覧時にはTRUE、
	PC・タブレットでの閲覧時にはFALSEを返します。
	******/
	function is_mymobile()
	{
	  if(
		  is_ktai()
		or  is_iphone()
		or  is_android()
		or  is_firefox_os()
		or  is_windows_phone()
		or  is_blackberry()
		)
	  {
		return true;
	  } else {
		return false;
	  }
	}

	/**
	 * 、is_iphone()、is_android()、
	 * is_firefox_os()、is_windows_phone()、
	 * is_blackberry()のどれかがTRUEを返すと
	 * is_mobile() はTRUEを返します。
	 */
	function is_mobile() {
	  if(
		  is_iphone()
		or  is_android()
		or  is_firefox_os()
		or  is_windows_phone()
		or  is_blackberry()
		)
	  {
		return true;
	  } else {
		return false;
	  }
	}
}

function page_title($page_label = null) {

	$pre_title = '';
	/* if (is_page()) {
		global $wp_query;
		// echo '<pre>';
		// var_dump( $wp_query );
		// echo '</pre>';
		$ancestors = get_ancestors($wp_query->queried_object_id, 'page');

		if (count($ancestors) >= 1) {
			$page1 = get_post(array_pop($ancestors));
			// $pre_title = $page1->post_title . ' | ';

			// 診療科
			if ($page1->post_name === 'department') {

				// 特定診療科の時
				if (count($ancestors) >= 1) {
					$page2 = get_post(array_pop($ancestors));

					// 診療科という文字は不要で、科の名前だけをページタイトル前におく
					$pre_title = $page2->post_title . ' | ';
				} else {
					$pre_title = '';
				}

			// 部門
			} else if ($page1->post_name === 'section') {

				// 下層
				if (count($ancestors) >= 1) {
					$page2 = get_post(array_pop($ancestors));

					// 看護部
					if ($page2->post_name === 'nurse') {

						// 部門は不要。看護部というテキストを表示する
						$pre_title = $page2->post_title . ' | ';

					// 研修医
					} else if ($page2->post_name === 'doctor') {

						if (count($ancestors) >= 1) {
							$page3 = get_post(array_pop($ancestors));

							// 研修医は不要。後期研修医か専門医というテキストを表示する
							$pre_title = $page3->post_title . ' | ';
						}

					}
				} else {
					$pre_title = '';
				}
			}
		}
	} */

	if (defined('SITE_NAME')) {
		if (! empty($page_label)) {

			echo $page_label . ' | ' . $pre_title . SITE_NAME;
		} else {
			echo SITE_NAME;
		}
	} else if (! empty($page_label)) {
		echo $page_label;
	}
}

if (! function_exists('date_i18n')) {
	function date_i18n($format, $timestamp = null) {
		if ($timestamp === null) {
			$timestamp = time();
		}
		return date($format, $timestamp);
	}
}

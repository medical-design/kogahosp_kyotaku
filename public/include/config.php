<?php
/*******************************************************************************
 * サイト毎の設定
 *******************************************************************************/

// 本番環境ドメイン(HTTPアクセス時)の定義
define('DOMAIN_LIVE_HTTP', '');

// 本番環境ドメイン(HTTPSアクセス時)の定義
define('DOMAIN_LIVE_HTTPS', '');

// テスト環境ドメイン(HTTPアクセス時)の定義
define('DOMAIN_TEST_HTTP', 'koga-popuri.md-dev3.com');

// テスト環境ドメイン(HTTPSアクセス時)の定義
define('DOMAIN_TEST_HTTPS', 'koga-popuri.md-dev3.com');

// テスト環境がサブドメインではなく、本番環境内のディレクトリで運用される場合、そのディレクトリ名
// ※テスト環境がディレクトリでなくても必ず設定すること、/ は不要
define('DIR_NAME_TEST', '_test');

// 本番環境でのHTTPS接続の有無(bool)
define('ENABLE_HTTPS', true);

// テスト環境でのHTTPS接続の有無(bool)
define('ENABLE_TEST_HTTPS', true);

// ディレクトリ関連の変数、定数の定義・設定
define('ACTIVE_CLASS', 'active');

// 全ページSSLサイトかどうか
define('IS_SSL_SITE', true);

// 現在がサイト開発中かどうか
define('IS_DEV', true);

// サイトの日本語名
define('SITE_NAME', '医療法人徳洲会 古河総合病院 居宅介護支援事業');
define('SITE_NAME_L', '医療法人徳洲会 古河総合病院 居宅介護支援事業');


define('GOOGLE_MAP_API', '');

define('WP_CATEGORY_MAKE_CRON_INTERVAL_MINUTE', 1);


/*******************************************************************************
 * metaタグの設定
 *******************************************************************************/

// meta keywords / description のデフォルト
$metaKeywordsDefault = '医療法人徳洲会 古河総合病院 居宅介護支援事業';
$metaDescriptionDefault = '医療法人徳洲会 古河総合病院 居宅介護支援事業';

// 個別にキーワードを設定する際の、共通キーワード（※最後に , を付けること）
$metaKeywordsCommon  = '';

// 個別にキーワードを設定する際の、共通デスクリプション(文章の先頭に付きます)
$metaDescriptionCommon  = '';

// if (! isset($no_wordpress) || $no_wordpress == false) {
// 	$wait = null;
// 	$use_wordpress = true;
// 	require_once realpath(dirname(__FILE__) . '/../') . '/lib/' . 'Wait.php';
// 	require_once realpath(dirname(__FILE__) . '/../') . '/lib/' . 'Helper.php';
// 	$status_date_label = date('m/d') . '(' . MedicalDesign\Helper::getWeekName(date('w')) . ')' . date('H:00更新');
// } else {
// 	$use_wordpress = false;
// }
?>

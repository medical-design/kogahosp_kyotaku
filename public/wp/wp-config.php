<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * データベース設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** データベース設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'kogahosp_popuri_wp' );

/** データベースのユーザー名 */
define( 'DB_USER', 'kogahosp' );

/** データベースのパスワード */
define( 'DB_PASSWORD', 'c625ZTgQmEXZigM6' );

/** データベースのホスト名 */
define( 'DB_HOST', 'mysql57.kogahosp.sakura.ne.jp' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'DAun4o{uy$Sj8FqfxaN{olJ#E(IX5`x[Av)gc.:}PgN/A%}`yEK/gA^9pY`,/#kn');
define('SECURE_AUTH_KEY',  'lFuDI/E1ucx|d2|GhXB-p+$(*qP7 Kj$NMyfOzVE0}({|+LMM0D(={;B(3Nv*T H');
define('LOGGED_IN_KEY',    'A3S*xm:N;r)J%hvo--Xh(c-+K/t[k^mWHXlc<Y4><z&DwAvAE.3)+DQCm6l550l|');
define('NONCE_KEY',        'MMcV|P eB%1/%%K>IP[l >cFE ~&Aw%+AV5|x_3UU!)CRB|YX,x<4<},-X=<2YtE');
define('AUTH_SALT',        ']{@o~M[48Fe`-|LwZK?iVtI/!lRR_td[Qd#A+nZ?`&!=4LX*cIx_K1-i_, kGq4.');
define('SECURE_AUTH_SALT', ':#$*{WmW_u5>^c*oe$Hf^Vi[#>XSTIc=v4K/5taOy]?#7-ObhF5`dj+npzzg76wh');
define('LOGGED_IN_SALT',   'CY{i/[M`*GcK}dhghv8f&A-1F-Qn:dHs-K_ +T|l_bbMXEPbgY/*PhVTZRf1=%!n');
define('NONCE_SALT',       '].eTj,4D;U&U4^:^1{Y_lAS(Ga:.+-^p!et}]bXSmPZ[=]va}&hg|0:e29{ZzNEy');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_popuri_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* カスタム値は、この行と「編集が必要なのはここまでです」の行の間に追加してください。 */



/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
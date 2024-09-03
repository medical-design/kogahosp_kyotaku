<?php

// $_REQUEST 内容により、通常 wordpress のテーマ処理に変更し、トップページは表示しない
if (
		(! empty($_REQUEST))
	&&	(
			// wordpress管理画面 プレビューボタンなど、 wordpress 処理にしたい REQUESTがあるか?
			(isset($_GET['p']) && $_GET['p'])
		||	(isset($_GET['page_id']) && $_GET['page_id'])
	)
) {
	/**
	 * Front to the WordPress application. This file doesn't do anything, but loads
	 * wp-blog-header.php which does and tells WordPress to load the theme.
	 *
	 * @package WordPress
	 */

	/**
	 * Tells WordPress to load the WordPress theme and output it.
	 *
	 * @var bool
	 */
	define( 'WP_USE_THEMES', true );

	/** Loads the WordPress Environment and Template */
	require realpath(dirname(__FILE__) . '/../') . '/wp/wp-blog-header.php';



	/********************************************************
	 *
	 *	この場合、トップページは表示しない
	 *
	 ********************************************************/
	exit;
}


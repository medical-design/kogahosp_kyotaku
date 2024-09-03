<?php
/********************************************************
 *
 *	block 関係
 *
 ********************************************************/

// エディタースタイル
add_action('enqueue_block_editor_assets', function() {
	$editor_style_url = get_stylesheet_directory_uri() . '/editor-style.css';
	wp_enqueue_style( 'theme-editor-style', $editor_style_url );
});

/**
 * 特定ブロックに css script を追加
 */
function custom_render_block( $block_content, $block ){
	return $block_content;
}
add_filter('render_block', 'custom_render_block', 10, 2);

// カスタムブロック登録
function init_acf_custom_block()
{
	if(function_exists('acf_register_block_type'))
	{
		acf_register_block_type([
			'name'              => 'link',
			'title'             => __('リンク'),
			'description'       => __('タイプから選べるリンクを追加できます。'),
			'render_template'   => 'block/link.php',
			'category'          => 'unique', // text | media | design | widgets | theme | embed
			'icon'              => 'block-default',
			'keywords'          => ['event'],
			'mode'              => 'auto',
			'supports'          => [
				'align'         => false,
				'align_text'    => false,
				'align_content' => false,
			],
		]);
		acf_register_block_type([
			'name'              => 'link_list',
			'title'             => __('リンクリスト'),
			'description'       => __('リンクのリストです。'),
			'render_template'   => 'block/link_list.php',
			'category'          => 'unique', // text | media | design | widgets | theme | embed
			'icon'              => 'editor-ul',
			'keywords'          => ['event'],
			'mode'              => 'auto',
			'supports'         	 => [
				'align'         => false,
				'align_text'    => false,
				'align_content' => false,
			],
		]);
		acf_register_block_type([
			'name'              => 'btn',
			'title'             => __('リンクボタン'),
			'description'       => __('リンク用のボタンです。'),
			'render_template'   => 'block/btn.php',
			'category'          => 'unique', // text | media | design | widgets | theme | embed
			'icon'              => 'editor-ul',
			'keywords'          => ['event'],
			'mode'              => 'auto',
			'supports'         	 => [
				'align'         => false,
				'align_text'    => false,
				'align_content' => false,
			],
		]);
		acf_register_block_type([
			'name'              => 'set',
			'title'             => __('画像とテキストの横並び'),
			'description'       => __('画像とテキストを横並びにすることができます。'),
			'render_template'   => 'block/set.php',
			'category'          => 'unique', // text | media | design | widgets | theme | embed
			'icon'              => 'columns',
			'keywords'          => ['event'],
			'mode'              => 'auto',
			'supports'          => [
				'align'         => false,
				'align_text'    => false,
				'align_content' => false,
			],
		]);
		acf_register_block_type([
			'name'              => 'img_column',
			'title'             => __('画像横並び'),
			'description'       => __('画像を横に並べます。2列、3列、4列から選べます。'),
			'render_template'   => 'block/img_clumn.php',
			'category'          => 'unique', // text | media | design | widgets | theme | embed
			'icon'              => 'format-gallery',
			'keywords'          => ['event'],
			'mode'              => 'auto',
			'supports'          => [
				'align'         => false,
				'align_text'    => false,
				'align_content' => false,
			],
		]);
	}
}
add_action('acf/init', 'init_acf_custom_block');

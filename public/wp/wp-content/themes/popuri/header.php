<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package koga
 */
	$page_label = get_the_title();

	if (is_single()) {

		global $current_category;
		global $is_department_category;

		$is_department_category = false;

		$category_array = get_the_terms($post->ID, 'category');
		$parent_term_id_list = [];
		foreach ($category_array as $category) {
			if ($category->parent && ! in_array($category->parent, $parent_term_id_list)) {
				array_push($parent_term_id_list, $category->parent);
			}

			if ($category->slug === 'dep') {
				$is_department_category = true;
			}
		}
		$current_category = null;
		foreach ($category_array as $category) {
			if (in_array($category->term_id, $parent_term_id_list)) {
				continue;
			} else {
				$current_category = $category;
				break;
			}
		}
	}

	$slug = $post->post_name;
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<title><?= page_title($page_label) ?></title>
		<?php
			include DIR_SITE_INCLUDE . 'head.php';
			wp_head();

			if($slug === "contact") {
		?>
				<link rel="stylesheet" href="/common/css/form.css">
		<?php
			}
		?>
	</head>
	<body>
		<div class="root">
			<img class="fix_bg" src="/common/img/bg.webp" alt="" loading="lazy">
			<?php include DIR_SITE_INCLUDE . 'header.php'; ?>



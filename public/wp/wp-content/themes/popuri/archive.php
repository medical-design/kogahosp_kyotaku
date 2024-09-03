<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package koga
 */


$queried = get_queried_object();

wp_redirect('/' . $queried->slug);
exit;

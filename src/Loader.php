<?php 

if (!defined('ABSPATH')) die;

use Boyo\WPBangMeta\PostMeta;
use Boyo\WPBangMeta\TermMeta;
	
$config_post_meta = config('post_meta');

if(!empty($config_post_meta)) {
	
	$post_meta = PostMeta::instance();
	$post_meta->setFields($config_post_meta);
	
}

$config_term_meta = config('post_meta');

if(!empty($config_term_meta)) {
	
	$term_meta = TermMeta::instance();
	$term_meta->setFields($config_term_meta);
	
}
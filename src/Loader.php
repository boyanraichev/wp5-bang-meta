<?php 

if (!defined('ABSPATH')) die;

use Boyo\WPBangMeta\PostMeta;
use Boyo\WPBangMeta\TermMeta;

define('WP5BANGMETA_VERSION','0.4.0');

if (! function_exists('config')) {
	
	function config($key) {
		
		$config = \Boyo\WPBangMeta\Config::instance();
		
		return $config->get($key);
		
	}
	
}
	
$config_post_meta = config('post_meta');

if(!empty($config_post_meta)) {
	
	$post_meta = PostMeta::instance();
	$post_meta->setFields($config_post_meta);
	
}

$config_term_meta = config('term_meta');

if(!empty($config_term_meta)) {
	
	$term_meta = TermMeta::instance();
	$term_meta->setFields($config_term_meta);
	
}

add_action( 'admin_enqueue_scripts', 'bangMetaScripts' );

function bangMetaScripts() {

    wp_enqueue_media();
    
    wp_enqueue_script( 'jquery-ui-sortable' );
    
    wp_register_script( 'tat-js',  get_template_directory_uri() . '/vendor/boyo/wp5-bang-meta/assets/js/tat.js', [], '1.0.1', true );
	wp_enqueue_script('tat-js');

	wp_register_script( 'tat-admin',  get_template_directory_uri() . '/vendor/boyo/wp5-bang-meta/assets/js/bang.meta.js', ['jquery','tat-js'], WP5BANGMETA_VERSION, true );      
	wp_enqueue_script('tat-admin');

}

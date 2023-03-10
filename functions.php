<?php 
function theme_name_scripts() {
  	// WordPress本体のjquery.jsを読み込まない
	wp_deregister_script('jquery');
 
	// jQueryの読み込み
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', "", "20160608", false );

    wp_register_style('reset', 'https://unpkg.com/destyle.css@3.0.2/destyle.min.css', array(), '1.0', false);
    wp_enqueue_style('main', get_template_directory_uri().'/css/style.css', array('reset'), '1.0', false);
    wp_enqueue_style('second_style', get_template_directory_uri().'/css/lightbox.css', array('reset'), '1.0', false);
    wp_enqueue_style('third_style', get_template_directory_uri().'/css/lightbox.min.css', array('reset'), '1.0', false);
    wp_enqueue_script('second_script', get_template_directory_uri().'/js/lightbox.js', array('jquery'), '1.0', false);
    wp_enqueue_script('third_script', get_template_directory_uri().'/js/lightbox.min.js', array('jquery'), '1.0', false);
    wp_enqueue_script('custom_query', get_template_directory_uri().'/js/lightbox-plus-jquery.js', array('jquery'), '1.0', false);
    wp_enqueue_script('second_query', get_template_directory_uri().'/js/lightbox-plus-jquery.min.js', array('jquery'), '1.0', false);
    wp_enqueue_script('custom_script', get_template_directory_uri().'/js/sort-search.js', array('jquery'), '1.0', false);
    // 杉田追記ーーーーーーーーーー
    wp_enqueue_script('sidebar_script', get_template_directory_uri().'/js/sidebar.js', array('jquery'), '1.0', false);
    wp_enqueue_script('hamburger_script', get_template_directory_uri().'/js/hamburger.js', array('sidebar_script'), '1.0', false);
    // ーーーーーーーーーーーーーーーーーーー
    wp_enqueue_script('submit_script', get_template_directory_uri().'/js/submit.js', array(), '1.0', false);
    if (is_page('approachedit')) {
      wp_enqueue_script('submit_script');
}
}
  add_action('wp_enqueue_scripts', 'theme_name_scripts');

   add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );
 function dequeue_jquery_migrate( $scripts){
 	if(!is_admin()){
 		$scripts->remove( 'jquery');
 	}
 }

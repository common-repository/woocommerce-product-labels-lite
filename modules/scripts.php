<?php 

add_action('wp_print_scripts', 'wl_add_script_fn');
function wl_add_script_fn(){
	wp_enqueue_style('wl_bootsrap_css', plugins_url('/inc/assets/css/boot-cont.css', __FILE__ ) ) ;
	wp_enqueue_script('wl_bootstrap.js', plugins_url('/inc/assets/js/bootstrap.js', __FILE__ ), array('jquery'), '1.0' ) ;
	wp_enqueue_style('wl_default.css', plugins_url('/inc/icons/css/default.css', __FILE__ ) ) ;
	wp_enqueue_style('wl_component.css', plugins_url('/inc/icons/css/component.css', __FILE__ ) ) ;	 	
	wp_enqueue_script('wl_modernizr.custom.js', plugins_url('/inc/icons/js/modernizr.custom.js', __FILE__ ), array('jquery'), '1.0' ) ;
	
   if(is_admin()){
	//wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_media();
	wp_enqueue_script('wl_admin_js', plugins_url('/js/admin.js', __FILE__ ), array('jquery',  'wp-color-picker'), '1.0' ) ;
	wp_enqueue_style('wl_admin_css', plugins_url('/css/admin.css', __FILE__ ) ) ;	
  }else{
	wp_enqueue_script('wl_front_js', plugins_url('/js/front.js', __FILE__ ), array('jquery'), '1.0' ) ;
	wp_enqueue_style('wl_front_css', plugins_url('/css/front.css', __FILE__ ) ) ;
	
  }
}
?>
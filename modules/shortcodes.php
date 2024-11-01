<?php 
add_shortcode( 'imglabel', 'sc_shortcode_handler' );
function sc_shortcode_handler( $atts, $content = null ) {
   global $wpdb;
	$out = generate_image_block( $atts['id'] );
	  return $out; 
}

?>
<?php 
add_action('the_content', 'wl_process_content');
function wl_process_content( $content ){
global $post;
	
	$out = $content;
	
	if( get_post_meta( $post->ID,'integration_method', true ) == 'below' ){
		$out = $content.generate_image_block( $post->ID );
	}
	if( get_post_meta( $post->ID,'integration_method', true ) == 'above' ){
		$out = generate_image_block( $post->ID ).$content;
	}
	return $out;
}
?>
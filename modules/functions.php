<?php 
function generate_image_block( $post2use ){
	$post2process = get_post( $post2use );
	$out .= '
	<div class="tw-bs image_with_labels" id="image_with_labels">
		<div class="image_label_editor voo-icon">
			<img class="bg_main" src="'.( get_post_meta( $post2process->ID, 'bg_image', true ) ? get_post_meta( $post2process->ID, 'bg_image', true ) : plugins_url( '/images/test_white.jpg', __FILE__ ) ).'" />
		';
		$all_labels = array();
		$all_labels = json_decode( get_post_meta( $post2process->ID, 'json_data', true ) );
		
		if( count($all_labels) > 0 ){
		foreach( $all_labels as $single_label ){
			$out .= '
			<section class="draggable  spot_'.$single_label->id.'" 
			style="position:absolute; top:'.$single_label->ofy.'px; left:'.$single_label->ofx.'px;" 
			class="btn btn-danger" 
			data-id="'.$single_label->id.'" 			
			data-ofx="'.$single_label->ofx.'" 
			data-ofy="'.$single_label->ofy.'"   
			data-curx="'.$single_label->curx.'" 
			data-cury="'.$single_label->cury.'" 
			data-trigger="'.$single_label->trigger.'" 
			data-content="'.esc_attr( add_filter('the_content', $single_label->content ) ).'" 
	
			data-unactive_color="'.$single_label->unactive_color.'" 
			data-active_color="'.$single_label->active_color.'" 
			data-bg_color="'.$single_label->bg_color.'" 
			data-effect_list="'.$single_label->effect_list.'" 
			data-icon="'.$single_label->icon.'" >	
				<div class="hi-icon-wrap '.$single_label->effect_list.'">
					<div href="#set-1" class="hi-icon '.$single_label->icon.'  '.$single_label->unactive_color.' '.$single_label->active_color.' '.$single_label->bg_color.'"></div>
				</div>
			</section>
			';
		}
	}
		$out .= '			

		</div>
	</div>
	';
	return $out;
}	
?>
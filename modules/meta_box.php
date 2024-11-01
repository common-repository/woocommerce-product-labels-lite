<?php 
		

add_action( 'add_meta_boxes', 'wl_add_custom_box' );
function wl_add_custom_box() {
	global $current_user;
		add_meta_box( 
			'wl_image_editor',
			__( 'Edit Labels', 'wl' ),
			'wl_image_editor',
			'product' , 'advanced', 'high'
		);

		
		
		
}
function wl_image_editor(){
	global $post;
	global $current_user;
	wp_nonce_field( plugin_basename( __FILE__ ), 'label_noncename' );
	
	echo '
	<div class="tw-bs">
		<div class="form-horizontal">  
				<fieldset>  
				
				 <div class="control-group">  
					<label class="control-label" for="input01">'.__( 'Code to use', 'wl' ).'</label>  
					<div class="controls">  
					  <input type="text" class="widefat itemer" value="'.esc_attr('[imglabel id=\''.$post->ID.'\' ]').'" /> 
					  <p>'.__( 'You can use this shortcode in any place of post content', 'wl' ).'</p>           
					  <input type="text" class="widefat itemer" value="'.esc_attr('<?php echo do_shortcode("[imglabel id=\''.$post->ID.'\' ]"); ?>').'" />
					  <p>'.__( 'You can use this php code if you want to integrate it in source files.', 'wl' ).'</p>
					</div>  
				  </div>
				
			<div class="control-group">  
				<label class="control-label" for="select01">'.__( 'Where to show image?', 'wl' ).'</label> 
				<div class="controls">  
				  <select id="select01" name="integration_method" >  
					<option value="manual" '.( get_post_meta( $post->ID,'integration_method', true ) == 'manual' ? ' selected '  : '' ).' >'.__( 'Manual', 'wl' ).'</option>  
					<option  value="above" '.( get_post_meta( $post->ID,'integration_method', true ) == 'above' ? ' selected ' : '' ).' >'.__( 'Above Content', 'wl' ).'</option>  
					<option  value="below" '.( get_post_meta( $post->ID,'integration_method', true ) == 'below'  ? ' selected ' : '' ).' >'.__( 'Below Content', 'wl' ).'</option>  
				  </select>  
				</div> 
			</div> 

				  <div class="control-group">  
					<label class="control-label" for="fileInput">'.__( 'Select Image', 'wl' ).'</label>  
					<div class="controls">  
						<input type="text" class="input-xlarge" name="bg_image" id="main_image" value="'.get_post_meta( $post->ID, 'bg_image', true).'" >  
						<button type="button" class="btn btn-primary upload_button">'.__( 'Upload File', 'wl' ).'</button>  
            
					</div>  
				  </div>  
				  
				</fieldset>  
		</div>  
	<input type="hidden" name="json_data" id="json_data" value=\''.esc_attr( get_post_meta( $post->ID, 'json_data', true ) ).'\' />
        
		<!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">'.__( 'Label Properties', 'wl' ).'</h4>
          </div>
          <div class="modal-body">
           
		   
	<div class="form-horizontal">  
        <fieldset>  
          <div class="control-group hide">  
            <label class="control-label" for="input01">'.__( 'Preview', 'wl' ).'</label>  
            <div class="controls">  
				<div class="voo-icon modal_preview">
					<div id="set-1">
						
							<div class="hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a">										
								<div id="preview_tooltip" data-trigger="hover" data-content="It\'s so simple to create a tooltop for my website!" data-title="" data-default="hi-icon-mobile" class="hi-icon hi-icon-mobile white_unactive black white_bg ">Mobile</div>
							</div>
						
					</div>
				</div>
				
            </div>  
          </div>
		  
		  
		  
		  <div class="control-group  hide">  
            <label class="control-label" for="input01">'.__( 'Unactive Color', 'wl' ).'</label>  
            <div class="controls">  
              <select id="unactive_color">   
				<option value="pink_unactive">'.__( 'Pink', 'wl' ).'
				<option value="orange_unactive">'.__( 'Orange', 'wl' ).'
				<option value="brown_unactive">'.__( 'Brown', 'wl' ).'
				<option value="green_unactive">'.__( 'Green', 'wl' ).'
				<option value="blue_unactive">'.__( 'Blue', 'wl' ).'
				<option value="yellow_unactive">'.__( 'Yellow', 'wl' ).'
				<option value="black_unactive">'.__( 'Black', 'wl' ).'
				<option value="white_unactive">'.__( 'White', 'wl' ).'
				<option value="red_unactive">'.__( 'Red', 'wl' ).'
			  </select>
            </div>  
          </div>  
		  <div class="control-group hide">  
            <label class="control-label" for="input01">'.__( 'Hover Color', 'wl' ).'</label>  
            <div class="controls">  
              <select id="active_color">   
				<option value="pink">'.__( 'Pink', 'wl' ).'
				<option value="orange">'.__( 'Orange', 'wl' ).'
				<option value="brown">'.__( 'Brown', 'wl' ).'
				<option value="green">'.__( 'Green', 'wl' ).'
				<option value="blue">'.__( 'Blue', 'wl' ).'
				<option value="yellow">'.__( 'Yellow', 'wl' ).'
				<option value="black">'.__( 'Black', 'wl' ).'
				<option value="white">'.__( 'White', 'wl' ).'
				<option value="red">'.__( 'Red', 'wl' ).'
			  </select> 
            </div>  
          </div>
		  
		  <div class="control-group hide">  
            <label class="control-label" for="input01">'.__( 'Background Color', 'wl' ).'</label>  
            <div class="controls">  
              <select id="bg_color">   
				<option value="pink_bg">'.__( 'Pink', 'wl' ).'
				<option value="orange_bg">'.__( 'Orange', 'wl' ).'
				<option value="brown_bg">'.__( 'Brown', 'wl' ).'
				<option value="green_bg">'.__( 'Green', 'wl' ).'
				<option value="yellow_bg">'.__( 'Yellow', 'wl' ).'
				<option value="blue_bg">'.__( 'Blue', 'wl' ).'
				<option value="black_bg">'.__( 'Black', 'wl' ).'
				<option value="white_bg">'.__( 'White', 'wl' ).'
				<option value="red_bg">'.__( 'Red', 'wl' ).'
			  </select> 
            </div>  
          </div>
		  
       <!--
          <div class="control-group">  
            <label class="control-label" for="select01">Effect List</label>  
            <div class="controls">  
              <select id="effect_list">  
                <option value="hi-icon-effect-1 hi-icon-effect-1a">1a</option>  
				<option value="hi-icon-effect-1 hi-icon-effect-1b">1b</option>  
                <option value="hi-icon-effect-2 hi-icon-effect-2a">2a</option>  
				<option value="hi-icon-effect-2 hi-icon-effect-2b">2b</option>  
             
			   <option value="hi-icon-effect-3 hi-icon-effect-3a">3a</option>  
				<option value="hi-icon-effect-3 hi-icon-effect-3b">3b</option>  
                <option value="hi-icon-effect-4 hi-icon-effect-4a">4a</option>  
				<option value="hi-icon-effect-4 hi-icon-effect-4b">4b</option>  
                
				<option value="hi-icon-effect-5 hi-icon-effect-5a">5a</option>  
				<option value="hi-icon-effect-5 hi-icon-effect-5b">5b</option>
				
				<option value="hi-icon-effect-6 hi-icon-effect-6a">6a</option>  
				<option value="hi-icon-effect-6 hi-icon-effect-6b">6b</option> 
				
				<option value="hi-icon-effect-7 hi-icon-effect-7a">7a</option>  
				<option value="hi-icon-effect-7 hi-icon-effect-7b">7b</option> 
				
				<option value="hi-icon-effect-8 hi-icon-effect-8a">8a</option>  
				<option value="hi-icon-effect-8 hi-icon-effect-8b">8b</option> 
				
				<option value="hi-icon-effect-9 hi-icon-effect-9a">9a</option>  
				<option value="hi-icon-effect-9 hi-icon-effect-9b">9b</option> 
			
              </select>  
            </div>  
          </div>  
          -->
		  <div class="control-group">  
            <label class="control-label" for="select01">'.__( 'Show Popup Action', 'wl' ).'</label>  
            <div class="controls">  
              <select id="trigger">  
                <option value="click">'.__( 'Click', 'wl' ).'</option>  
				<option value="hover">'.__( 'Hover', 'wl' ).'</option>  
              </select>  
            </div>  
          </div>  
		  
		  <div class="control-group">  
            <label class="control-label" for="select01">'.__( 'Select list', 'wl' ).'</label>  
            <div class="controls voo-icon patched_modal">  
               <section id="set-11">
				<div class="">
				<div class="single_icon">
					<div data-default="hi-icon-location" class="hi-icon hi-icon-location unactive_black red">Location</div>
				</div>
				<div class="single_icon">
					<div data-default="hi-icon-mobile" class="hi-icon hi-icon-mobile unactive_black red">Mobile</div>
				</div>
				<div class="single_icon">
					<div data-default="hi-icon-screen" class="hi-icon hi-icon-screen unactive_black red">Desktop</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-earth" class="hi-icon hi-icon-earth unactive_black red">Partners</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-support" class="hi-icon hi-icon-support unactive_black red">Support</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-locked" class="hi-icon hi-icon-locked unactive_black red">Security</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-cog" class="hi-icon hi-icon-cog unactive_black red">Mobile</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-clock" class="hi-icon hi-icon-clock unactive_black red">Desktop</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-videos" class="hi-icon hi-icon-videos unactive_black red">Partners</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-list" class="hi-icon hi-icon-list unactive_black red">Support</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-refresh" class="hi-icon hi-icon-refresh unactive_black red">Security</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-images" class="hi-icon hi-icon-images unactive_black red">Images</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-pencil" class="hi-icon hi-icon-pencil unactive_black red">Edit</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-link" class="hi-icon hi-icon-link unactive_black red">Link</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-mail" class="hi-icon hi-icon-mail unactive_black red">Mail</div>
				</div>

				<div class="single_icon hide">
					<div data-default="hi-icon-archive" class="hi-icon hi-icon-archive unactive_black red">Archive</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-chat" class="hi-icon hi-icon-chat unactive_black red">Chat</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-bookmark" class="hi-icon hi-icon-bookmark unactive_black red">Bookmarks</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-user" class="hi-icon hi-icon-user unactive_black red">User</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-contract" class="hi-icon hi-icon-contract unactive_black red">Contact</div>
				</div>
				<div class="single_icon hide">
					<div data-default="hi-icon-star" class="hi-icon hi-icon-star unactive_black red">Contact</div>
				</div>
			<!--
				<div class="single_icon">
					<div data-default="hi-icon-warning_sign" class="hi-icon hi-icon-warning_sign unactive_black red">Warning</div>
				</div>
			-->				
				
				<div class="clearfix"></div>
				
				</div>
			</section>
            </div>  
          </div> 
		  
           
          <div class="control-group">  
            <label class="control-label" for="textarea">'.__( 'Label Content', 'wl' ).'</label>  
            <div class="controls">  
              <textarea class="input-xlarge" id="content_editor" rows="3"></textarea>  
            </div>  
          </div>  
   
        </fieldset>  
</div>  

		   
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save_button">'.__( 'Save changes', 'wl' ).'</button>
			<button type="button" class="btn btn-warning" id="delete_button">'.__( 'Delete Button', 'wl' ).'</button>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <input type="hidden" id="current_edition" />
	<input type="hidden" id="counter_num" />
		
		
		<div class="image_label_editor voo-icon">
			<img src="'.( get_post_meta( $post->ID, 'bg_image', true) ? get_post_meta( $post->ID, 'bg_image', true) :  plugins_url( '/images/test_white.jpg', __FILE__ ) ).'" />
		';
		$all_labels = array();
		$all_labels = json_decode( get_post_meta( $post->ID, 'json_data', true ) );
		
		if( count($all_labels) > 0 ){
		foreach( $all_labels as $single_label ){
			echo '
			<section class="draggable  spot_'.$single_label->id.'" 
			style="position:absolute; top:'.$single_label->ofy.'px; left:'.$single_label->ofx.'px;" 
			class="btn btn-danger" 
			data-id="'.$single_label->id.'" 			
			data-ofx="'.$single_label->ofx.'" 
			data-ofy="'.$single_label->ofy.'"   
			data-curx="'.$single_label->curx.'" 
			data-cury="'.$single_label->cury.'" 
			data-trigger="'.$single_label->trigger.'" 
			data-content="'.esc_attr($single_label->content).'" 
			 
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
		echo '			

		</div>
	</div>
	<style>
	.image_label_editor{
		position:relative;
	}
	.image_label_editor, .image_label_editor img{
		width:100%;
	}
	.single_label{
		position:absolute;
		height:10px;
		width:10px;
		background:#f0f;
		border-radius:5px;
	}
	</style>

	';

}


add_action( 'save_post', 'wl_save_postdata' );
function wl_save_postdata( $post_id ) {
global $current_user; 
 if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
  if ( !wp_verify_nonce( $_POST['label_noncename'], plugin_basename( __FILE__ ) ) )
      return;
  if ( 'page' == $_POST['post_type'] ) 
  {
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
  }
  else
  {
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
  }
  /// User editotions
  if( get_post_type( $post_id ) == 'product' ){
  update_post_meta( $post_id, 'json_data', $_POST['json_data'] );
  update_post_meta( $post_id, 'integration_method', $_POST['integration_method'] );
  update_post_meta( $post_id, 'bg_image', $_POST['bg_image'] );
  
  }
		
  
  
}

?>
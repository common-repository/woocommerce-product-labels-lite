<?php 
	
add_action('admin_menu', 'wl_item_menu');

function wl_item_menu() {
	add_submenu_page( 'woocommerce',  __('Labels', 'wl'), __('Labels', 'wl'), 'edit_published_posts', 'wl_config', 'wl_config');

}

function wl_config(){

?>
<div class="wrap tw-bs">
<h2><?php _e('Settings', 'wl'); ?></h2>

 <?php if(  (is_admin() ) && wp_verify_nonce($_POST['save_form_nonce'],'save_form_action') ): ?>
 
  
  <?php 

  $wl_options = array(	
	'integration_method' =>  $_POST['integration_method'], 
  );
  update_option('wl_options', $wl_options );

  
  ?> 
 <div id="message" class="updated" ><?php _e('Saved', 'sc'); ?></div>
 
  
  <?php endif; ?> 
  
   
  <form class="form-horizontal" action="" method="POST">  
  
  <?php 
$config = get_option('wl_options'); 
wp_nonce_field( 'save_form_action', 'save_form_nonce' );

?> 
  
        <fieldset>  
       
   
		<div class="control-group">  
            <label class="control-label" for="select01">Integration Method</label>  
            <div class="controls">  
              <select id="select01" name="integration_method" >  
                <option value="manual" <?php if( $config['integration_method'] == 'manual' ) echo ' selected '; ?> >Manual</option>  
                <option  value="above" <?php if( $config['integration_method'] == 'above' ) echo ' selected '; ?> >Above Content</option>  
                <option  value="below" <?php if( $config['integration_method'] == 'below' ) echo ' selected '; ?> >Below Content</option>  
              </select>  
            </div>  
          </div> 

   
          <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Save Settings</button>  
          </div>  
        </fieldset>  
</form>  


</div>


<?php 
}

?>
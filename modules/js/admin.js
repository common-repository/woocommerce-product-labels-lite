jQuery(document).ready(function($){

$('.itemer').click(function(){
		$(this).select();
	})

var size_patch = 22;

$( ".draggable" ).draggable({ 
containment: "parent",
start:function( event, ui ) {
	$(".draggable").popover('destroy'); 
},
stop:function( event, ui ) {
	
	//var posX = $('.image_label_editor').offset().left, posY = $('.image_label_editor').offset().top;
	var off_x = ui.position.left ; //ui.position.left - posX;
	var off_y = ui.position.top; //ui.position.top - posY;	
	

	$(event.target).attr( 'data-ofx', off_x );
	$(event.target).attr( 'data-ofy', off_y );
	
	$(event.target).attr( 'data-curx', $('.image_label_editor img').width() );
	$(event.target).attr( 'data-cury', $('.image_label_editor img').height() );
	
	//$(this).css( 'left', off_x+'px' );
	//$(this).css( 'top', off_y+'px' );
	$(".draggable").popover({html:true, placement: 'auto'});  
}
 });
$(window).resize(function () { 
	recalculate_align();
});
function recalculate_align(){
	$('.draggable').each(function(){
		var ofx = $(this).attr('data-ofx');
		var ofy = $(this).attr('data-ofy');
		var curx = $(this).attr('data-curx');
		var cury = $(this).attr('data-cury');
		
		var new_offset_x =  ( $('.image_label_editor img').width() * ofx ) / curx ;
		var new_offset_y = ( $('.image_label_editor img').height() * ofy ) / cury;
		
		if( $('.image_label_editor img').width() < 500 ){
			var patched_data = 10;
			new_offset_x = new_offset_x - patched_data;
			new_offset_y = new_offset_y - patched_data;
		}
		if( $('.image_label_editor img').width() < 750 ){
			var patched_data = 5;
			new_offset_x = new_offset_x - patched_data;
			new_offset_y = new_offset_y - patched_data;
		}
		
		
		
		
		$(this).css( 'left', new_offset_x+'px' );
		$(this).css( 'top', new_offset_y+'px' );
	})
}


$( '.image_label_editor img' ).click( function(e){
	var cnt = 0;
	var global_cnt_id;
	$('.image_label_editor .draggable').each(function(){
		
		cnt++;
	})
	global_cnt_id = cnt;
	
	//$('.image_label_editor').css('border', '1px solid #f0f' );
	
	var posX = $('.image_label_editor').offset().left, posY = $('.image_label_editor').offset().top;
	var off_x = e.pageX - posX;
	var off_y = e.pageY - posY;					
	
	// percentage offset
	var percent_x = ( ( off_x - size_patch )*100 ) / $('.image_label_editor img').width()  ;
	var percent_y = ( ( off_y - size_patch )*100 ) / $('.image_label_editor img').height()  ;
	
	var point_x = off_x - size_patch;
	var point_y = off_y - size_patch;
	jQuery('#single_x').val( point_x );
	jQuery('#single_y').val( point_y );
	current_bl_id = global_cnt_id;
	jQuery(".image_label_editor").append('\
	<section data-id="'+global_cnt_id+'" class="draggable spot_'+global_cnt_id+'" style="position:absolute; top: '+point_y+'px; left: '+point_x+'px;" data-ofx="'+point_x+'" data-ofy="'+point_y+'" data-curx="'+$('.image_label_editor img').width()+'" data-cury="'+$('.image_label_editor img').height()+'" data-trigger="hover" data-content="" data-title="" data-unactive_color="white_unactive" data-active_color="black" data-bg_color="white_bg" data-effect_list="hi-icon-effect-1 hi-icon-effect-1a" data-icon="hi-icon-location" >\
		<div class="hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a ">\
			<div  class="hi-icon hi-icon-location white_unactive black white_bg"></div>\
		</div>\
	</section>');

	$( ".draggable" ).draggable({ containment: "parent" });
	$(".draggable").popover({html:true, placement: 'auto'});  
	
	//var img = '<img src="https://si0.twimg.com/a/1339639284/images/three_circles/twitter-bird-white-on-blue.png" />';

	//$(".draggable").popover({ title: 'Look! A bird!', content: img, html:true });
	
})

$('.draggable').live('click', function(){

	$('#current_edition').val( $(this).attr('data-id') );
	// make activation
	var active_label = $( ".hi-icon ", this ).attr("class");	
	$('.patched_modal a').each(function(){

		if( $(this).attr('class') == active_label ){					
			$(this).parents('.single_icon').addClass( 'active_label' );
		}
	})

	
	// process selectors
	$('#unactive_color').val( $(this).attr('data-unactive_color') );
	$('#active_color').val( $(this).attr('data-active_color') );
	$('#bg_color').val( $(this).attr('data-bg_color') );	
	$('#effect_list').val( $(this).attr('data-effect_list') );
	$('#trigger').val( $(this).attr('data-trigger') );
	
	// icon processing
	$('.active_label').removeClass('active_label');
	var cur_label = $(this).attr('data-icon');
	
	$('.patched_modal .hi-icon').each(function(){
	
		if( $(this).attr('data-default') == cur_label ){					
			$(this).parents('.single_icon').addClass( 'active_label' );
		}
	})
	
	
	// adding content to editor
	
	$('#content_editor').val( $( this ).attr('data-content') );
	generate_preview();
	$('#myModal').modal('show');  
})

$('#unactive_color, #active_color, #bg_color, #content_editor, #trigger').change(function(){
	
	// preview functionality
	
	
	/*
	$('.patched_modal .hi-icon').each(function(){
		$(this).attr( 'class', 'hi-icon '+$(this).attr('data-default')+' '+$('#unactive_color').val()+' '+$('#active_color').val() );
	})
	 */
	generate_preview();
});

function generate_preview(){
	var icon_class = $('.active_label .hi-icon').attr('data-default' );
	$('.modal_preview .hi-icon').attr( 'class', 'hi-icon '+icon_class+' '+$('#unactive_color').val()+' '+$('#active_color').val()+' '+$('#bg_color').val() );
	$("#preview_tooltip").attr('data-content', $('#content_editor').val() );	
	$("#preview_tooltip").popover({html:true, placement: 'auto'});	
}

$('#delete_button').live('click', function(){	
  $('.spot_'+$('#current_edition').val() ).replaceWith('');
  $('#myModal').modal('hide');
})

$('.patched_modal .hi-icon').click(function(){
	//$('.spot_'+$('#current_edition').val()+' .hi-icon' ).attr('class', $(this).attr('class') );
	$('.active_label').removeClass('active_label');
	$(this).parents('.single_icon').addClass('active_label');
	generate_preview();
})

$('#save_button').live('click', function(){
	$('.spot_'+$('#current_edition').val() ).attr( 'data-unactive_color', $('#unactive_color').val() );
	$('.spot_'+$('#current_edition').val() ).attr( 'data-active_color', $('#active_color').val() );
	$('.spot_'+$('#current_edition').val() ).attr( 'data-bg_color', $('#bg_color').val() );
	$('.spot_'+$('#current_edition').val() ).attr( 'data-effect_list', $('#effect_list').val() );
	//$('.spot_'+$('#current_edition').val() ).attr( 'data-active_label', $('#effect_list').val() );
	$('.spot_'+$('#current_edition').val() ).attr( 'data-icon', $('.active_label div').attr('data-default') );
	$('.spot_'+$('#current_edition').val() ).attr( 'data-content', $('#content_editor').val() );
	$('.spot_'+$('#current_edition').val() ).attr( 'data-trigger', $('#trigger').val() );	
	
	// processing front end labels
	var icon_class = $('.active_label div').attr('data-default' );
	$('.spot_'+$('#current_edition').val()+' .hi-icon       ' ).attr( 'class', 'hi-icon '+icon_class+' '+$('#unactive_color').val()+' '+$('#active_color').val()+' '+$('#bg_color').val() );
	//$("#preview_tooltip").attr('data-content', $('#content_editor').val() );
	$('.spot_'+$('#current_edition').val() ).attr('data-content', $('#content_editor').val() );	
	$('#myModal').modal('hide');
})

$('#effect_list').change(function(){
	if( $(this).val() == '1a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a';
	}
	if( $(this).val() == '1b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1b';
	}
	if( $(this).val() == '2a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-2 hi-icon-effect-2a';
	}
	if( $(this).val() == '2b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-2 hi-icon-effect-2b';
	}
	if( $(this).val() == '3a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a';
	}
	if( $(this).val() == '3b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3b';
	}
	if( $(this).val() == '4a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-4 hi-icon-effect-4a';
	}
	if( $(this).val() == '4b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-4 hi-icon-effect-4b';
	}
	if( $(this).val() == '5a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5a';
	}
	if( $(this).val() == '5b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-5 hi-icon-effect-5b';
	}
	if( $(this).val() == '6a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-6 hi-icon-effect-6a';
	}
	if( $(this).val() == '6b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-6 hi-icon-effect-6b';
	}
	if( $(this).val() == '7a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-7 hi-icon-effect-7a';
	}
	if( $(this).val() == '7b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-7 hi-icon-effect-7b';
	}
	if( $(this).val() == '8a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-8 hi-icon-effect-8a';
	}
	if( $(this).val() == '8b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-8 hi-icon-effect-8b';
	}
	if( $(this).val() == '9a'){
		var class_name = 'hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9a';
	}
	if( $(this).val() == '9b'){
		var class_name = 'hi-icon-wrap hi-icon-effect-9 hi-icon-effect-9b';
	}
//hi-icon-wrap hi-icon-effect-1 hi-icon-effect-1a
	//$('.spot_'+$('#current_edition').val()+' div.hi-icon-wrap' ).attr('class', class_name );

	
	//$('.patched_modal .hi-icon-wrap').attr('class', class_name );
	
	//preview
	$('.modal_preview .hi-icon-wrap').attr('class', class_name );
	
})

$(".draggable").popover({html:true, placement: 'auto'});  
$('.color-field').wpColorPicker();

$('.image_label_editor a, .patched_modal a').click(function(e) {
     // do something fancy
     return false; // prevent default click action from happening!
     e.preventDefault(); // same thing as above
});
$('#publish').click(function(){
	var json_obj = [];
	$('.draggable').each(function(){
		json_obj.push({ 
		id: $(this).attr('data-id'), 		
		ofx: $(this).attr('data-ofx'), 
		ofy: $(this).attr('data-ofy'), 
		curx: $(this).attr('data-curx'), 
		cury: $(this).attr('data-cury'), 
		trigger: $(this).attr('data-trigger'),  
		content: $(this).attr('data-content'), 
		title: $(this).attr('data-title'), 
		unactive_color: $(this).attr('data-unactive_color'), 
		active_color: $(this).attr('data-active_color'), 
		bg_color: $(this).attr('data-bg_color'), 
		effect_list: $(this).attr('data-effect_list'),  
		icon: $(this).attr('data-icon'), 
		
		})
	})
	var myJSONText = JSON.stringify( json_obj );
	jQuery('#json_data').val( myJSONText );
})

recalculate_align();


// uploading image
// Uploading files
var file_frame;
var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
var set_to_post_id = 10; // Set this
 
  jQuery('.upload_button').live('click', function( event ){
 
	var r=confirm("Are you sure, you want to change image? All labels will be removed.");
	if ( r == false )
	{
		return false;
	}
	
    event.preventDefault();
 
    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      // Set the post ID to what we want
      file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
      // Open frame
      file_frame.open();
      return;
    } else {
      // Set the wp.media post id so the uploader grabs the ID we want when initialised
      wp.media.model.settings.post.id = set_to_post_id;
    }
 
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });
 
    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();
 
      // Do something with attachment.id and/or attachment.url here
      $('#main_image').val( attachment.url );
	  $('.image_label_editor img').attr( 'src', attachment.url );
	  $('.image_label_editor section').replaceWith('');
      // Restore the main post ID
      wp.media.model.settings.post.id = wp_media_post_id;
    });
 
    // Finally, open the modal
    file_frame.open();
  });
  

}); // main jquery container

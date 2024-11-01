jQuery(document).ready( function($){
	recalculate_align();
$(window).resize(function () { 
	recalculate_align();
});
function recalculate_align(){
	$('.draggable').each(function(){
		var ofx = $(this).attr('data-ofx');
		var ofy = $(this).attr('data-ofy');
		var curx = $(this).attr('data-curx');
		var cury = $(this).attr('data-cury');
		
		var top_element = $(this).parent();
    
   
		var new_offset_x =  ( $('.bg_main', top_element ).width() * ofx ) / curx ;
		var new_offset_y = ( $('.bg_main', top_element ).height() * ofy ) / cury;
      
		if( $('.image_with_labels img').width() < 500 ){
			var patched_data = 10;
			new_offset_x = new_offset_x - patched_data;
			new_offset_y = new_offset_y - patched_data;
		}
		if( $('.image_with_labels img').width() < 750 ){
			var patched_data = 5;
			new_offset_x = new_offset_x - patched_data;
			new_offset_y = new_offset_y - patched_data;
		}
		
		
		
		
		$(this).css( 'left', new_offset_x+'px' );
		$(this).css( 'top', new_offset_y+'px' );
	})
}
$("body").append('<ast class="tw-bs" id="temp_stg"></ast>');
$(".draggable").popover({html:true, container: 'ast', placement: 'auto'}); 	


$('.bg_main').on('load',function(){
  recalculate_align();
});

}) // global end



jQuery(document).ready(function($){
	var bracket_col_num = $('.bracket-col').length;
	var click_count = 0;
	var first_col_height = $('.bracket-col').filter(':first').height();
	
	$('.bracket-wrap').height(first_col_height + 52);
	$('.bracket-shortcode-wrapper').width(1048);
	
	if( bracket_col_num > 4 ){
		$('#next-round').removeClass('move-hidden');
		$('#prev-round').removeClass('move-hidden').addClass('move-disabled');
		$('.bracket-col').eq(4).addClass('move-hidden');
		$('.bracket-col').eq(5).addClass('move-hidden');
		$('.bracket-col').eq(6).addClass('move-hidden');
	}
	
	if( bracket_col_num == 3 ){
		$('.bracket-col').filter(':first').css('margin-left', '101px');
	}
	
	$(document).on('click', '#next-round', function(){
		if((bracket_col_num - click_count) == 4) return;
		click_count++;
		bracket_next_round(bracket_col_num, click_count);
	})
	.on('click', '#prev-round', function(){
		if(click_count == 0) return;
		click_count--;
		bracket_prev_round(bracket_col_num, click_count);
	});
	
});

function bracket_next_round( col_num, click ){
	var hide_col = jQuery('.bracket-col').eq(click - 1);
	var show_col = jQuery('.bracket-col').eq(click + 3);
	hide_col.addClass('move-hidden');
	show_col.removeClass('move-hidden');
	jQuery('#prev-round').removeClass('move-disabled');
	var last_col = jQuery('.bracket-col').filter(':last').hasClass('move-hidden');
	if(!last_col){
		jQuery('#next-round').addClass('move-disabled');
	}
}

function bracket_prev_round( col_num, click ){
	var show_col = jQuery('.bracket-col').eq(click);
	var hide_col = jQuery('.bracket-col').eq(click + 4);
	show_col.removeClass('move-hidden');
	hide_col.addClass('move-hidden');
	jQuery('#next-round').removeClass('move-disabled');
	var first_col = jQuery('.bracket-col').filter(':first').hasClass('move-hidden');
	if(!first_col){
		jQuery('#prev-round').addClass('move-disabled');
	}
}
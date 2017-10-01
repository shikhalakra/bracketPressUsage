jQuery(document).ready(function($){
	var bracket_col_num = $('.bracket-col').length;
	var bracket_group_num = $('.bracket-col').filter(':first').children().length;
	var click_count = 0;
		
	if( bracket_col_num > 4 ){
		$('#next-round').removeClass('move-hidden');
		$('#prev-round').removeClass('move-hidden').addClass('move-disabled');
		$('.bracket-col').eq(4).addClass('move-hidden');
		$('.bracket-col').eq(5).addClass('move-hidden');
		$('.bracket-col').eq(6).addClass('move-hidden');
	}
		
	$(document).on('click', '.bracket-col:not(:nth-last-of-type(2)) .dashicons-arrow-right-alt', function(event){
		event.stopPropagation();
		$(this).parent().bracket_advance();
	})
	.on('click', '.dashicons-arrow-left-alt', function(event){
		event.stopPropagation();
		$(this).parent().bracket_deadvance().update_bracket();
	})
	.on('click', '.bracket-col:nth-last-of-type(2) .dashicons-arrow-right-alt', function(event){
		event.stopPropagation();
		if( match_name_string != '' ){
			var last_col = $('.bracket-col').filter(':last').children('.bracket-finalist');
		}else{
			var last_col = $('.bracket-col').filter(':last').children('.bracket-finalist-no-name');
		}
		var item = $(this).parent().clone();
		$(this).siblings('.item-counter').text(item_count_max);
		item.find('.item-counter').remove();
		last_col.text(item.text()).prepend('<span class="dashicons dashicons-arrow-left-alt"></span>');
		$(this).parent().update_bracket();
	})
	.on('click', '#next-round', function(){
		if((bracket_col_num - click_count) == 4) return;
		click_count++;
		bracket_next_round(bracket_col_num, click_count);
	})
	.on('click', '#prev-round', function(){
		if(click_count == 0) return;
		click_count--;
		bracket_prev_round(bracket_col_num, click_count);
	})
	.on('click', '.bracket-item:not(:has(span))', function(){
		$(this).bracket_TBD();
	})
	.on('click', '.bracket-finalist', function(){
		$(this).bracket_TBD();
	})
	.on('click', '.bracket-finalist-no-name', function(){
		$(this).bracket_TBD();
	});
	
	$('.save-bracket').on('click', function(){
		var bracket_save_array = [];
		for( var x = 0; bracket_col_num > x; x++ ){
			var current_col = $('.bracket-col').eq(x);
			bracket_save_array[x] = [];
			for( var a = 0; bracket_group_num > a; a++ ){
				var current_group = current_col.children().eq(a);
				var first_item = current_group.children('.bracket-item:nth-last-of-type(2)').clone();
				var second_item = current_group.children('.bracket-item:nth-last-of-type(1)').clone();
				var final_item = $('.bracket-col').filter(':last').children().text();
				if( ( bracket_col_num - 1 ) == x ){
					bracket_save_array[x].push(final_item);
				}else{
					bracket_save_array[x].push(first_item.text());
					bracket_save_array[x].push(second_item.text());
				}
			}
			bracket_group_num /= 2;
		}
		$('[name="tournament-bracket-save[save]"]').val(bracket_save_array);
	});
	
	$('.reset-bracket').on('click', function(){
		$('[name="tournament-bracket-save[save]"]').val("");
	});
	
});

var item_count_max;
function bracket_item_counter( type ){
	jQuery(document).ready(function($){
		var max;
		switch( true ){
			case type == "Best of one":
				max = 1;
				break;
			case type == "Best of three":
				max = 2;
				break;
			case type == "Best of five":
				max = 3;
				break;
			default:
				max = 1;
		}
		item_count_max = max;
		$(document).on('click', '.item-counter', function(){
			var col_index = $(this).parent().parent().parent().index();
			var col_length = $('.bracket-col').length;
			var count = $(this).text();
			var sibling_counter = $(this).parent().siblings('.bracket-item').children('.item-counter');
			var sibling_text = sibling_counter.text();
			$(this).wrap('<input class="item-counter-input" maxLength="1" type="text" value="' + count + '">');
			$('.item-counter-input').trigger('focus');
			$('.item-counter-input').on('input', function(){
				count = $('.item-counter-input').val();
				if( count > max ){
					count = max;
				}
			}).on('focusout', function(){
				var item_counter = $(this).children();
				item_counter.unwrap();
				item_counter.text(count);
				if( count == max && sibling_text == count ){
					sibling_counter.text(0);
				}
				if( ( col_index + 1 ) == col_length && count == max ){
					item_counter.siblings('.dashicons-arrow-right-alt').trigger('click');
				}
				if( count == max ){
					item_counter.parent().bracket_advance();
				}
			});
		});
	});
}

function bracket_match_name( current_item ){
	var match_name = current_item.siblings('.match-name');
	var item_one = match_name.siblings('.bracket-item').filter(':first').text();
	item_one = item_one.replace('0', '');
	var item_two = match_name.siblings('.bracket-item').filter(':last').text();
	item_two = item_two.replace('0', '');
	match_name.text(item_one + " vs " + item_two);
}

var match_name_string;
function bracket_match_name_string( match_name_status ){
	if( match_name_status != '' ){
		match_name_string = '-match-name';
	}else{
		match_name_string = '';
	}
}

function bracket_item_counter_check( current_item ){
	var current_counter = current_item.children('.item-counter').text();
	var sibling_counter = current_item.siblings('.bracket-item').children('.item-counter');
	if( sibling_counter.text() == current_counter ){
		sibling_counter.text(0);
	}
}

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

jQuery.fn.extend({
	bracket_advance: function(){
		return this.each(function(){
			jQuery(this).children('.item-counter').text(item_count_max);
			bracket_item_counter_check(jQuery(this));
			var item_pos = jQuery(this).index() - 1;
			var group_pos = jQuery(this).parent().index();
			var col_pos = jQuery(this).parent().parent().index() - 1;
			var current_item = jQuery(this).clone();
			current_item.find('.dashicons-arrow-left-alt').remove();
			current_item.find('.item-counter').text('0');
			var next_item = jQuery('.bracket-col').eq(col_pos + 1).children('.bracket-group' + match_name_string).eq(group_pos > 1 ? ( ( Math.ceil( group_pos / 2 ) ) - 1 ) : ( group_pos - 1 )).children('.bracket-item');
			var next_item2 = jQuery('.bracket-col').eq(col_pos + 1).children('.bracket-group' + match_name_string).eq(group_pos > 1 ? ( ( Math.ceil( group_pos / 2 ) ) ) : ( group_pos )).children('.bracket-item');
			var next_col_item = jQuery('.bracket-col').eq(col_pos + 2).children('.bracket-group' + match_name_string).eq(group_pos > 1 ? ( ( Math.ceil( group_pos / 2 ) ) - 1 ) : ( group_pos - 1 )).children('.bracket-item');
			var next_col_item2 = jQuery('.bracket-col').eq(col_pos + 2).children('.bracket-group' + match_name_string).eq(group_pos > 1 ? ( ( Math.ceil( group_pos / 2 ) ) ) : ( group_pos )).children('.bracket-item');
			if( group_pos % 2 === 0 ){
				if( item_pos == 2 || match_name_string == '' && item_pos == 1 ){
					if( match_name_string != '' ){
						var replaced_item = next_item2.eq(item_pos - 2);
						var next_col_item_check = next_col_item2.eq(item_pos - 2);
					}else{
						var replaced_item = next_item2.eq(item_pos - 1);
						var next_col_item_check = next_col_item2.eq(item_pos - 1);
					}
					current_item.prepend('<span class="dashicons dashicons-arrow-left-alt"></span>');
					replaced_item.replaceWith(current_item);
					bracket_match_name(current_item);
					if( current_item != next_col_item_check.text() && next_col_item_check.text() != "" ){
						next_col_item_check.text("");
					}
				}else{
					if( match_name_string != '' ){
						var replaced_item = next_item2.eq(item_pos);
						var next_col_item_check = next_col_item2.eq(item_pos);
					}else{
						var replaced_item = next_item2.eq(item_pos + 1);
						var next_col_item_check = next_col_item2.eq(item_pos + 1);
					}
					current_item.prepend('<span class="dashicons dashicons-arrow-left-alt"></span>');
					replaced_item.replaceWith(current_item);
					bracket_match_name(current_item);
					if( current_item != next_col_item_check.text() && next_col_item_check.text() != "" ){
						next_col_item_check.text("");
					}
				}
			}else{
				if( item_pos == 2 || match_name_string == '' && item_pos == 1 ){
					if( match_name_string != '' ){
						var replaced_item = next_item.eq(item_pos - 1);
						var next_col_item_check = next_item.eq(item_pos - 1);
					}else{
						var replaced_item = next_item.eq(item_pos);
						var next_col_item_check = next_item.eq(item_pos);
					}
					current_item.prepend('<span class="dashicons dashicons-arrow-left-alt"></span>');
					replaced_item.replaceWith(current_item);
					bracket_match_name(current_item);
					if( current_item != next_col_item_check.text() && next_col_item_check.text() != "" ){
						next_col_item_check.text("");
					}
				}else{
					if( match_name_string != '' ){
						var replaced_item = next_item.eq(item_pos + 1);
						var next_col_item_check = next_item.eq(item_pos + 1);
					}else{
						var replaced_item = next_item.eq(item_pos);
						var next_col_item_check = next_item.eq(item_pos);
					}
					current_item.prepend('<span class="dashicons dashicons-arrow-left-alt"></span>');
					replaced_item.replaceWith(current_item);
					bracket_match_name(current_item);
					if( current_item != next_col_item_check.text() && next_col_item_check.text() != "" ){
						next_col_item_check.text("");
					}
				}
			}
		});
	},
	bracket_deadvance: function(){
		return this.each(function(){
			var column_count = jQuery('.bracket-col').length;
			var current_col = jQuery(this).parent().parent().index() - 1;
			var prev_col_pos = jQuery(this).parent().parent().index() - 2;
			var finalist_check = jQuery(this).hasClass('bracket-finalist');
			var finalist_check2 = jQuery(this).hasClass('bracket-finalist-no-name');
			var match_name = jQuery(this).siblings('.match-name');
			var item_name = jQuery(this).text();
			item_name = item_name.replace(/\d/, '');
			var new_match_name = match_name.text().replace(item_name, '');
			if( finalist_check || finalist_check2 ){
				if( match_name_string != '' ){
					jQuery(this).replaceWith("<p class='bracket-finalist'></p>");
				}else{
					jQuery(this).replaceWith("<p class='bracket-finalist-no-name'></p>");
				}
				jQuery('.bracket-col:nth-last-of-type(2) .bracket-item[name="' + item_name + '"] .item-counter').text(0);
			}else{
				match_name.text(new_match_name);
				if(match_name.text() == ' vs '){
					match_name.text("");
				}
				jQuery(this).replaceWith("<p class='bracket-item'></p>");
				jQuery('.bracket-col:eq(' +  prev_col_pos + ') .bracket-item[name="' + item_name + '"] .item-counter').text(0);
			}
			var name = jQuery(this).attr('name');
			for( var x = 0; column_count > x; x++ ){
				jQuery('.bracket-col:eq(' + ( current_col + x ) +') .bracket-item[name="' + name + '"]').replaceWith("<p class='bracket-item'></p>");
			}
		});
	},
	update_bracket: function(){
		return this.each(function(){
			var last_name = jQuery('.bracket-col').filter(':last').children().text();
			var second_last_name = jQuery('.bracket-col:nth-last-of-type(2) .bracket-item[name="' + last_name + '"]').attr('name');
			if( last_name != second_last_name ){
				jQuery('.bracket-col').filter(':last').children().text("");
			}
			if( last_name == second_last_name ){
				jQuery('.bracket-col:nth-last-of-type(2) .bracket-item[name="' + last_name + '"]').siblings('.bracket-item').children('.item-counter').text(0);
			}
		});
	},
	bracket_TBD: function(){
		return this.each(function(){
			var item = jQuery(this).text();
			if( item != 'TBD' ){
				jQuery(this).text('TBD').attr('name', 'TBD');
			}else{
				jQuery(this).text('').attr('name', '');
			}
		});
	}
});
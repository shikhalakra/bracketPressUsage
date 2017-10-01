<div class="entry-footer">
	<?php	if (! post_password_required() && (comments_open() || get_comments_number())) {
	echo '<span class="entry-comments-count">';
	comments_popup_link(
	'<i class="fa fa-comment-o"></i> 0 <span>' . esc_html__('Comments', 'redxunlite') . '</span>',
	'<i class="fa fa-comment-o"></i> 1 <span>' . esc_html__('Comment', 'redxunlite') . '</span>',
	'<i class="fa fa-comment-o"></i> % <span>' . esc_html__('Comments', 'redxunlite') . '</span>'
	);
	echo '</span>';
	}
	?>
	<div class="clearfix">
	</div>
</div>

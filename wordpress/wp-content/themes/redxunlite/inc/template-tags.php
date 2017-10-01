<?php
/**
 * Custom template tags for this theme. Eventually, some of the functionality here could be replaced by core features.
 */

 //----------------------------------------------------
 // Page 1 of what plus prev/next posts in archive and index
 //-----------------------------------------------------
if ( ! function_exists( 'redxunlite_paging_nav' ) ) :
function redxunlite_paging_nav() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	?>
	<h6 class="paginate-head">
	<?php printf( __( 'Page', 'redxunlite' ).' %1$s '.__( 'of', 'redxunlite' ).' %2$s', $paged, $wp_query->max_num_pages ); ?>
  </h6>
	<?php if ( false == get_theme_mod( 'disablefixedsidenav_sectionlogonav', false ) ) { ?>
		<div class="sticky-prev-next">
			<?php if ( get_next_posts_link() ) : ?>
			<div class="older-posts"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older Posts', 'redxunlite' ) ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="newer-posts"><?php previous_posts_link( __( 'Newer Posts <span class="meta-nav">&rarr;</span>', 'redxunlite' ) ); ?></div>
			<?php endif; ?>
		</div><!-- .nav-links -->
	<?php } ?>
	<?php
}
endif;


//-----------------------------------------------------
// Display fixed prev/next navigation for posts
//-----------------------------------------------------
if ( ! function_exists( 'redxunlite_post_nav' ) ) :
function redxunlite_post_nav() {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) {
		return;
	}
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	?>
	<?php if ( false == get_theme_mod( 'disablefixedsidenav_sectionlogonav', false ) ) { ?>
		<div class="sticky-prev-next">
			<?php	previous_post_link( '<div class="older-posts">%link</div>', _x( ' <span class="meta-nav">&larr;</span> Previous', 'Previous post link', 'redxunlite' ) ); ?>
			<?php next_post_link('<div class="newer-posts">%link</div>',     _x( 'Next <span class="meta-nav">&rarr;</span>', 'Next post link',     'redxunlite' ) );	?>
		</div>
		<?php } ?>
	<?php
}
endif;

//-----------------------------------------------------
// Posted on
//-----------------------------------------------------
if ( ! function_exists( 'redxunlite_posted_on' ) ) :
function redxunlite_posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	printf( __( '<span class="posted-on">%1$s</span><span class="byline"> %2$s</span>', 'redxunlite' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;


//-----------------------------------------------------
// Returns true if a blog has more than 1 category.
//-----------------------------------------------------
function redxunlite_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}
	if ( '1' != $all_the_cool_cats ) {
		return true;
	} else {
		return false;
	}
}


//-----------------------------------------------------
// Tags in post
//-----------------------------------------------------
if ( ! function_exists( 'redxunlite_wtn_post_tags' ) ) :
function redxunlite_wtn_post_tags() {
	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ' ', 'redxunlite' );
	if ( 'post' === get_post_type() ) {
		$tags_list = get_the_tag_list( '', $separate_meta );
		if ( $tags_list ) {
			echo '<div class="tags-links">' . $tags_list . '</div>'; // WPCS: XSS OK.
		}
	}
}
endif;



//-----------------------------------------------------
// Category widget style, add span in nr
//-----------------------------------------------------
add_filter('wp_list_categories', 'redxunlite_add_span_cat_count');
function redxunlite_add_span_cat_count($links) {
$links = str_replace('</a> (', '</a> <span>(', $links);
$links = str_replace(')', ')</span>', $links);
return $links;
}


//-----------------------------------------------------
// Get Author Name Linked
//-----------------------------------------------------
function redxunlite_wtn_author_info_name() {
global $post;
$a_user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
$a_display_name = get_the_author_meta( 'display_name', $post->post_author );
if ( empty( $display_name ) )
$a_display_name = get_the_author_meta( 'nickname', $post->post_author );
echo '<a href="'. esc_url( $a_user_posts) .'">' . $a_display_name . '</a>';
}

//-----------------------------------------------------
// Get Author Gravatar
//-----------------------------------------------------
function redxunlite_wtn_author_gravatar() {
global $post;
echo get_avatar( get_the_author_meta('user_email' , $post->post_author) , 54 );
}

//-----------------------------------------------------
// Author Box
//-----------------------------------------------------
function redxunlite_wtn_author_info_box() {
global $post;
$display_name = get_the_author_meta( 'display_name', $post->post_author );
if ( empty( $display_name ) )
$display_name = get_the_author_meta( 'nickname', $post->post_author );
$user_description = get_the_author_meta( 'user_description', $post->post_author );
$user_website = get_the_author_meta('url', $post->post_author);
$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
if ( ! empty( $display_name ) )
$author_details = '<h4 class="author_name"><span>By ' . $display_name . '</span></h4>';
if ( ! empty( $user_description ) )
$author_details .= '<div class="author_details">' . get_avatar( get_the_author_meta('user_email') , 60 ) . nl2br( $user_description ). '</div>';
$author_details .= '<div class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';
if ( ! empty( $user_website ) ) {
$author_details .= ' | <a href="' . $user_website .'" target="_blank">Website</a></div>';
} else {
$author_details .= '</div>';
}
// Pass all this info to post content
$content ='';
$content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
return $content;
}


//-----------------------------------------------------
// Page Excerpts
//-----------------------------------------------------
add_action( 'init', 'redxunlite_wtn_add_excerpts_to_pages' );
function redxunlite_wtn_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


//-----------------------------------------------------
// Flush out the transients used in _categorized_blog.
//-----------------------------------------------------
function redxunlite_category_transient_flusher() {
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'redxunlite_category_transient_flusher' );
add_action( 'save_post',     'redxunlite_category_transient_flusher' );

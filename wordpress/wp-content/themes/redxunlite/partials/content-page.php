<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="actualpage post-content">
		<?php the_content(); ?>
		<div class="clearfix"></div>
		<?php
		wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'redxunlite' ),
				'after'  => '</div>',
		) );
		?>
		<div class="clearfix"></div>
        <div class="clear">&nbsp;</div>
	</div>
</article><!-- #post-## -->

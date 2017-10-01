<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>
<div class="container maininnercontent">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'partials/content', 'page' ); ?>
				<?php
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
			<?php endwhile; ?>
</div>
<?php get_footer(); ?>

<?php

/**
 * The Template for displaying all single posts.
 */
get_header();
global $post ; ?>

<div class="container maininnercontent">

	  <?php if ( get_theme_mod( 'article_layout' ) == 'rightsidebar' ) {  ?>
		 <div class="col-sm-9">
		<?php } else { ?>
		 <div class="narrowcontent">
		<?php } ?>


		<?php while ( have_posts() ) { the_post(); ?>
	   <?php get_template_part( 'partials/content', 'single' ); ?>
		 <?php redxunlite_post_nav(); ?>
		<div class="clearfix"></div>
		<?php
        if ( comments_open() || '0' != get_comments_number() ) {
            comments_template();
        }
        ?>
		<?php } ?>
	</div>

	<?php
    if ( get_theme_mod( 'article_layout' ) == 'rightsidebar' ) { ?>
    	 <div class="col-sm-3">
    		 <?php get_sidebar(); ?>
    	 </div>
	 <?php }  ?>
	</div>

<?php get_footer(); ?>

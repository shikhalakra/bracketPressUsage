<?php
/**
 * The template part for displaying related posts.
 */

defined('ABSPATH') or die('Cheatin\' Uh?'); ?>

<?php	if ( false == get_theme_mod( 'disablefixedbottom_sectionlogonav', false ) ) { ?>

  <?php if ( get_next_posts_link()  ||  get_previous_posts_link() ) { ?>
  <div class="related-posts fixedbottomnav">
    <div class="fixedrp">
      <div class="fbheader text-center">
        <h5 class="widget-title related-posts-title">
            <span><i class="fa fa-navicon"></i></span>
        </h5>
      </div>
      <div class="wrapfixedbottomnav">
        <div class="gonav text-center;">
        <?php if (is_archive()) { ?><h6 class="paginate-head withcat"><?php the_archive_title(); ?></h6><?php } ?> <?php redxunlite_paging_nav();?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

<?php } ?>

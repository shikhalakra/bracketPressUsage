<?php
global $post;

$redxunlite_image_id = get_post_thumbnail_id();
$redxunlite_large_url = wp_get_attachment_image_src($redxunlite_image_id,'full', true);

$redxunlite_imgheaderhome = get_theme_mod( 'bg_sectionhomeintro');
$redxunlite_bgheaderhome = 'style="background-image: url('.esc_url($redxunlite_imgheaderhome).');"';

$redxunlite_imgarchive = get_theme_mod( 'bg_archiveheader');
$redxunlite_bgarchive = 'style="background-image: url('.esc_url($redxunlite_imgarchive).');"';

?>

<header id="masthead" role="banner" class="site-head site-header"
<?php
if ( is_home() && ($redxunlite_imgheaderhome) ) {  echo $redxunlite_bgheaderhome; }
else if ( ( is_archive() || is_search() || is_404() ) && ($redxunlite_imgarchive) ) {  echo $redxunlite_bgarchive; }
else if ( (  is_page() || is_single() ) && ( has_post_thumbnail() ) ) {  ?>  style="background-image: url(<?php echo esc_url($redxunlite_large_url[0]);?>);"
<?php }
else { echo 'style="background-image: url('.esc_url(get_header_image() ).');"'; }
?>>

<div class="coveroverlay"></div>
    <!-- Header Text -->
        <div class="vertical-row">
            <div class="vertical">
                <div class="site-head-content coverheadline">
                  <div class="container">
                  <?php
                  $category_list = get_the_category_list( __( ', ', 'redxunlite' ) );
                  $tag_list = get_the_tag_list( '', __( ', ', 'redxunlite' ) );
                  ?>
                    <?php
                    if ( is_home() ) { ?>
                      <h1 class="blog-title fade-in one"><?php echo get_bloginfo( 'name' ) ; ?></h1>
                      <h2 class="blog-description fade-in two"><?php echo get_bloginfo( 'description' ) ; ?></h2>

                    <?php } elseif ( is_archive() ) { ?>
                      <h1 class="blog-title fade-in three"><?php the_archive_title(); ?></h1>
                      <h2 class="blog-description fade-in four"><div class="separateline"></div>
                        <?php _e( 'Currently', 'redxunlite' ); ?> <?php echo $wp_query->found_posts; ?> <?php _e( 'posts in', 'redxunlite' ); ?> "<?php the_archive_title(); ?>"
                      </h2>

                    <?php } elseif ( is_404() ) { ?>
                    <h1 class="blog-title fade-in three"><?php _e( '404 Page not Found', 'redxunlite' ); ?></h1>
                    <h2 class="blog-description fade-in four"><?php _e( 'Sorry, the page you are looking for does not exist. Please use the search form below.', 'redxunlite'); ?></h2>
                    <br/><div class="fade-in two col-md-8 col-md-offset-2 col-xs-12"><?php get_search_form(); ?></div>

                    <?php } elseif ( is_search() ) { ?>
                    <h1 class="blog-title fade-in three"><?php _e( 'Search Results', 'redxunlite' ); ?></h1>
                    <h2 class="blog-description fade-in four"><?php $allsearch = new WP_Query("s=$s&showposts=0");
                    echo $allsearch ->found_posts.' ';  printf( __( 'search results found for %s', 'redxunlite' ), '<span>"' . get_search_query() . '</span>"' ); ?> </h2>

                    <?php } elseif (is_single()) { ?>
                      <h1 class="blog-title fade-in three"><?php the_title();?></h1>
                          <h2 class="blog-description fade-in four">
                            <div class="separateline"></div>
                            <div class="thecovertextmeta">
                            <?php	echo redxunlite_posted_on(); ?>
                              &#8226; <?php _e( 'By', 'redxunlite' ); ?> <span class="capitalnow"><?php echo redxunlite_wtn_author_info_name(); ?></span> <?php edit_post_link(); ?>
                            <br/>
                              <?php printf( __( ' In ', 'redxunlite' ).'%1$s', $category_list ); ?>
                             &#8226; <a class="sscroll" href="#comments">
                               <?php
                               printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'redxunlite' ), number_format_i18n( get_comments_number() ) );
                               ?>
                             </a>
                            </div>
                          </h2>
                    <?php } elseif (is_page()) { ?>
                      <h1 class="blog-title fade-in three"><?php the_title(); ?></h1>
                      <?php if ( has_excerpt()) { ?>
                          <h2 class="blog-description fade-in four">
                          <div class="separateline"></div>
                           <?php the_excerpt(); ?>  <?php edit_post_link(); ?>
                         </h2>
                      <?php }

                    } else { ?>
                      <h1 class="blog-title fade-in three"><?php the_title(); ?></h1>
                    <?php } ?>

                </div>

              </div>
            </div>
        </div>

  <a href="#scroll-content" class="sscroll article-cover__arrow">
      <span></span>
  </a>
</header><!-- #masthead -->

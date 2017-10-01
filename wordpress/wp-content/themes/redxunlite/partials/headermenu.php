<?php
$redxunlite_logo_id = get_theme_mod( 'custom_logo' );
$redxunlite_logo = wp_get_attachment_image_src( $redxunlite_logo_id , 'full' );
?>
<!-- LOGO & MENU -->
<div id="totop"></div>

    <nav id="redxunlite-navigation" class="main-navigation animated" role="navigation">

      <div class="container">
      <?php if ( has_custom_logo() ) { ?>
          <a class="blog-logo" href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'><img src='<?php echo esc_url( $redxunlite_logo[0] ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
      <?php } else { ?>
          <a class="blog-text" href='<?php echo esc_url( home_url( '/' ) ); ?>' rel='home'><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a>
        <?php } ?>

        <?php  // mobile menu
        if ( has_nav_menu( 'primary' ) ) : ?>
          <ul class="mobile-menu">
              <?php wp_nav_menu( array(
                'container'       => '',
                'container_class' => false,
                'items_wrap' => '%3$s',
                'menu_class' => 'mobile-menu',
                'theme_location' => 'primary',
              ) ); ?>
          </ul>
        <?php endif; ?>

        <?php  // desktop menu
        if ( has_nav_menu( 'primary' ) ) : ?>
    			<ul class="main-menu">
            	<?php wp_nav_menu( array(
                'container'       => '',
                'container_class' => false,
                'items_wrap' => '%3$s',
                'menu_class' => 'main-menu',
            		'theme_location' => 'primary',
            	) ); ?>
    			</ul>
    		<?php endif; ?>


        <div class="toggles">
						<div class="nav-toggle toggle">
              <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
						</div>
						<div class="clearfix"></div>
				</div> <!-- /toggles -->
			 	<div class="clearfix"></div>

      </div>
    </nav>

<?php
/**
 * The template for displaying the footer.
 *
 */
?>

<div class="clearfix"></div>

<footer id="colophon" class="site-footer" role="contentinfo">
	<a class="sscroll totopbtn" href="#totop"><i class="fa fa-angle-up"></i></a>
	<div class="site-info container">

		 <?php if ( has_nav_menu( 'wtnfooter' ) ) { ?>
						<div class="footer-navigation">
							<nav class="footer-right-navigation">
								<ul id="menu-footer-right-items" class="menu-footer-right-items">
									<?php wp_nav_menu( array(
										'container' => '',
										'items_wrap' => '%3$s',
										'theme_location' => 'wtnfooter'
				        ) );?>
				        </ul>
						  </nav>
						</div>
			<?php } ?>

		    <section class="copyright">
		    <?php echo get_theme_mod( 'copyright_sectionfooter'); ?>
				<?php	_e('Copyright &copy;','redxunlite'); echo date_i18n(__("Y","redxunlite")); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo(); ?></a><br/>
				<?php /* translators: 1: theme name, 2: theme developer */
				printf( esc_html__( ' Theme: %1$s by %2$s', 'redxunlite' ), '<a target="_blank" href="https://www.wowthemes.net/themes/redxun/" rel="nofollow" title="Redxun Theme">Redxun Lite</a>', 'WowThemes.Net' );
				?>
		    </section>

		</div><!-- .site-info -->

	</footer><!-- #colophon -->
</main><!-- /#content -->

<?php wp_footer(); ?>
</body>
</html>

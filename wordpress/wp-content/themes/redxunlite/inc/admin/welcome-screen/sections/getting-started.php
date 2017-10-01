<?php
/**
 * Getting started template
 *
 * @package redxunlite
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<style>
	.redxunhello ul {padding-left: 20px; margin-top: 10px; margin-bottom: 10px;}
	.redxunhello ul li {position:relative;}
	.redxunhello ul li:before {content:"\2713"; margin-right:5px;}
	.redxunlite-clear {clear:both;float:none;}
	.youtube-embed { width  : 740px;  height : 400px;}
	.youtube-embed iframe { width  : 100%; height : 100%;}
</style>

<div id="getting_started" class="redxunhello redxunlite-tab-pane active">

<div class="redxunlite-tab-pane-center">
<br/>
		<h1><?php _e( 'Thank you for choosing Redxun Lite!','redxunlite' ); ?></h1>
		<p><?php esc_html_e( 'Please, go to WordPress Customizer to use Redxun options.
		If you need help, tweet @wowthemesnet or e-mail us at wowthemesnet@gmail.com and we will answer as soon as possible.', 'redxunlite' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'redxunlite' ); ?></a></p>
<br/>
<hr>

<div style="width:45%;float:left">
		<h1 style="line-height:1.2;"><?php _e( 'Need Extra Features? Meet Redxun PRO!','redxunlite' ); ?></h1>
		<a target="_blank" style="min-width:200px;text-align:center;margin-bottom:15px;box-shadow:0 19px 38px rgba(0,0,0,.02), 0 15px 12px rgba(0,0,0,.07); text-transform:uppercase;padding: 20px;background-color: blue; text-align:center;color: #fff; border-radius: 50px;margin-top:10px;font-weight:700;font-size:15px;letter-spacing:0.5px;display:inline-block;text-decoration:none;" href="https://www.wowthemes.net/themes/redxun/?utm_source=upsell-dashboard-redxunlite&amp;utm_campaign=ViewFrom%20Redxun%20Lite"><?php _e( 'Visit Redxun PRO','redxunlite' ); ?>
        </a>
    <ul>             
            <li><?php _e( 'Custom Typography','redxunlite' ); ?></li>
            <li><?php _e( 'All Google Fonts Library','redxunlite' ); ?></li>
            <li><?php _e( '3 Custom Layouts set globally/individual posts','redxunlite' ); ?></li>
			<li><?php _e( '5 Header Styles set globally/individual posts','redxunlite' ); ?></li>
			<li><?php _e( 'Custom Top Area, Full Video Header supported','redxunlite' ); ?></li>
			<li><?php _e( 'Built in Advertising Blocks','redxunlite' ); ?><ul>
				<li><?php _e( 'Top and Bottom Index/Archives','redxunlite' ); ?></li>
				<li><?php _e( 'Top and Bottom Articles','redxunlite' ); ?></li>
				<li><?php _e( 'Inside articles, after a certain number of paragraphs at your choice','redxunlite' ); ?></li>
			</ul></li><li><?php _e( 'Hide/display elements accross pages','redxunlite' ); ?></li>
            <li><?php _e( 'Related Posts','redxunlite' ); ?></li>
			<li><?php _e( 'Custom Widgets','redxunlite' ); ?></li>
			<li><?php _e( 'Tracking Code Areas in header, footer','redxunlite' ); ?></li>
			<li><?php _e( 'Mailchimp for WP Integration','redxunlite' ); ?></li>
			<li><?php _e( 'Post Views Integration','redxunlite' ); ?></li>
			<li><?php _e( 'Basic Shortcodes','redxunlite' ); ?></li>
			<li><?php _e( 'WowPopup premium plugin included for your blog marketing purposes','redxunlite' ); ?></li>
			<li><?php _e( 'And much more!','redxunlite' ); ?></li>
		</ul>
  </div>
<div style="width:45%;float:left;margin-top:10px;">
	<img style="max-width:100%;" src="<?php echo get_stylesheet_directory_uri(); ?>/img/redxun-pro.png">
</div>
</div>
<div class="redxunlite-clear"></div>
</div>

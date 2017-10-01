<?php
class tournament_bracket{
	
	private static $initialized = null;
	
	function __construct(){
		add_shortcode( 'bracket', array( $this, 'tournament_bracket_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'tournament_bracket_stylesheet' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'tournament_bracket_script' ) );
	}
	
	public static function tournament_bracket_init(){
		if( is_null( self::$initialized ) ){
			self::$initialized = new tournament_bracket();
		}
		return self::$initialized;
	}
	
	function tournament_bracket_shortcode( $atts ){
		$option = get_option( 'tournament-bracket-save' );
		$save = $option['save'];
		$a = shortcode_atts(
			array(
				'class' => ''
			), $atts );
			
			echo "<div class='bracket-shortcode-wrapper {$a['class']}'>";
			if( $save != '' ){
				do_action( 'tournament_bracket_shortcode_layout' );
			}
			echo "</div>";
			
		return;
	}
	
	function tournament_bracket_stylesheet(){
		wp_enqueue_style( 'tournamentbracket-layout.css', plugin_dir_url( __FILE__ ) . 'css/tournamentbracket-layout.css' );
	}
	
	function tournament_bracket_script(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'tournamentbracket.js', plugin_dir_url( __FILE__ ) . 'js/tournamentbracket.js' );
	}
	
	public static function tournament_bracket_activation(){
		if( !current_user_can( 'activate_plugins' ) ) return;
		if ( version_compare( $GLOBALS['wp_version'], TOURNAMENT_BRACKET_MIN_WP_VERSION, '<' ) ) {
			$error_message = sprintf( __( 'Could not activate Tournament Bracket Generator version %s because it requires wordpress version %s or greater.', 'tournament-bracket-gen' ), TOURNAMENT_BRACKET_PLUGIN_VERSION, TOURNAMENT_BRACKET_MIN_WP_VERSION );
			wp_die( $error_message );
		}
	}
	
	public static function tournament_bracket_deactivation(){
		if( !current_user_can( 'activate_plugins' ) ) return;
	}
	
}
tournament_bracket::tournament_bracket_init();
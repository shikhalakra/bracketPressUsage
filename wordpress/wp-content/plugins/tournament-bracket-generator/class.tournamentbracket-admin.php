<?php
class tournament_bracket_admin{
	
	private static $initialized = null;
	
	function __construct(){
		add_action( 'admin_menu', array( $this, 'tournament_bracket_settings_page' ) );
		add_action( 'admin_init', array( $this, 'tournament_bracket_settings_init' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'tournament_bracket_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'tournament_bracket_stylesheet' ) );
	}
	
	public static function tournament_bracket_init(){
		if( is_null( self::$initialized ) ){
			self::$initialized = new tournament_bracket_admin();
		}
	}
	
	function tournament_bracket_settings_page(){
		add_theme_page(
			__( 'Tournament Bracket Generator', 'tournament-bracket-gen' ),
			__( 'Tournament Bracket Generator', 'tournament-bracket-gen' ),
			'manage_options',
			'tournament-bracket-settings',
			array( $this, 'tournament_bracket_settings_page_html' )
		);
	}
	
	function tournament_bracket_settings_init(){
		add_settings_section(
			'tournament-bracket-options-section', 
			__( 'Tournament Bracket Options', 'tournament-bracket-gen' ), 
			array( $this, 'tournament_bracket_options_section' ), 
			'tournament-bracket-options'
		);
		add_settings_field(
			'tournament-bracket-setting-name', 
			__( 'Bracket Name', 'tournament-bracket-gen' ), 
			array( $this, 'tournament_bracket_name' ), 
			'tournament-bracket-options', 
			'tournament-bracket-options-section' 
		);
		add_settings_field(
			'tournament-bracket-setting-items',
			__( 'Bracket Items<br><br>(Seperate Items with commas)', 'tournament-bracket-gen' ),
			array( $this, 'tournament_bracket_items' ),
			'tournament-bracket-options',
			'tournament-bracket-options-section'
		);
		add_settings_field(
			'tournament-bracket-setting-advance-counter',
			__( 'Include Advance Counter', 'tournament-bracket-gen' ),
			array( $this, 'tournament_bracket_advance_counter' ),
			'tournament-bracket-options',
			'tournament-bracket-options-section'
		);
		add_settings_field(
			'tournament-bracket-setting-match-name',
			__( 'Include Match Names', 'tournament-bracket-gen' ),
			array( $this, 'tournament_bracket_match_name' ),
			'tournament-bracket-options',
			'tournament-bracket-options-section'
		);
		add_settings_section(
			'tournament-bracket-save-section', 
			'', 
			array( $this, 'tournament_bracket_save_section' ), 
			'tournament-bracket-save'
		);
		add_settings_field(
			'tournament-bracket-setting-name', 
			'', 
			array( $this, 'tournament_bracket_save' ), 
			'tournament-bracket-save', 
			'tournament-bracket-save-section' 
		);
		if( get_option( 'tournament-bracket-options' ) == false ){
			$options = array(
				'name' => '',
				'items' => '',
				'advance_counter' => 'none',
				'match_name' => '',
			);
			update_option( 'tournament-bracket-options', $options );
		}
		if( get_option( 'tournament-bracket-save' ) == false ){
			$option = array(
				'save' => ''
			);
			update_option( 'tournament-bracket-save', $option );
		}
		register_setting( 'tournament-bracket-options', 'tournament-bracket-options', array( $this, 'tournament_bracket_sanitize_settings' ) );
		register_setting( 'tournament-bracket-save', 'tournament-bracket-save', array( $this, 'tournament_bracket_sanitize_save' ) );
	}
	
	function tournament_bracket_settings_page_html( $active_tab = '' ){
		?>
		<div class='wrap'>
			<?php
			if( isset( $_GET[ 'tab' ] ) ){
				$active_tab = $_GET[ 'tab' ];
			}else if( $active_tab == 'tournament_bracket_preview' ){
				$active_tab = 'tournament_bracket_preview';
			}else{
				$active_tab = 'tournament_bracket_settings';
			}
			?>
			<h2 class='nav-tab-wrapper'>
				<a href='?page=tournament-bracket-settings&tab=tournament_bracket_settings' class='nav-tab <?php echo $active_tab == 'tournament_bracket_settings' ? 'nav-tab-active' : ''; ?>'><?php esc_html_e( 'Bracket Settings', 'tournament-bracket-gen' ); ?></a>
				<a href='?page=tournament-bracket-settings&tab=tournament_bracket_preview' class='nav-tab <?php echo $active_tab == 'tournament_bracket_preview' ? 'nav-tab-active' : ''; ?>'><?php esc_html_e( 'Bracket Preview', 'tournament-bracket-gen' ); ?></a>
			</h2>
			<form method='post' action='options.php'>
				<?php
					if( $active_tab == 'tournament_bracket_settings' ){
						settings_fields( 'tournament-bracket-options' );
						do_settings_sections( 'tournament-bracket-options' );
						?>
							<h2><?php esc_html_e( 'Shortcode Example', 'tournament-bracket-gen' ); ?></h2>
							<p><?php esc_html_e( 'Shortcode:', 'tournament-bracket-gen' ); ?> [bracket class=""]</p>
							<ul>
								<li><?php esc_html_e( 'Class: (optional) Defines a css class for the brackets wrapper element', 'tournament-bracket-gen' ); ?></li>
							</ul>
						<?php
					}else if( $active_tab == 'tournament_bracket_preview' ){
						settings_fields( 'tournament-bracket-save' );
						do_settings_sections( 'tournament-bracket-save' );
						submit_button( 'Save', array( 'class' => 'save-bracket' ) );
						submit_button( 'Clear', array( 'class' => 'reset-bracket' ) );
						echo "</form>";
						do_action( 'tournament_bracket_prepare_items' );
					}
					if( $active_tab != 'tournament_bracket_preview' ){
						submit_button();
					}
				?>
			</form>
		</div>
		<?php
	}
	
	function tournament_bracket_options_section(){
		
	}
	
	function tournament_bracket_save_section(){
		
	}
	
	function tournament_bracket_sanitize_settings( $input ){
		$input['name'] = sanitize_text_field( $input['name'] );
		$input['items'] = sanitize_text_field( $input['items'] );
		$input['match_name'] = ( $input['match_name'] == 'on' ) ? 'on' : '';
		switch( $input['advance_counter'] ){
			case $input['advance_counter'] == 'none':
				$input['advance_counter'] = 'none';
				break;
			case $input['advance_counter'] == 'Best of one':
				$input['advance_counter'] = 'Best of one';
				break;
			case $input['advance_counter'] == 'Best of three':
				$input['advance_counter'] = 'Best of three';
				break;
			case $input['advance_counter'] == 'Best of five':
				$input['advance_counter'] = 'Best of five';
				break;
			default:
				$input['advance_counter'] = 'none';
		}
		return $input;
	}
	
	function tournament_bracket_sanitize_save( $input ){
		$input['save'] = sanitize_text_field( $input['save'] );
		return $input;
	}
	
	function tournament_bracket_name(){
		$option = get_option( 'tournament-bracket-options' );
		echo "<input type='text' name='tournament-bracket-options[name]' value='" . esc_attr( $option['name'] ) . "'>";
	}
	
	function tournament_bracket_items(){
		$option = get_option( 'tournament-bracket-options' );
		echo "<textarea name='tournament-bracket-options[items]'>" . esc_attr( $option['items'] ) . "</textarea>";
	}
	
	function tournament_bracket_advance_counter(){
		$option = get_option( 'tournament-bracket-options' );
		?>
		<select name='tournament-bracket-options[advance_counter]'>
			<option value='none'<?php if( $option['advance_counter'] === 'none' ) echo "selected='selected'"; ?>><?php esc_html_e( 'none', 'tournament-bracket-gen' ); ?></option>
			<option value='Best of one'<?php if( $option['advance_counter'] === 'Best of one' ) echo "selected='selected'"; ?>><?php esc_html_e( 'Best of one', 'tournament-bracket-gen' ); ?></option>
			<option value='Best of three'<?php if( $option['advance_counter'] === 'Best of three' ) echo "selected='selected'"; ?>><?php esc_html_e( 'Best of three', 'tournament-bracket-gen' ); ?></option>
			<option value='Best of five'<?php if( $option['advance_counter'] === 'Best of five' ) echo "selected='selected'"; ?>><?php esc_html_e( 'Best of five', 'tournament-bracket-gen' ); ?></option>
		</select>
		<?php
	}
	
	function tournament_bracket_match_name(){
		$option = get_option( 'tournament-bracket-options' );
		echo '<input '. checked( $option['match_name'], 'on', false ).' name="tournament-bracket-options[match_name]" type="checkbox" />';
	}
	
	function tournament_bracket_save(){
		$option = get_option( 'tournament-bracket-save' );
		echo "<input type='hidden' name='tournament-bracket-save[save]' value='" . esc_attr( $option['save'] ) . "'>";
	}
	
	function tournament_bracket_scripts( $hook ){
		if( $hook != 'appearance_page_tournament-bracket-settings' ) return;
		wp_enqueue_script( 'tournamentbracket-admin.js', plugin_dir_url( __FILE__ ) . 'js/tournamentbracket-admin.js' );
	}
	
	function tournament_bracket_stylesheet( $hook ){
		if( $hook != 'appearance_page_tournament-bracket-settings' ) return;
		wp_enqueue_style( 'tournamentbracket-layout.css', plugin_dir_url( __FILE__ ) . 'css/tournamentbracket-layout.css' );
		wp_enqueue_style( 'tournamentbracket-admin.css', plugin_dir_url( __FILE__ ) . 'css/tournamentbracket-admin.css' );
	}
	
}
tournament_bracket_admin::tournament_bracket_init();
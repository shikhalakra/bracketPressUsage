<?php
class tournament_bracket_layout{
	
	private static $initialized = null;
	private static $saved_items = [];
	private static $saved_counter = [];
	
	function __construct(){
		add_action( 'tournament_bracket_shortcode_layout', array( $this, 'tournament_shortcode_layout' ) );
		add_action( 'tournament_bracket_prepare_items', array( $this, 'tournament_bracket_items' ) );
		add_action( 'tournament_bracket_saved_items', array( $this, 'tournament_bracket_prepare_saved_items' ), 10, 2 );
		add_action( 'tournament_bracket_admin_layout', array( $this, 'tournament_bracket_layout_admin' ), 10, 3 );
		add_action( 'tournament_bracket_saved', array( $this, 'tournament_bracket_saved_layout' ), 10, 3 );
	}
	
	public static function tournament_bracket_init(){
		if( is_null( self::$initialized ) ){
			self::$initialized = new tournament_bracket_layout();
		}
		return self::$initialized;
	}
	
	function tournament_bracket_items(){
		$options = get_option( 'tournament-bracket-options' );
		$items = $options['items'];
		$new_items = explode( ",", $items );
		$num_items = count( $new_items );
		for( $x = 0; $num_items > $x; $x++ ){
			$new_items[$x] = trim( preg_replace('/\s+/S', " ", $new_items[$x] ) );
		}
		switch( true ){
			case $num_items == 4:
				do_action( 'tournament_bracket_admin_layout', $num_items, $new_items, 2 );
				break;
			case $num_items == 8:
				do_action( 'tournament_bracket_admin_layout', $num_items, $new_items, 3 );
				break;
			case $num_items == 16:
				do_action( 'tournament_bracket_admin_layout', $num_items, $new_items, 4 );
				break;
			case $num_items == 32:
				do_action( 'tournament_bracket_admin_layout', $num_items, $new_items, 5 );
				break;
			case $num_items == 64:
				do_action( 'tournament_bracket_admin_layout', $num_items, $new_items, 6 );
				break;
			default:
				_e( "Could not generate bracket. Expected number of items are 4, 8, 16, 32, 64. $num_items items given", 'tournament-bracket-gen' );
		}
	}
	
	function tournament_bracket_prepare_saved_items( $num_items, $num_col ){
		$counter_option = get_option( 'tournament-bracket-options' );
		$option = get_option( 'tournament-bracket-save' );
		$counter = $counter_option['advance_counter'];
		$save = $option['save'];
		$save_array = explode( ',', $save );
		$save_array_count = count( $save_array );
		$first_items = $num_items;
		for( $x = 0; $num_col >= $x; $x++ ){
			self::$saved_items[$x] = [];
			self::$saved_counter[$x] = [];
			if( $x == 0 ){
				for( $a = 0; $num_items > $a; $a++ ){
					if( $counter != 'none' ){
						$count_num = substr( $save_array[$a], -1 );
						$new_item = substr( $save_array[$a], 0, -1 );
						array_push( self::$saved_counter[$x], $count_num );
						array_push( self::$saved_items[$x], $new_item );
					}else{
						array_push( self::$saved_items[$x], $save_array[$a] );
					}
				}
			}else if( $num_col != $x ){
				$next_group = $num_items / 2;
				for( $a = 0; $next_group > $a; $a++ ){
					if( $counter != 'none' ){
						$count_num = substr( $save_array[$first_items + $a], -1 );
						$new_item = substr( $save_array[$first_items + $a], 0, -1 );
						array_push( self::$saved_counter[$x], $count_num );
						array_push( self::$saved_items[$x], $new_item );
					}else{
						array_push( self::$saved_items[$x], $save_array[$first_items + $a] );
					}
					if( ( $next_group - 1 ) == $a ) $first_items += ( $a + 1 );
				}
				$num_items /= 2;
			}else{
				array_push( self::$saved_items[$x], $save_array[$save_array_count - 1] );
			}
		}
	}
	
	function tournament_shortcode_layout(){
		$options = get_option( 'tournament-bracket-options' );
		$items = $options['items'];
		$new_items = explode( ",", $items );
		$num_items = count( $new_items );
		switch( true ){
			case $num_items <= 4:
				do_action( 'tournament_bracket_saved', $num_items, 2, false );
				break;
			case $num_items <= 8:
				do_action( 'tournament_bracket_saved', $num_items, 3, false );
				break;
			case $num_items <= 16:
				do_action( 'tournament_bracket_saved', $num_items, 4, false );
				break;
			case $num_items <= 32:
				do_action( 'tournament_bracket_saved', $num_items, 5, false );
				break;
			case $num_items <= 64:
				do_action( 'tournament_bracket_saved', $num_items, 6, false );
				break;
			default:
				_e( "Could not generate bracket. Expected number of items are 4, 8, 16, 32, 64. $num_items items given", 'tournament-bracket-gen' );
		}
	}
	
	function tournament_bracket_saved_layout( $num_items, $num_col, $from_admin ){
		do_action( 'tournament_bracket_saved_items', $num_items, $num_col );
		$option = get_option( 'tournament-bracket-options' );
		$counter = $option['advance_counter'];
		$bracket_name = $option['name'];
		$match_name = $option['match_name'];
		$group_num = $num_items / 2;
		$b = 0;
		echo "<div class='bracket-wrap'>";
		echo "<h2><button class='move-hidden' id='prev-round'>" . esc_html__( 'Prev Round', 'tournament-bracket-gen' ) . "</button>" . ( ( $bracket_name != '' ) ? $bracket_name : '' ) . "<button class='move-hidden' id='next-round'>" . esc_html__( 'Next Round', 'tournament-bracket-gen' ) . "</button></h2>";
		for( $x = 0; $num_col > $x; $x++ ){
			echo "<div class='bracket-col'>";
			for( $a = 0; $group_num > $a; $a++ ){
				echo "<div class='bracket-group" . ( ( $match_name != '' ) ? '-match-name' : '' ) . "'>";
				while( $num_items > $b ){
					if( $match_name != '' ){
						echo "<p class='match-name'>" . self::$saved_items[$x][$b] . " vs " . self::$saved_items[$x][$b + 1] . "</p>";
					}
					echo "<p class='bracket-item' name='" . self::$saved_items[$x][$b] . "'>" . self::$saved_items[$x][$b] . ( ( $counter != 'none' ) ? "<span class='item-counter'>" . self::$saved_counter[$x][$b] . "</span>" : "" ) . ( ( $from_admin && $x > 0 ) ? "<span class='dashicons dashicons-arrow-left-alt'></span>" : "" ) . ( ( $from_admin ) ? "<span class='dashicons dashicons-arrow-right-alt'></span></p>" : "</p>" );
					echo "<div class='item-connector'></div>";
					$b++;
					echo "<p class='bracket-item' name='" . self::$saved_items[$x][$b] . "'>" . self::$saved_items[$x][$b] . ( ( $counter != 'none' ) ? "<span class='item-counter'>" . self::$saved_counter[$x][$b] . "</span>" : "" ) . ( ( $from_admin && $x > 0 ) ? "<span class='dashicons dashicons-arrow-left-alt'></span>" : "" ) . ( ( $from_admin ) ? "<span class='dashicons dashicons-arrow-right-alt'></span></p>" : "</p>" );
					echo "</div>";
					$b++;
					continue 2;
				}
			}
			echo "</div>";
			$group_num /= 2;
			$num_items /= 2;
			$b = 0;
			if( ( $num_col - 1 ) == $x ){
				?>
				<div class='bracket-col'>
					<p class='bracket-finalist<?php if( $match_name == '' ) echo '-no-name'; ?>'><?php echo self::$saved_items[$num_col][0] . ( ( $from_admin ) ? "<span class='dashicons dashicons-arrow-left-alt'></span>" : "" ); ?></p>
				</div>
				<?php
			}
		}
		echo "</div>";
	}
	
	function tournament_bracket_layout_admin( $num_items, $items, $num_col ){
		$option = get_option( 'tournament-bracket-options' );
		$save = get_option( 'tournament-bracket-save' );
		$match_name = $option['match_name'];
		$counter = $option['advance_counter'];
		$bracket_name = $option['name'];
		$bracket_save = $save['save'];
		$group_num = $num_items / 2;
		$b = 0;
		echo "<script>bracket_item_counter('$counter');bracket_match_name_string('$match_name')</script>";
		if( $bracket_save != '' ){
			do_action( 'tournament_bracket_saved', $num_items, $num_col, true );
		}else{
			echo "<div class='bracket-wrap'>";
			echo "<h2><button class='move-hidden' id='prev-round'>" . esc_html__( 'Prev Round', 'tournament-bracket-gen' ) . "</button>" . ( ( $bracket_name != '' ) ? $bracket_name : '' ) . "<button class='move-hidden' id='next-round'>" . esc_html__( 'Next Round', 'tournament-bracket-gen' ) . "</button></h2>";
			for( $x = 1; $num_col >= $x; $x++ ){
				if( $x > 1 ){
					$group_num /= 2;
					echo "<div class='bracket-col'>";
					for( $a = 0; $group_num > $a; $a++ ){
						?>
						<div class='bracket-group<?php if( $match_name != '' ) echo '-match-name'; ?>'>
						<?php if( $match_name != '' ): ?>
							<p class='match-name'></p>
						<?php endif; ?>
							<p class='bracket-item'></p>
							<div class='item-connector'></div>
							<p class='bracket-item'></p>
						</div>
						<?php
					}
					echo "</div>";
					if( $num_col == $x ){
						?>
						<div class='bracket-col'>
							<p class='bracket-finalist<?php if( $match_name == '' ) echo '-no-name'; ?>'></p>
						</div>
						<?php
					}
				}else{
					echo "<div class='bracket-col'>";
					for( $a = 1; $group_num >= $a; $a++ ){
						echo "<div class='bracket-group" . ( ( $match_name != '' ) ? '-match-name' : '' ) . "'>";
						while( $num_items > $b ){
							if( $match_name != '' ){
								echo "<p class='match-name'>$items[$b] vs {$items[$b + 1]}</p>";
							}
							echo "<p class='bracket-item' name=$items[$b]>$items[$b]" . ( ( $counter != 'none' ) ? "<span class='item-counter'>0</span>" : '' ) . "<span class='dashicons dashicons-arrow-right-alt'></span></p>";
							echo "<div class='item-connector'></div>";
							$b++;
							echo "<p class='bracket-item' name=$items[$b]>$items[$b]" . ( ( $counter != 'none' ) ? "<span class='item-counter'>0</span>" : '' ) . "<span class='dashicons dashicons-arrow-right-alt'></span></p>";
							echo "</div>";
							$b++;
							continue 2;
						}
					}
					echo "</div>";
				}
			}
			echo "</div>";
		}
	}
}
tournament_bracket_layout::tournament_bracket_init();
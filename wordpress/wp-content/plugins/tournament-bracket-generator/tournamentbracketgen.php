<?php
/*
Plugin Name: Tournament Bracket Generator
Plugin URI: https://wordpress.org/plugins/tournament-bracket-generator/
Description: Create a stunning bracket for any sport, event, or tournament.
Version: 1.0.0
Author: Blake
Text Domain: tournament-bracket-gen
Author URI: http://www.digital-scripts.com/
License: GPLv2 or later
*/

/*
Copyright 2016 Blake (email: staff@digital-scripts.com)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

define( 'TOURNAMENT_BRACKET_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'TOURNAMENT_BRACKET_PLUGIN_VERSION', '1.0.0' );
define( 'TOURNAMENT_BRACKET_MIN_WP_VERSION', '4.6.1' );

register_activation_hook( __FILE__, array( 'tournament_bracket', 'tournament_bracket_activation' ) );
register_deactivation_hook( __FILE__, array( 'tournament_bracket', 'tournament_bracket_deactivation' ) );

add_action( 'init', array( 'tournament_bracket', 'tournament_bracket_init' ) );

include_once( TOURNAMENT_BRACKET_PLUGIN_DIR . 'class.tournamentbracket.php' );
include_once( TOURNAMENT_BRACKET_PLUGIN_DIR . 'class.tournamentbracket-layout.php' );

if( is_admin() ){
	include_once( TOURNAMENT_BRACKET_PLUGIN_DIR . 'class.tournamentbracket-admin.php' );
}
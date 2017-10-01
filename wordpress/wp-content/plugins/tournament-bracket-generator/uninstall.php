<?php
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
    die;
}

delete_option( 'tournament-bracket-options' );
delete_option( 'tournament-bracket-save' );
<?php
/**
 * @package Scholaris
 */
/*
Plugin Name: Scholaris
Plugin URI: http://scholaris.pl/plugins
Description: Scholaris plugin
Version: 0.5
Author: Scholaris
Author URI: 
License: GPLv2 or later
*/

/*
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

define('SCHOLARIS_CREATOR', 'http://creator.staging.scht.pl');
define('SCHOLARIS_PORTAL', 'http://portal.staging.scht.pl');

require_once 'scholaris_page.php';

// dodanie opcji w menu
add_action('admin_menu', 'scholaris_create_menu');

// zarejestrowanie shortcode
add_shortcode( 'scholaris', 'scholaris_shortcode_handler' );


function scholaris_create_menu() {
	//utworzenie wpisu w menu
	add_menu_page('Scholaris', 'Scholaris', 'administrator', __FILE__, 'scholaris_page', plugins_url('/images/icon.png', __FILE__));

	//zarejestrowanie opcji
	add_action( 'admin_init', 'register_scholaris_settings' );
}

function register_scholaris_settings() {
	//dodanie opcji
	register_setting( 'scholaris-settings-group', 'user_email' );
	register_setting( 'scholaris-settings-group', 'user_token' );		
}

<?php
/*
Plugin Name: Restaurant Menu 
Plugin URI:  https://developer.wordpress.org/restaurant-menu/the-basics/
Description: Restaurant Menu for a Restaurant business..
Version:     0.1
Author:      WPManageNinja
Author URI:  https://wpmanageninja.com
Text Domain: restaurant_menu
Domain Path: /languages
License:     GPL2
 
Restaurant Menu is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Restaurant Menu is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Restaurant Menu. If not, see {License URI}.
*/

defined( 'ABSPATH' ) or die();

define( 'RESTAURANT_MENU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'RESTAURANT_MENU_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

include 'load.php';

class RestaurantMenu {

	public function boot() {
		$this->publicHooks();
		$this->commonHooks();
		if ( is_admin() ) {
			$this->adminHooks();
		}
	}

	public function publicHooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
	}

	/**
	 * The hook where we will register all the common actions and filters
	 */
	public function commonHooks() {
		// register Post type
		$postTypeClass = new \RestaurantMenu\Classes\PostTypeClass();
		add_action( 'init', array( $postTypeClass, 'initRestaurantPostType' ) );

		$shortCodeClass = new \RestaurantMenu\Classes\ShortCodeClass();
		add_shortcode( 'restaurant_menu', array( $shortCodeClass, 'register' ) );

		$menuContentClass = new \RestaurantMenu\Classes\MenuContentClass();
		add_action( 'wp_ajax_restaurant_menu_public_ajax_actions', array( $menuContentClass, 'handleAjax' ) );
		add_action( 'wp_ajax_nopriv_restaurant_menu_public_ajax_actions', array( $menuContentClass, 'handleAjax' ) );

		add_action( 'wp_ajax_res_menu_modal', array( $this, 'modalGenerate' ) );
		add_action( 'wp_ajax_nopriv_res_menu_modal', array( $this, 'modalGenerate' ) );

	}


	public function adminHooks() {
		add_action( 'add_meta_boxes_restaurant_menu', array( '\RestaurantMenu\Classes\MetaBoxClass', 'addMetaBoxes' ) );
		add_action( 'save_post_restaurant_menu', array( '\RestaurantMenu\Classes\MetaBoxClass', 'saveMeta' ) );
		add_action( 'widgets_init', array( $this, 'rlResMenuWidget' ) );
	}

	public function rlResMenuWidget() {
		$ResMenuWidgetClass = new \RestaurantMenu\Classes\ResMenuWidgetClass();
		register_widget( $ResMenuWidgetClass );
	}

	public function enqueueScripts() {
		wp_enqueue_style( 'ninja_restaurant_styles', RESTAURANT_MENU_PLUGIN_URL . 'assets/styles.css' );
		
		wp_enqueue_script( 'ninja_restaurant_js', RESTAURANT_MENU_PLUGIN_URL . 'assets/app.js',
			array( 'jquery' ) );

		wp_localize_script( 'ninja_restaurant_js', 'res_menu',
			array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}

	public function modalGenerate() {
		$PostID   = $_POST['id'];
		$resMenus = new WP_Query( array(
			'post_type' => 'rl_res_menu',
			'p'         => $PostID,
		) );

		ob_start();
		while ( $resMenus->have_posts() ) : $resMenus->the_post();
			require( dirname( __FILE__ ) . '/include/modal.php' );
		endwhile;
		echo ob_get_clean();
		die();
	}


}

add_action( 'plugins_loaded', function () {
	$RestaurantMenus = new RestaurantMenu();
	$RestaurantMenus->boot();
} );

		



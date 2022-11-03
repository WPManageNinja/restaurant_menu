<?php
/**
 * @link              https://wpmanageninja.com
 * @since             1.0.1
 * @package           tr_menu
 *
 * @wordpress-plugin
 * Plugin Name:       Trendy Restaurant Menu
 * Plugin URI:        https://wpmanageninja.com/products
 * Description:       The Best Restaurant Menu Plugin in WordPress. This plugin aims to show the restaurant menu in a nice and trendy way.
 * Version:           1.0.1
 * Author:            WPManageNinja
 * Author URI:        https://wpmanageninja.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tr_menu
 * Domain Path:       /languages
 */
defined( 'ABSPATH' ) or die();

define( 'TRENDY_RESTAURANT_MENU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TRENDY_RESTAURANT_MENU_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'TRENDY_RESTAURANT_MENU_PLUGIN_VERSION', '1.0.1' );
include 'load.php';

register_activation_hook( __FILE__, function () {
	if ( ! get_option( '_tr_menu_currency_sign', true ) ) {
		update_option( '_tr_menu_currency_sign', '$' );
	}
});

class TrendyRestaurantMenuMainClass {
	
	public function boot() {
		$this->loadTextDomain();
		$this->commonHooks();
		if ( is_admin() ) {
			$this->adminHooks();
		}
	}
	
	/**
	 * The hook where we will register all the common actions and filters
	 */
	public function commonHooks() {
		// register Post type
		add_action( 'init', array( '\TrendyRestaurantMenu\Classes\PostTypeClass', 'initRestaurantPostType' ) );
		$shortCodeClass = new \TrendyRestaurantMenu\Classes\ShortCodeClass();
		add_shortcode( 'tr_menu', array( $shortCodeClass, 'register' ) );
		$menuContentClass = new \TrendyRestaurantMenu\Classes\MenuContentClass();
		add_action( 'init', function () use ( $menuContentClass ) {
			if ( isset( $_GET['tr_get_item'] ) && $_GET['tr_get_item'] ) {
				$menuContentClass->getItemModal();
				die();
			}
		} );

		add_filter( 'the_content', array( $menuContentClass, 'filterSingleMenuContent' ) );

		add_action( 'widgets_init', function () {
			register_widget( 'TrendyRestaurantMenu\Classes\WidgetClass' );
		} );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueScripts' ) );
	}

	public function adminHooks() {
		$postTypeName = \TrendyRestaurantMenu\Classes\PostTypeClass::$postTypeName;
		add_action( 'add_meta_boxes_' . $postTypeName,
			array( '\TrendyRestaurantMenu\Classes\MetaBoxClass', 'addMetaBoxes' ) );
		add_action( 'save_post_' . $postTypeName, array( '\TrendyRestaurantMenu\Classes\MetaBoxClass', 'saveMeta' ) );
		add_action( 'current_screen', function ( $current_screen ) use ( $postTypeName ) {
			if ( $current_screen->post_type != $postTypeName ) {
				\TrendyRestaurantMenu\Classes\TinyMceClass::registerButton();
			}
		} );
		
		add_action( 'save_post', array( 'TrendyRestaurantMenu\Classes\ShortCodeClass', 'saveFlagOnShortCode' ) );
		add_action( 'admin_menu', array( 'TrendyRestaurantMenu\Classes\SettingsClass', 'addSettingsMenu' ) );
		add_action( 'wp_ajax_tr_menu_save_settings', array( 'TrendyRestaurantMenu\Classes\SettingsClass', 'saveSettings' ) );
	}

	public function enqueueScripts() {
		global $post;
		wp_register_style( 'tr_menu_styles', TRENDY_RESTAURANT_MENU_PLUGIN_URL . 'assets/styles.css', array(),
			TRENDY_RESTAURANT_MENU_PLUGIN_VERSION );

		if ( is_singular() && is_a( $post, 'WP_Post' ) && get_post_meta( $post->ID, '_has_tr_menu_shortcode', true ) ) {
			wp_enqueue_style( 'tr_menu_styles' );
		} else if ( is_singular( array( \TrendyRestaurantMenu\Classes\PostTypeClass::$postTypeName ) ) ) {
			wp_enqueue_style( 'tr_menu_styles' );
		}

		wp_register_script( 'tr_menu_js', TRENDY_RESTAURANT_MENU_PLUGIN_URL . 'assets/app.js',
			array( 'jquery' ), TRENDY_RESTAURANT_MENU_PLUGIN_VERSION );
		wp_localize_script( 'tr_menu_js', 'tr_menu_vars',
			array(
				'get_item_url' => site_url( '?tr_get_item=1' )
			)
		);
	}
	
	public function loadTextDomain() {
		load_plugin_textdomain( 'tr_menu', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
}

add_action( 'plugins_loaded', function () {
	$RestaurantMenus = new TrendyRestaurantMenuMainClass();
	$RestaurantMenus->boot();
} );
<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dream-encode.com
 * @since             1.0.0
 * @package           Max_Marine_Edit_Product_Shared_State
 *
 * @wordpress-plugin
 * Plugin Name:       Max Marine - Edit Product Shared State
 * Plugin URI:        https://example.com
 * Description:       A small, focused plugin that adds a shared wp.data store used on the edit product page of WooCommerce.
 * Version:           1.0.0
 * Author:            David Baumwald
 * Author URI:        https://dream-encode.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       max-marine-edit-product-shared-state
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/dream-encode/max-marine-edit-product-shared-state
 * Primary Branch:    main
 * Release Asset:     true
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Constants
 */
require_once 'includes/max-marine-edit-product-shared-state-constants.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-max-marine-edit-product-shared-state-activator.php
 *
 * @return void
 */
function max_marine_edit_product_shared_state_activate() {
	require_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'includes/class-max-marine-edit-product-shared-state-activator.php';
	Max_Marine\Edit_Product_Shared_State\Core\Max_Marine_Edit_Product_Shared_State_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-max-marine-edit-product-shared-state-deactivator.php
 *
 * @return void
 */
function max_marine_edit_product_shared_state_deactivate() {
	require_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'includes/class-max-marine-edit-product-shared-state-deactivator.php';
	Max_Marine\Edit_Product_Shared_State\Core\Max_Marine_Edit_Product_Shared_State_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'max_marine_edit_product_shared_state_activate' );
register_deactivation_hook( __FILE__, 'max_marine_edit_product_shared_state_deactivate' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since  1.0.0
 * @return void
 */
function max_marine_edit_product_shared_state_init() {
	/**
	 * Import some common functions.
	 */
	require_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'includes/max-marine-edit-product-shared-state-core-functions.php';

	/**
	 * Main plugin loader class.
	 */
	require_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'includes/class-max-marine-edit-product-shared-state.php';

	$plugin = new Max_Marine\Edit_Product_Shared_State\Core\Max_Marine_Edit_Product_Shared_State();
	$plugin->run();
}

max_marine_edit_product_shared_state_init();

<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://dream-encode.com
 * @since      1.0.0
 *
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/includes
 */

namespace Max_Marine\Edit_Product_Shared_State\Core;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/includes
 * @author     David Baumwald <david@dream-encode.com>
 */
class Max_Marine_Edit_Product_Shared_State_I18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'max-marine-edit-product-shared-state',
			false,
			MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'languages/'
		);
	}
}

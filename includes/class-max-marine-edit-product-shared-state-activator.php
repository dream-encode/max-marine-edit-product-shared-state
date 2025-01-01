<?php
/**
 * Fired during plugin activation.
 *
 * @link       https://dream-encode.com
 * @since      1.0.0
 *
 * @package    Max_Marine\Edit_Product_Shared_State
 * @subpackage Max_Marine\Edit_Product_Shared_State/includes
 */

namespace Max_Marine\Edit_Product_Shared_State\Core;

use Max_Marine\Edit_Product_Shared_State\Core\Upgrade\Max_Marine_Edit_Product_Shared_State_Upgrader;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Max_Marine\Edit_Product_Shared_State
 * @subpackage Max_Marine\Edit_Product_Shared_State/includes
 * @author     David Baumwald <david@dream-encode.com>
 */
class Max_Marine_Edit_Product_Shared_State_Activator {
	/**
	 * Activator.
	 *
	 * Runs on plugin activation.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public static function activate() {
		Max_Marine_Edit_Product_Shared_State_Upgrader::install();
	}
}

<?php
/**
 * Simple wrapper class for custom logs.
 *
 * @uses \WC_Logger();
 *
 * @link       https://dream-encode.com
 * @since      1.0.0
 *
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/includes
 */

namespace Max_Marine\Edit_Product_Shared_State\Core\Log;

use Max_Marine\Edit_Product_Shared_State\Core\Abstracts\Max_Marine_Edit_Product_Shared_State_Abstract_WC_Logger;

/**
 * Logger class.
 *
 * Log stuff to files.
 *
 * @since      1.0.0
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/includes
 * @author     David Baumwald <david@dream-encode.com>
 */
final class Max_Marine_Edit_Product_Shared_State_Upgrader_Logger extends Max_Marine_Edit_Product_Shared_State_Abstract_WC_Logger {
	/**
	 * Log namespace.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string  $namespace  Log namespace.
	 */
	public static $namespace = 'max-marine-edit-product-shared-state-upgrader';
}

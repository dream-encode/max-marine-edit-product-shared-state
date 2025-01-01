<?php
/**
 * Class Max_Marine_Edit_Product_Shared_State_Core_API
 *
 * @since 1.0.0
 */

namespace Max_Marine\Edit_Product_Shared_State\Core\RestApi;

use Max_Marine\Edit_Product_Shared_State\Core\Abstracts\Max_Marine_Edit_Product_Shared_State_Abstract_API;

defined( 'ABSPATH' ) || exit;

/**
 * Class Max_Marine_Edit_Product_Shared_State_Core_API
 *
 * @since 1.0.0
 */
class Max_Marine_Edit_Product_Shared_State_Core_API extends Max_Marine_Edit_Product_Shared_State_Abstract_API {
	/**
	 * Includes files
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function rest_api_includes() {
		parent::rest_api_includes();

		$path_version = 'includes/rest-api' . DIRECTORY_SEPARATOR . $this->version . DIRECTORY_SEPARATOR . 'frontend';

		include_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . $path_version . '/class-max-marine-edit-product-shared-state-rest-user-controller.php';
	}

	/**
	 * Register all routes.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function rest_api_register_routes() {
		$controllers = array(
			'Max_Marine_Edit_Product_Shared_State_REST_User_Controller',
		);

		$this->controllers = $controllers;

		parent::rest_api_register_routes();
	}
}

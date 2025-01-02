<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dream-encode.com
 * @since      1.0.0
 *
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/admin
 */

namespace Max_Marine\Edit_Product_Shared_State\Admin;

use WP_Screen;


/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/admin
 * @author     David Baumwald <david@dream-encode.com>
 */
class Max_Marine_Edit_Product_Shared_State_Admin {

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_styles() {
		if ( ! max_marine_edit_product_shared_state_admin_current_screen_has_enqueued_assets() ) {
			return;
		}

		$current_screen = \get_current_screen();

		if ( ! $current_screen instanceof WP_Screen ) {
			return;
		}

		$screens_to_assets = max_marine_edit_product_shared_state_get_admin_screens_to_assets();

		foreach ( $screens_to_assets as $screen => $assets ) {

			if ( $current_screen->id !== $screen ) {
				continue;
			}

			foreach ( $assets as $asset ) {
				$asset_base_url = MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_URL . 'admin/';

				ray( $asset );

				$asset_file = include( MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . "admin/assets/dist/js/admin-{$asset['name']}.min.asset.php" );

				wp_enqueue_style(
					"max-marine-edit-product-shared-state-admin-{$asset['name']}",
					$asset_base_url . "assets/dist/css/admin-{$asset['name']}.min.css",
					max_marine_edit_product_shared_state_get_style_asset_dependencies( $asset_file['dependencies'] ),
					$asset_file['version'],
					'all'
				);
			}
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( ! max_marine_edit_product_shared_state_admin_current_screen_has_enqueued_assets() ) {
			return;
		}

		$current_screen = get_current_screen();

		if ( ! $current_screen instanceof WP_Screen ) {
			return;
		}

		$screens_to_assets = max_marine_edit_product_shared_state_get_admin_screens_to_assets();

		foreach ( $screens_to_assets as $screen => $assets ) {
			if ( $current_screen->id !== $screen ) {
				continue;
			}

			foreach ( $assets as $asset ) {
				$asset_base_url = MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_URL . 'admin/';

				$asset_file = include( MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . "admin/assets/dist/js/admin-{$asset['name']}.min.asset.php" );

				wp_register_script(
					"max-marine-edit-product-shared-state-admin-{$asset['name']}",
					$asset_base_url . "assets/dist/js/admin-{$asset['name']}.min.js",
					$asset_file['dependencies'],
					$asset_file['version'],
					array(
						'in_footer' => true,
					)
				);

				if ( ! empty( $asset['localization'] ) ) {
					wp_localize_script( "max-marine-edit-product-shared-state-admin-{$asset['name']}", 'MMEPSS', $asset['localization'] );
				}

				wp_enqueue_script( "max-marine-edit-product-shared-state-admin-{$asset['name']}" );

				wp_set_script_translations( "max-marine-edit-product-shared-state-admin-{$asset['name']}", 'max-marine-edit-product-shared-state' );
			}
		}
	}

	/**
	 * Create a root for a react mount on the edit product page.
	 *
	 * @since  1.1.0
	 * @return void
	 */
	public function edit_product_page_react_root() {
		$current_screen = get_current_screen();

		if ( ! $current_screen instanceof WP_Screen ) {
			return;
		}

		if ( 'product' !== $current_screen->id ) {
			return;
		}

		echo '<div id="max-marine-edit-product-shared-state"></div>';
	}
}

<?php
/**
 * Common functions for the plugin.
 *
 * @link       https://dream-encode.com
 * @since      1.0.0
 *
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/includes
 */

/**
 * Define a constant if it is not already defined.
 *
 * @since  1.0.0
 * @param  string  $name   Constant name.
 * @param  mixed   $value  Constant value.
 * @return void
 */
function max_marine_edit_product_shared_state_maybe_define_constant( $name, $value ) {
	if ( ! defined( $name ) ) {
		define( $name, $value );
	}
}

/**
 * Get a plugin setting by key.
 *
 * @since  1.0.0
 * @param  string  $key      Setting key.
 * @param  mixed   $default  Optional. Default value. Default false.
 * @return mixed
 */
function max_marine_edit_product_shared_state_get_plugin_setting( $key, $default = false ) {
	static $settings = false;

	if ( false === $settings ) {
		$settings = get_option( 'max_marine_edit_product_shared_state_plugin_settings', array() );
	}

	if ( isset( $settings[ $key ] ) ) {
		return $settings[ $key ];
	}

	return $default;
}

/**
 * Get an array of data that relates enqueued assets to specific admin screens.
 *
 * @since  1.0.0
 * @return array
 */
function max_marine_edit_product_shared_state_get_admin_screens_to_assets() {
	return array(
		'product' => array(
			array(
				'name' => 'edit-product-page',
			),
		),
	);
}

/**
 * Get a list of WP style dependencies.
 *
 * @since  1.0.0
 * @return string[]
 */
function max_marine_edit_product_shared_state_get_wp_style_dependencies() {
	return array(
		'wp-components',
	);
}

/**
 * Get a list of WP style dependencies.
 *
 * @since  1.0.0
 * @param  array  $dependencies  Raw dependencies.
 * @return string[]
 */
function max_marine_edit_product_shared_state_get_style_asset_dependencies( $dependencies ) {
	$style_dependencies = max_marine_edit_product_shared_state_get_wp_style_dependencies();

	$new_dependencies = array();

	foreach ( $dependencies as $dependency ) {
		if ( in_array( $dependency, $style_dependencies, true ) ) {
			$new_dependencies[] = $dependency;
		}
	}

	return $new_dependencies;
}

/**
 * Get enqueued assets for the current admin screen.
 *
 * @since  1.0.0
 * @return array
 */
function max_marine_edit_product_shared_state_admin_current_screen_enqueued_assets() {
	$current_screen = get_current_screen();

	if ( ! $current_screen instanceof WP_Screen ) {
		return array();
	}

	$assets = max_marine_edit_product_shared_state_get_admin_screens_to_assets();

	return ! empty( $assets[ $current_screen->id ] ) ? $assets[ $current_screen->id ] : array();
}

/**
 * Check if the current admin screen has any enqueued assets.
 *
 * @since  1.0.0
 * @return int
 */
function max_marine_edit_product_shared_state_admin_current_screen_has_enqueued_assets() {
	return count( max_marine_edit_product_shared_state_admin_current_screen_enqueued_assets() );
}

/**
 * Get enqueued assets for the an admin screen.
 *
 * @since  1.0.0
 * @param  WP_Screen  $screen  Screen to check.
 * @return array
 */
function max_marine_edit_product_shared_state_admin_screen_enqueued_assets( $screen ) {
	if ( ! $screen instanceof WP_Screen ) {
		return array();
	}

	$assets = max_marine_edit_product_shared_state_get_admin_screens_to_assets();

	return ! empty( $assets[ $screen->id ] ) ? $assets[ $screen->id ] : array();
}

/**
 * Check if an admin screen has any enqueued assets.
 *
 * @since  1.0.0
 * @param  WP_Screen  $screen  Screen to check.
 * @return int
 */
function max_marine_edit_product_shared_state_admin_screen_has_enqueued_assets( $screen ) {
	return count( max_marine_edit_product_shared_state_admin_screen_enqueued_assets( $screen ) );
}

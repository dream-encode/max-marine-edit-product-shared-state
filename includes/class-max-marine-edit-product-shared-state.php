<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://dream-encode.com
 * @since      1.0.0
 *
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/includes
 */

namespace Max_Marine\Edit_Product_Shared_State\Core;

use Max_Marine\Edit_Product_Shared_State\Core\Max_Marine_Edit_Product_Shared_State_Loader;
use Max_Marine\Edit_Product_Shared_State\Core\Max_Marine_Edit_Product_Shared_State_I18n;
use Max_Marine\Edit_Product_Shared_State\Admin\Max_Marine_Edit_Product_Shared_State_Admin;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Max_Marine_Edit_Product_Shared_State
 * @subpackage Max_Marine_Edit_Product_Shared_State/includes
 * @author     David Baumwald <david@dream-encode.com>
 */
class Max_Marine_Edit_Product_Shared_State {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     Max_Marine_Edit_Product_Shared_State_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'max-marine-edit-product-shared-state';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Max_Marine_Edit_Product_Shared_State_Loader. Orchestrates the hooks of the plugin.
	 * - Max_Marine_Edit_Product_Shared_State_I18n. Defines internationalization functionality.
	 * - Max_Marine_Edit_Product_Shared_State_Admin. Defines all hooks for the admin area.
	 * - Max_Marine_Edit_Product_Shared_State_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'includes/class-max-marine-edit-product-shared-state-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'includes/class-max-marine-edit-product-shared-state-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once MAX_MARINE_EDIT_PRODUCT_SHARED_STATE_PLUGIN_PATH . 'admin/class-max-marine-edit-product-shared-state-admin.php';

		$this->loader = new Max_Marine_Edit_Product_Shared_State_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Max_Marine_Edit_Product_Shared_State_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function set_locale() {
		$plugin_i18n = new Max_Marine_Edit_Product_Shared_State_I18n();

		$this->loader->add_action( 'init', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Max_Marine_Edit_Product_Shared_State_Admin();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'edit_form_after_editor', $plugin_admin, 'edit_product_page_react_root', 900 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since  1.0.0
	 * @return string  The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since  1.0.0
	 * @return Max_Marine_Edit_Product_Shared_State_Loader  Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since  1.0.0
	 * @return string  The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}

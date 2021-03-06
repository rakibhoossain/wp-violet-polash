<?php
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
 * @package    Vcpm
 * @subpackage Vcpm/includes
 * @author     Rakib Hossain <serakib@gmail.com>
 */
class Vcpm {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Vcpm_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'VCPM_VERSION' ) ) {
			$this->version = VCPM_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'vcpm';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

		add_filter( 'widget_text', 'do_shortcode' );
		add_shortcode( 'CORONA_TABLE', [$this,'KNR_Player_shortcode_handler'] );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Vcpm_Loader. Orchestrates the hooks of the plugin.
	 * - Vcpm_i18n. Defines internationalization functionality.
	 * - Vcpm_Admin. Defines all hooks for the admin area.
	 * - Vcpm_Post_Types. Defines all Custom post types
	 * - Vcpm_Taxonomy. Defines portfolio texonomy.
	 * - Vcpm_Meta. Defines Meta Boxes for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-vcpm-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-vcpm-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-vcpm-admin.php';

		/**
         * Custom Post Types
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-vcpm-post_types.php';

        /**
         * Portfolio category
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-vcpm-taxonomy.php';

		/**
		 * Meta Box.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-vcpm-meta.php';

		$this->loader = new Vcpm_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Vcpm_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Vcpm_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Vcpm_Admin( $this->get_plugin_name(), $this->get_version() );
		$vcpm_post_types = new Vcpm_Post_Types();
		$vcpm_Taxonomy = new Vcpm_Taxonomy();
		$vcpm_meta = new Vcpm_Meta();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'init', $vcpm_post_types, 'vcpm_service' );
		$this->loader->add_action( 'init', $vcpm_post_types, 'vcpm_activity' );
		// $this->loader->add_action( 'init', $vcpm_post_types, 'vcpm_skill' );
		// $this->loader->add_action( 'init', $vcpm_post_types, 'vcpm_portfolio' );
		// $this->loader->add_action( 'init', $vcpm_post_types, 'vcpm_testimonial' );
		// $this->loader->add_action( 'init', $vcpm_post_types, 'vcpm_team' );
		// $this->loader->add_action( 'init', $vcpm_post_types, 'vcpm_partner' );

		$this->loader->add_action( 'init', $vcpm_Taxonomy, 'vcpm_taxonomy_activity' );
		
		// $this->loader->add_action( 'init', $vcpm_Taxonomy, 'vcpm_taxonomy_portfolio' );

		$this->loader->add_action( 'add_meta_boxes', $vcpm_meta, 'add' );
		$this->loader->add_action( 'save_post', $vcpm_meta, 'save' );

	}

		/**
	 * Register all of shortcode
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function KNR_Player_shortcode_handler() {
		return '<div class="col-md-12 corona-table"></div>';
	}


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Vcpm_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

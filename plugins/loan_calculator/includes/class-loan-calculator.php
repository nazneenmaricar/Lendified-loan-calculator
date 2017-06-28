<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://redacademy.com/
 * @since      1.0.0
 *
 * @package    Loan_Calculator
 * @subpackage Loan_Calculator/includes
 */

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
 * @package    Loan_Calculator
 * @subpackage Loan_Calculator/includes
 * @author     Red Academy <jwilliams8@me.com>
 */
class Loan_Calculator {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Loan_Calculator_Loader    $loader    Maintains and registers all hooks for the plugin.
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

		$this->plugin_name = 'loan-calculator';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->enqueue_scripts();
		$this->localize_settings();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Loan_Calculator_Loader. Orchestrates the hooks of the plugin.
	 * - Loan_Calculator_i18n. Defines internationalization functionality.
	 * - Loan_Calculator_Admin. Defines all hooks for the admin area.
	 * - Loan_Calculator_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loan-calculator-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-loan-calculator-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-loan-calculator-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-loan-calculator-public.php';

		$this->loader = new Loan_Calculator_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Loan_Calculator_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Loan_Calculator_i18n();

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

		$plugin_admin = new Loan_Calculator_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Loan_Calculator_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Enqueuing scripts and styles for plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function enqueue_scripts() {

		if(!is_admin()){
			wp_enqueue_style ('jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
			wp_enqueue_style ('slider-style', plugins_url('loan_calculator/public/css/') . 'sliderstyle.css');
			wp_enqueue_style ('lato-google-font', 'https://fonts.googleapis.com/css?family=Lato:700');
			wp_enqueue_style ('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
			wp_enqueue_script ('jquery', 'https://code.jquery.com/jquery-1.12.4.js', array('jquery'), 3.3, true);
			wp_enqueue_script ('jquery-ui-js', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), 3.3, true);
			wp_enqueue_script ('jquery-ui-touch-punch', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', array('jquery'), 3.3, true);
			wp_enqueue_script ('main-calculator-js', plugins_url('loan_calculator/public/js/') . 'main_calculator.js');
		}

	}

	/**
	 * Localizing admin settings to be used within javascript.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function localize_settings() {

		//Localizing Interest Rates from Admin Settings
		wp_localize_script( 'main-calculator-js', 'wp_rates', array(
			'interestMin' => get_option('bwp_interest_min'),
			'interestMax' => get_option('bwp_interest_max'),
			'landifiedInterest' => get_option('lendified_interest'),
			'barOneInterest' => get_option('bar_1_interest'),
			'barTwoInterest' => get_option('bar_2_interest'),
			'barThreeInterest' => get_option('bar_3_interest')
  		));

		//Localizing Loan Amount and Term from Admin Settings
		wp_localize_script( 'main-calculator-js', 'wp_ranges', array(
			'loanAmountMin' => get_option('loan_amount_min'),
			'loanAmountMax' => get_option('loan_amount_max'),
			'loanAmountStep' => get_option('loan_amount_step'),
			'loanAmountDefault' => get_option('loan_amount_default'),
			'loanTermMin' => get_option('loan_term_min'),
			'loanTermMax' => get_option('loan_term_max'),
			'loanTermStep' => get_option('loan_term_step'),
			'loanTermDefault' => get_option('loan_term_default')
  		));

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
	 * @return    Loan_Calculator_Loader    Orchestrates the hooks of the plugin.
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

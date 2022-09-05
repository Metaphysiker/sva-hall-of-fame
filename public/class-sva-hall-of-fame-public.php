<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.philosophische-insel.ch/
 * @since      1.0.0
 *
 * @package    Sva_Hall_Of_Fame
 * @subpackage Sva_Hall_Of_Fame/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sva_Hall_Of_Fame
 * @subpackage Sva_Hall_Of_Fame/public
 * @author     Sandro Räss <s.raess@me.com>
 */
class Sva_Hall_Of_Fame_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sva_Hall_Of_Fame_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sva_Hall_Of_Fame_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sva-hall-of-fame-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sva_Hall_Of_Fame_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sva_Hall_Of_Fame_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sva-hall-of-fame-public.js', array( 'jquery' ), $this->version, false );

	}

	public function svahalloffame_add_shortcode() {

		//wp_register_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css' );
		//wp_enqueue_style('bootstrap-css');

		//wp_register_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js');
		//wp_enqueue_script('bootstrap-js');

		add_shortcode(
			'svahalloffame',
			array( $this, 'svahalloffame_func' )
		);
}

public function svahalloffame_func($atts){

	global $wpdb;
	//$menus = get_terms( 'nav_menu' );
	$html_block = "";
	//$accordion_items = "";
	$attributes = shortcode_atts( array(
		'year' => 2022,
		'sub_menu_id' => 0,
		'per-page' => '50',
	), $atts );

	$categories = $wpdb->get_results("SELECT DISTINCT category FROM {$wpdb->prefix}svahalloffame WHERE year = {$attributes['year']}");

	foreach ( $categories as $category ) {
		$winners_in_category = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}svahalloffame WHERE category = '{$category->category}' AND year = {$attributes['year']} ORDER BY ranking ASC");
		$winners_html = "";

		foreach ( $winners_in_category as $winner ) {
			$winners_html = $winners_html . "<h3>" . $winner->ranking . ". " . $winner->winner . "</h3>";

		}

		//$html_block = $html_block . $winners_html;


		$card = <<<HTML

			<div class="card h-100 mb-4">
				<div class="card-body">
					<h3 class="card-title mb-2">{$category->category}</h3>

					{$winners_html}
				</div>
			</div>

		HTML;

		$html_block = $html_block . $card;

	}

	$final_html_block = <<<HTML
	<div class="container">
		<h2>Swiss Vegan Awards {$winners_in_category[0]->year}</h2>
		<div class="mb-4">
			{$html_block}
		</div>
	</div>
HTML;

	return $final_html_block;
}

}

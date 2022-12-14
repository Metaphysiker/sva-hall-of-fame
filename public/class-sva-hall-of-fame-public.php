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
	 * @since    1.0.0
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

	$items = $wpdb->get_results("SELECT * FROM wp_svahalloffame WHERE year = {$attributes['year']}");
	//print_r($items);

	foreach ( $items as $item ) {
$item_html = <<<HTML
<p>
	{$item->text} - {$item->year}
</p>
HTML;
		$html_block = $html_block . $item_html;
	}

	return $html_block;
}

}

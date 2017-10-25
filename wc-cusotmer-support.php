<?php
/*
Plugin Name: WooCommerce Customer Support
Plugin URI: http://sabbir.pro/
Description: A fully customer support system for WooCommerce
Version: 1.0.0
Author: Sabbir Ahmed, Rafsun
Author URI: http://sabbir.pro/
License: GPL2
*/

/**
 * Copyright (c) YEAR Sabbir Ahmed (email: sabbir.080170@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * WC_Customer_Support class
 *
 * @class WC_Customer_Support The class that holds the entire WC_Customer_Support plugin
 */
class WC_Customer_Support {

     /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Constructor for the WC_Customer_Support class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook()
     * @uses register_deactivation_hook()
     * @uses is_admin()
     * @uses add_action()
     */
    public function __construct() {

        // Define all constant
        $this->define_constant();

        //includes file
        $this->includes();

        // init actions and filter
        $this->init_filters();
        $this->init_actions();

        // initialize classes
        $this->init_classes();

        do_action( 'wc_customer_support_loaded', $this );
    }

    /**
     * Initializes the WC_Customer_Support() class
     *
     * Checks for an existing WC_Customer_Support() instance
     * and if it doesn't find one, creates it.
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new WC_Customer_Support();
        }

        return $instance;
    }

    /**
     * Placeholder for activation function
     *
     * Nothing being called here yet.
     */
    public static function activate() {

    }

    /**
     * Placeholder for deactivation function
     *
     * Nothing being called here yet.
     */
    public static function deactivate() {

    }

    /**
     * Defined all constant
     *
     * @return void
     */
    private function define_constant() {
        define( 'WC_CUSTOMER_SUPPORT_VERSION', $this->version );
        define( 'WC_CUSTOMER_SUPPORT_FILE', __FILE__ );
        define( 'WC_CUSTOMER_SUPPORT_PATH', dirname( WC_CUSTOMER_SUPPORT_FILE ) );
        define( 'WC_CUSTOMER_SUPPORT_ASSETS', plugins_url( '/assets', __FILE__ ) );
    }

    /**
    * Includes all files
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function includes() {
        // Includes all files in your plugins
    }

    /**
    * Init all filters
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function init_filters() {
        // Load all filters
    }

    /**
    * Init all actions
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function init_actions() {
        // Localize our plugin
        add_action( 'init', array( $this, 'localization_setup' ) );

        // Loads frontend scripts and styles
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
    }

    /**
    * Inistantiate all classes
    *
    * @since 1.0.0
    *
    * @return void
    **/
    private function init_classes() {
        // Create instnace for all class
    }

    /**
     * Initialize plugin for localization
     *
     * @since 1.0.0
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup() {
        load_plugin_textdomain( 'wc-customer-support', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
     * Enqueue admin scripts
     *
     * @since 1.0.0
     *
     * Allows plugin assets to be loaded.
     *
     * @return void
     */
    public function enqueue_scripts() {

        wp_enqueue_style( 'wc-customer-support-styles', WC_Customer_Support_ASSETS . '/css/style.css', false, date( 'Ymd' ) );
        wp_enqueue_script( 'wc-customer-support-scripts', WC_Customer_Support_ASSETS . '/js/script.js', array( 'jquery' ), false, true );

        /**
         * Example for setting up text strings from Javascript files for localization
         *
         * Uncomment line below and replace with proper localization variables.
         */
        // $translation_array = array( 'some_string' => __( 'Some string to translate', 'baseplugin' ), 'a_value' => '10' );
        // wp_localize_script( 'base-plugin-scripts', 'baseplugin', $translation_array ) );
    }

    /**
    * Load admin scripts
    *
    * @since 1.0.0
    *
    * @return void
    **/
    public function admin_enqueue_scripts( $hooks ) {
        // Load your admin scripts..
    }

} // WC_Customer_Support

$wc_customer_support = WC_Customer_Support::init();

register_activation_hook( __FILE__, array( 'WC_Customer_Support', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'WC_Customer_Support', 'deactivate' ) );
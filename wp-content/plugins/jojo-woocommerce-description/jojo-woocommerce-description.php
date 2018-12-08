<?php
/*
Plugin Name: JoJo WooCommerce Product Description
Plugin URI: http://jojoweb.dk/wordpress-plugins/jojo-woocommerce-description
Description: Show a short description for each product in category view
Version: 1.0.5
Author: Jon Kristensen - JoJo Web
Author URI: http://jojoweb.dk
Text Domain: jojo-woocommerce-description
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2016 Jon Kristensen, JoJo Web, info@jojoweb.dk
*/

register_activation_hook(__FILE__, 'jojo_woocommerce_description_activate');
register_deactivation_hook(__FILE__, 'jojo_woocommerce_description_deactivate');

/**
 *Activation of plugin
 */
function jojo_woocommerce_description_activate()
{
}

/**
 * Deactivation of plugin
 */
function jojo_woocommerce_description_deactivate()
{
}

/** 
 * Actions
 */
add_action( 'woocommerce_after_shop_loop_item_title', 'jojo_woocommerce_description_after_shop_loop_item_title' );
add_action( 'wp_enqueue_scripts', 'jojo_woocommerce_description_add_stylesheet');
add_filter( 'woocommerce_get_sections_products', 'jojo_woocommerce_description_add_section' );
add_filter( 'woocommerce_get_settings_products', 'jojo_woocommerce_description_settings', 10, 2 );
add_action( 'plugins_loaded', 'jojo_woocommerce_description_textdomain' );


/**
 *
 */
function jojo_woocommerce_description_after_shop_loop_item_title()
{
    global $post;

    if (get_option('jojo_description_enable') == 'yes')
    {
        echo '<br/>';
        echo '<div class="jojo_woocommerce_short_description"';
        if (get_option('jojo_description_fixed_enable') == 'yes') {
            $height = absint(get_option('jojo_description_fixed_height'));
            printf ( 'style="height: %dem; overflow: hidden;"', 1.5 * $height);
        }
        echo '>';
        echo apply_filters('woocommerce_short_description', $post->post_excerpt);
        echo '</div>';

        if (get_option('jojo_description_fixed_enable') == 'yes') {
            global $product;
            if (!$product->get_price_html()) {
                ?><span class="price">-</span><?php
            }
        }
    }
}

function jojo_woocommerce_description_add_stylesheet()
{
    wp_enqueue_style('jojo_short_description', plugins_url('jojo-woocommerce-description/css/description.css'));
}

function jojo_woocommerce_description_add_section( $sections ) {

    $sections['jojo_description'] = __( 'JoJo Product Description', 'jojo-woocommerce-description' );
    return $sections;

}

function jojo_woocommerce_description_settings( $settings, $current_section )
{
    if ( $current_section == 'jojo_description' ) {

        $jojo_description_settings = array();

        // Add Title to the Settings
        $jojo_description_settings[] = array(
            'name' => __( 'JoJo WooCommerce Description Settings', 'jojo-woocommerce-description' ),
            'type' => 'title',
            'desc' => __( 'Settings for JoJo WooCommerce Description', 'jojo-woocommerce-description' ),
            'id' => 'jojo_description' );

        // Enable
        $jojo_description_settings[] = array(
            'name'     => __( 'Enable description in product list', 'jojo-woocommerce-description' ),
            'desc_tip' => __( 'The short description will be shown with the product', 'jojo-woocommerce-description' ),
            'id'       => 'jojo_description_enable',
            'type'     => 'checkbox',
            'css'      => 'min-width:300px;',
            'desc'     => __( 'Show short description on product list', 'jojo-woocommerce-description' ),
        );

        // Limit description height
        $jojo_description_settings[] = array(
            'name'     => __( 'Fixed height', 'jojo-woocommerce-description' ),
            'desc_tip' => __( 'Fixed number of lines shown in the description', 'jojo-woocommerce-description' ),
            'id'       => 'jojo_description_fixed_enable',
            'type'     => 'checkbox',
            'css'      => 'min-width:300px;',
            'desc'     => __( 'Fixed number of lines shown in the description', 'jojo-woocommerce-description' ),
        );

        // Description height
        $jojo_description_settings[] = array(
            'title'             => __( 'Description fixed height', 'jojo-woocommerce-description' ),
            'desc'              => __( 'Number of lines', 'jojo-woocommerce-description' ),
            'id'                => 'jojo_description_fixed_height',
            'css'               => 'width:50px;',
            'type'              => 'number',
            'custom_attributes' => array(
                'min'  => 0,
                'step' => 1
            ),
            'default'           => '8',
            'autoload'          => false
        );

        $jojo_description_settings[] = array( 'type' => 'sectionend', 'id' => 'jojo_description' );

        return $jojo_description_settings;

        /**
         * If not, return the standard settings
         **/
    } else {
        return $settings;
    }
}

function jojo_woocommerce_description_textdomain() {
    load_plugin_textdomain( 'jojo-woocommerce-description', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

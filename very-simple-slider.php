<?php

/**
 * Plugin Name: Very Simple Slider
 * Description: A very simple Slider-Plugin to extend wordpress with a Slider functionality.
 * Plugin URI: http://www.seiboldsoft.de
 * Author: Emanuel Seibold
 * Author URI: http://www.seiboldsoft.de
 * Version: 1.0
 * Text Domain: very-simple-slider
 * License: GPL2

  Copyright 2016 Emanuel Seibold (email : wordpress AT seiboldsoft DOT de)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
/**
 * Define versions and pathes
 * 
 */
define('SVSS_VERSION', '1.0');
define('SVSS_PATH', dirname(__FILE__));
define('SVSS_FOLDER', basename(SVSS_PATH));
define('SVSS_URL', plugins_url() . '/' . SVSS_FOLDER);
define('SVSS_TEMPLATES', SVSS_URL . '/templates');

/**
 * 
 * The plugin base class - the root of all WP goods!
 * 
 * @author Emanuel Seibold
 *
 */
class SVSS_Plugin_Base {

    /**
     * 
     * Assign everything as a call from within the constructor
     */
    public function __construct() {



        add_action('wp_enqueue_scripts', array($this, 'svss_add_CSS'));
        add_action('plugins_loaded', array($this, 'svss_add_textdomain'));
        add_action('init', array($this, 'register'));


        // Register activation and deactivation hooks
        register_activation_hook(__FILE__, 'svss_on_activate_callback');
        register_deactivation_hook(__FILE__, 'svss_on_deactivate_callback');
    }

    public function register() {
        add_shortcode('simple-slider', array($this, 'svss_shortcode_body'));
    }

    /**
     * 
     * Add CSS styles
     * 
     */
    public function svss_add_CSS() {
        wp_register_style('very-simple-slider-style', plugins_url('/css/very-simple-slider.css', __FILE__), array(), '1.0', 'screen');
        wp_enqueue_style('very-simple-slider-style');
    }

    /**
     * Returns the content of the simple-Slider
     * @param array $attr arguments passed to array
     * @param string $content optional, could be used for a content to be wrapped
     */
    public function svss_shortcode_body($attr, $content = null) {


        require plugin_dir_path(__FILE__) . 'class-template-generator.php';

        $output = '';

        $pull_atts = shortcode_atts(array(
            'template' => 'slider-home',
            'id' => '',
            'ids' => '',
            'name' => 'default',
            'category' => '',
                ), $attr);


        if ((isset($pull_atts['category']) && intval($pull_atts['category'])) || (isset($pull_atts["ids"]) && $pull_atts["ids"] != "")) {

            $tplgenerator = new Slider_Template_Generator();

            if (isset($pull_atts['template'])) {
                $tplgenerator->setTemplate_Name($pull_atts['template']);
            } else {
                $tplgenerator->setTemplate_Name("slider-home");
            }

            if (isset($pull_atts["ids"])) {
                $tplgenerator->setIds($pull_atts["ids"]);
            }

            if (isset($pull_atts["name"])) {
                $tplgenerator->setName($pull_atts["name"]);
            }
            //this may be used for later to generate dynamic images
            $tplgenerator->setCategory($pull_atts['category']);
            $output .= $tplgenerator->generate_output();
        }


        return $output;
    }

    /**
     * Add textdomain for plugin
     */
    public function svss_add_textdomain() {
        $lang_dir = basename(dirname(__FILE__)) . '/lang/';
        load_plugin_textdomain('very-simple-slider', false, $lang_dir);
    }

}

/**
 * Register activation hook
 *
 */
function svss_on_activate_callback() {

    flush_rewrite_rules();
}

/**
 * Register deactivation hook
 *
 */
function svss_on_deactivate_callback() {
    flush_rewrite_rules();
}

// Initialize everything

$svss_plugin_base = new SVSS_Plugin_Base();



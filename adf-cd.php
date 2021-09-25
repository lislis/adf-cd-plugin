<?php
  /**
   * @package ADF-CD
   */
  /*
    Plugin Name: ADF Chat-Dokumentation
    Plugin URI: 
    Description: Custom plugin that enabled a shortcode for embedding chat documentation tool.
    Author: lislis
    Version: 0.0.1
    Author URI: https://lislis.de
  */


// Hook the 'wp_footer' action hook, add the function named 'mfp_Add_Text' to it
add_action("wp_footer", "adf_cd_add_script");
 
function adf_cd_add_script() {
  echo "";
}

function adf_cd_shortcode_function($atts = array()) {
  wp_enqueue_style( 'adf-vue-styles', plugin_dir_url(__FILE__) . 'dist/css/app.css', array(), '0.0.2', 'screen');

  wp_register_script('adf-vue-chunk', plugin_dir_url(__FILE__) . 'dist/js/chunk-vendors.js', array(), '0.0.2', true);
  wp_enqueue_script('adf-vue-chunk');

  wp_register_script('adf-vue-app', plugin_dir_url(__FILE__) . 'dist/js/app.js', array('adf-vue-chunk'), '0.0.2', true);
  wp_enqueue_script('adf-vue-app');

  extract(shortcode_atts(array(
                               'api_url' => 'http://urlnot.set',
                               'container_class' => 'adf-cd-container'
                               ), $atts));
  return "<noscript>Du musst JavaScript einschalten um dieses Tool nutzen zu können.</noscript><script>window.API_URL = \"$api_url\";</script><div id=\"adf-cd\" class=\"$container_class\"></div>";
}

add_shortcode('adf_cd', 'adf_cd_shortcode_function');

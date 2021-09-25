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

add_action('admin_menu', 'adf_cd_plugin_setup_menu');
 
function adf_cd_plugin_setup_menu(){
  add_menu_page( 'ADF-CD Plugin', 'ADF-CD', 'manage_options', 'adf-cd', 'test_init' );
}
 
function test_init(){
  echo "<h1>ADF CD Plugin!</h1>";
  echo "<h2>Shortcode Verwendung</h2>";
  echo "<p>api_url zeigt auf den API server. container_class ist optional aber vielleicht für das Styling hilfreich.</p>";
  echo "<pre>[adf_cd api_url=\"http://localhost:3000/api\" container_class=\"fooobarbaz\"]</pre>";
  echo "<h2>Beispiel Styling</h2>";
  echo "<p>Der Container könnte zB so gestylt werden, um fullscreen zu sein.</p>";
  echo "<pre>#adf-cd { 
    overflow-x: hidden; 
    height: 100vh; 
    width: 100vw; 
    position: absolute; 
    top: 0; 
    bottom: 0; 
}</pre>";
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

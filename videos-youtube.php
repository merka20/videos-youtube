<?php
/*
Plugin Name: Video archive by Merka20
Plugin URI: https://merka20.com
Description: This plugin adds support for WordPress with a developer who will help you at all times.
 developer.Plugin para conectar con la asistencia técnica del desarrollador.
Author: Oscar Domingo
Version: 1.0.0
Author URI: https://merka20.com
Requires at least: 5.0
Tested up to: 6.6.1
Requires PHP: 7.4
Text Domain: MK20-VA
Domain Path: /languages

License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
if (!defined('ABSPATH')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
} // Salir si acceden directamente

$urlsited = get_site_url() . "/";

function activate()
{

	//Create the table of Data Base

	global $wpdb;
	$urlsite = MD5(get_site_url() . "/");
	
	$table_name = $wpdb->prefix . 'va_video_id';

	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		Video_Id INT NOT NULL AUTO_INCREMENT,
		Estado BOOLEAN NOT NULL,
		Fecha TIMESTAMP NOT NULL,
		Fecha_Publicado DATE NOT NULL,
		PRIMARY KEY (Video_Id)
	) $charset_collate;";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

  }

function deactivate()
{ }

register_activation_hook(__FILE__, 'activate');
register_deactivation_hook(__FILE__, 'deactivate');


//encolar bootstrap js


if (!function_exists('MK20_VA_encolar_js_css')) {
    function MK20_VA_encolar_js_css()
    {
        global $post; // Declarar $post como una variable global

        if (isset($post) && has_shortcode($post->post_content, 'video_load')) {
            // Registrar y encolar el JavaScript
            wp_register_script('vajs', plugins_url('/public/js/va.js', __FILE__), array(), '1.0', true);
            wp_enqueue_script('vajs');           
        }
    }
    add_action('wp_enqueue_scripts', 'MK20_VA_encolar_js_css');
}

if (!function_exists('MK20_VA_encolar_estilos_propios')) {

    function MK20_VA_encolar_estilos_propios()
    {
        global $post; // Declarar $post como una variable global

        if (isset($post) && has_shortcode($post->post_content, 'video_load')) {
            // Registrar y encolar el CSS
            wp_register_style('csspropiova', plugins_url('/public/css/style.css', __FILE__), array(), '1.0');
            wp_enqueue_style('csspropiova');
        }	   
    }
    add_action('wp_enqueue_scripts', 'MK20_VA_encolar_estilos_propios');
}


//Load texdomain

if (!function_exists('MK20_VA_load_plugin_textdomain')) {

	function MK20_VA_load_plugin_textdomain()
	{
		load_plugin_textdomain('MK20-VA', false, plugin_basename(dirname(__FILE__)) . '/languages/');
	}
	add_action('plugins_loaded', 'MK20_VA_load_plugin_textdomain');
}

//Shortcode video

if (!function_exists('MK20_VA_load_videos')) {

	function MK20_VA_load_videos($atts)
	{
		$args = shortcode_atts( array(
			'data-id' =>'QMgSELBA7kw',
		), $atts);
		$video = "<div class='youtube-player' data-id='".$args['data-id']."'></div>";
		return $video;	
	}

	add_shortcode('video_load', 'MK20_VA_load_videos');
}
?>
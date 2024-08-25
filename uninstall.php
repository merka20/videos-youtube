<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 * 
 *
 * @link       https://merka20.com
 * @since      1.0.0 
 */

// If uninstall not called from WordPress, then exit.
if (!defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

  /*global $wpdb;

  $tableArray = [
      $wpdb->prefix . 'va_video_id',
  ];

  foreach ($tableArray as $tablename) {
      // Escapando el nombre de la tabla para mayor seguridad
      $safe_table_name = esc_sql($tablename);

      // Ejecutando la consulta para eliminar la tabla de manera segura
      $wpdb->query($wpdb->prepare(("DROP TABLE IF EXISTS {$safe_table_name}")));
  }*/

// Función de desinstalación
global $wpdb;

// Define the tables to delete
$tableArray = [
    $wpdb->prefix . 'va_video_id',
];

foreach ($tableArray as $tablename) {
    // Prepare the SQL query using placeholders
    //$sql = $wpdb->prepare("DROP TABLE IF EXISTS %s", $tablename);
    
    // Execute the query
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS %s", $tablename));
}
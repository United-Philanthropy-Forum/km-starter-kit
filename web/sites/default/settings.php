<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * Include the Pantheon-specific settings file.
 *
 * n.b. The settings.pantheon.php file makes some changes
 *      that affect all environments that this site
 *      exists in.  Always include this file, even in
 *      a local development environment, to ensure that
 *      the site settings remain consistent.
 */
include __DIR__ . "/settings.pantheon.php";

/**
 * Skipping permissions hardening will make scaffolding
 * work better, but will also raise a warning when you
 * install Drupal.
 *
 * https://www.drupal.org/project/drupal/issues/3091285
 */
// $settings['skip_permissions_hardening'] = TRUE;

/**
 * If there is a local settings file, then include it
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}

/**
 * Redirect to HTTPS and the primary domain.
 */
if (defined('PANTHEON_ENVIRONMENT')|| getenv('PANTHEON_TOKEN')) {
  $config['config_split.config_split.local']['status'] = FALSE;
	if (php_sapi_name() != 'cli') {	
    // Redirect to https://$primary_domain in the Live environment.
    if (PANTHEON_ENVIRONMENT === 'live') {
      $primary_domain = 'live-socalgrantmakers.pantheonsite.io';
    }
    else {
      // Redirect to HTTPS on every Pantheon environment.
      $primary_domain = $_SERVER['HTTP_HOST'];
    }
  
    if ($_SERVER['HTTP_HOST'] != $primary_domain || !isset($_SERVER['HTTP_USER_AGENT_HTTPS']) || $_SERVER['HTTP_USER_AGENT_HTTPS'] != 'ON' ) {
      // Name transaction "redirect" in New Relic for improved reporting.
      if (extension_loaded('newrelic')) {
        newrelic_name_transaction('redirect');
      }
     
      header('HTTP/1.0 301 Moved Permanently');
      header('Location: https://'. $primary_domain . $_SERVER['REQUEST_URI']);
      exit();
    }
  
    // Trusted host settings.
    $settings['trusted_host_patterns'][] = "{$_ENV['PANTHEON_ENVIRONMENT']}-{$_ENV['PANTHEON_SITE_NAME']}.pantheon.io";
    $settings['trusted_host_patterns'][] = "{$_ENV['PANTHEON_ENVIRONMENT']}-{$_ENV['PANTHEON_SITE_NAME']}.pantheonsite.io";
    $settings['trusted_host_patterns'][] = '^.+\.socalgrantmakers\.org$';
    $settings['trusted_host_patterns'][] = '^socalgrantmakers\.org$';
  }
}

$settings['install_profile'] = 'km_collaborative';

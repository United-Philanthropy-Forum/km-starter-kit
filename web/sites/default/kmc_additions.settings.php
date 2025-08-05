<?php

/**
 * The contents of this file should be added to settings.php on new sites.
 *
 * MOST of it can be added anywhere, as long as it's above the local settings
 * inclusion (Above the comment "If there is a local settings file, then include
 * it").
 *
 * There is a well-marked section at the end of this file that should go *below*
 * the local settings inclusion, at the very end of settings.php.
 */

/**
 * Configure Redis. See https://docs.pantheon.io/object-cache/drupal for the
 * latest instructions on what to include here. You can skip the "composer
 * require" and "git" commands, as those are part of the distro. Past the
 * latest redis configurations here ones you have enabled redis in Pantheon.
 */
if (defined('PANTHEON_ENVIRONMENT')
  && !\Drupal\Core\Installer\InstallerKernel::installationAttempted()
  && extension_loaded('redis')) {
  // Bla bla bla (copy from Pantheon docs).
}

/**
 * Enable mail_safety by default on all non-live environments to prevent queued
 * mail from cloned databases getting sent out from dev environments or other
 * mail from going out. To test actual mail sending in local environments, you
 * can override this setting or comment it out on your local, but this should be
 * done rarely, briefly, and carefully.
 */
$config['mail_safety.settings']['enabled'] = TRUE;

if (defined('PANTHEON_ENVIRONMENT') && PANTHEON_ENVIRONMENT == 'live') {
  $config['mail_safety.settings']['enabled'] = FALSE;
}
else {
  // Set the dashboard setting gently, so the live site can use it as desired.
  $config['mail_safety.settings']['send_mail_to_dashboard'] = TRUE;
}

/**
 * Salesforce protections -- these prevent development sites from connecting to
 * the live salesforce instance. It also allows for a special development env
 * that can connect to the live instance for (careful) QA and testing. That
 * instance can either be a Salesforce Multidev named "rc-sflive", or a custom
 * name which you add to the $live_salesforce_environments array below.
 */
// Disable all SF sync by default.
$allow_salesforce = FALSE;
// Set SF Sandbox by default, then logic switch it to LIVE SF for LIVE env.
$config['salesforce.settings']['salesforce_auth_provider'] = 'sf_sandbox_oauth_jwt';
if ((defined('PANTHEON_ENVIRONMENT') || getenv('PANTHEON_TOKEN')) && PANTHEON_ENVIRONMENT !== 'lando') {
  // Enable SF for Pantheon environments. Defaults to Sandbox environment.
  $allow_salesforce = TRUE;
  // Allow connection to the live Salesforce database. Add an environment
  // name if you need to test live connection in a non-live multidev.
  $live_salesforce_environments = [
    'live',
    'rc-sflive',
  ];
  if (in_array(PANTHEON_ENVIRONMENT, $live_salesforce_environments)) {
    $config['salesforce.settings']['salesforce_auth_provider'] = 'salesforce_oauth_jwt';
  }
}

// =====================ATTENTION, PUT AT THE END!!==========================
// Put this at the end of settings.php, event after the settings.local logic.
// ==========================================================================
/**
 * If $allow_salesforce has not been set to TRUE, disable Salesforce sync.
 */
if (!$allow_salesforce) {
  $config['salesforce.settings']['salesforce_auth_provider'] = NULL;
}

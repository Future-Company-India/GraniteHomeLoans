<?php

/**
 * MU Plugin: Site Globals
 * Description: Defines constants for the entire site.
 */

// Ensure this file is called by WordPress
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

$deployment_version = get_option('site_version') ?? time();

!defined('DEPLOYMENT_VERSION') ? define('DEPLOYMENT_VERSION', $deployment_version) : "";
<?php
define('DEBUG', true);

if(DEBUG){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

define('VERSION', 'v1.1.0.002');

define("DOMAIN", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/");
include_once "env.php";
define("SITE_URL", DOMAIN.SITE_ROOT);
define("DOC_ROOT", dirname(realpath(__FILE__))."/");
define("PROCESSES_PATH", DOC_ROOT."processes/");

require_once 'vendor/autoload.php';
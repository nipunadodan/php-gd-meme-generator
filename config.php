<?php
define('DEBUG', true);

if(DEBUG){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

define("DOC_ROOT", dirname(realpath(__FILE__))."/");
define("PROCESSES_PATH", DOC_ROOT."processes/");

require_once 'vendor/autoload.php';
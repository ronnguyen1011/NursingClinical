<?php
    // start the session
    session_start();

    // display errors (when needed)
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    // define path constants
    define("PUBLIC_HTML_PATH", dirname(__FILE__));
    define("PHP_PATH", PUBLIC_HTML_PATH . "/NursingClinical/php");
    define("LAYOUTS_PATH", PHP_PATH . "/layouts");

    // define cookie keys
    define("SUBMITTED_SURVEY_KEY", "submitted-survey");

    // provide DB credentials and connect/disconnect functions
    require_once('/home/jbdavidg/db-connect-nursing.php');

    // include all PHP helper functions
    require_once(PHP_PATH . "/helpers.php");
?>
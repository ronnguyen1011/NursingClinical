<?php
    // get access to all PHP helpers
    require_once($_SERVER['DOCUMENT_ROOT'] . "/initial.php");

    // cease the session
    session_unset();
    session_destroy();

    // redirect user to requirements page
    header("location: /NursingClinical/view/requirements.php");
?>
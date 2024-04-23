<?php
    // get access to all PHP helpers
    require_once("/home/jbdavidg/public_html/initial.php");

    // cease the session
    session_unset();
    session_destroy();

    // redirect user to requirements page
    header("location: /NursingClinical/view/requirements.php");
?>
<?php
    // access login credentials
    require_once("/home/nguyenro/db-credentials.php");

    /**
     * Opens and returns a connection to the DB
     * @return mysqli an open connection to the DB
     */
    function connectDB() {
        $database = "nguyenro_nursing";
        
        $dbConnection = mysqli_connect(HOST_NAME, USERNAME, PASSWORD, $database)
                            or die("Error Connecting to DB: " . mysqli_connect_error());
        
        return $dbConnection;
    }

    /**
     * Closes the given DB Connection
     * @param mysqli $dbConnection an open connection to a DB to be closed
     */
    function disconnectDB($dbConnection) {
        if(isset($dbConnection)) {
            mysqli_close($dbConnection);
        }
    }
?>
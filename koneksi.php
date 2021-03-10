<?php

    $DB_HOST = "127.0.0.1";
    $DB_DATABASE = "db_siswa";
    $DB_USERNAME = "root";
    $DB_PASSWORD = "";

    //create connection (new)

    $conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    //check connection
    if ($conn->connect_error) {
        die("Connection Error!".$conn->connect_error);
    }



?>
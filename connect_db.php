<?php

function connect_db($host, $username, $passwd, $port, $db)
{

    $dsn = "mysql:dbname=$db;host=$host;port=$port";

    try {

        $connexion = new PDO($dsn, $username, $passwd);
        if ($connexion) {
            //echo "Connection to DB successful\n";
            return $connexion;
        }

    } catch (PDOException $e) {
        echo "Error connection to DB\n";
        $message = "PDO ERROR:" . $e . " storage in " . ERROR_LOG_FILE . "\n";
        echo $message;
        file_put_contents(ERROR_LOG_FILE, $e);
    }
}
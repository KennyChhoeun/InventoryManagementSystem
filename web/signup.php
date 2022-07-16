<?php
    session_start();
    define('DB_SERVER', 'us-cdbr-east-05.cleardb.net');
    define('DB_USERNAME', 'CREDENTIALS');
    define('DB_PASSWORD', 'CREDENTIALS');
    define('DB_DATABASE', 'CREDENTIALS');
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['username'], $_POST['password']) ) {
	    // Could not get the data that should have been sent.
	    exit('Please fill both the username and password fields to sign up!');
    }

    // sign up logic
    $stmt = $db->prepare('INSERT INTO accounts (username,password,email) VALUES(?, ?, ?)');
    $stmt->bind_param('sss', $_POST['username'], password_hash($_POST['password'],PASSWORD_DEFAULT), $_POST['email']);
    $stmt->execute();
    header('Location: index.html');
    //IT WORKS! omg :O
?>
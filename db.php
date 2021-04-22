<?php

include 'DotEnv.php';

if ( file_exists( __DIR__ . '/.env' ) ) {
    $dotenv = new DotEnv( __DIR__ . '/.env' );
    $dotenv->load();
}

$dbhost = getenv( 'DB_HOST' );
$dbname = getenv( 'DB_NAME' );
$dbuser = getenv( 'DB_USER' );
$dbpass = getenv( 'DB_PASS' );


$con = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname );

if ( mysqli_connect_errno() ) {
    echo "Greška u konekciji na MySQL bazu: " . mysqli_connect_error();
}

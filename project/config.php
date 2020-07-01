<?php

	session_start();
	date_default_timezone_set('GMT');
	$con = new mysqli("localhost", "kerro", "kerro", "kerro");
	if (!$con) {
	    echo "DB ERROR";
	    //echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    exit;
	}
	mysqli_set_charset($con,"utf8");
	$now = new DateTime();
    $mins = $now->getOffset() / 60;
    $sgn = ($mins < 0 ? -1 : 1);
    $mins = abs($mins);
    $hrs = floor($mins / 60);
    $mins -= $hrs * 60;
    $offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
    mysqli_query($con,"SET time_zone='$offset';");

	include 'functions.php';

    $jsfooter="";
?>
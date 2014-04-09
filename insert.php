<?php

include_once("../../config.php");

$user_id = 0;
$session_key = 0;
$course_id = 0;

if (isset($_REQUEST["user_id"]) && trim($_REQUEST["user_id"]) != "" && is_numeric($_REQUEST["user_id"]))								$user_id = $_REQUEST["user_id"];
if (isset($_REQUEST["session_key"]) && trim($_REQUEST["session_key"]) != "")															$session_key = trim($_REQUEST["session_key"]);
if (isset($_REQUEST["course_id"]) && trim($_REQUEST["course_id"]) != "" && is_numeric($_REQUEST["course_id"]))							$course_id = $_REQUEST["course_id"];


if ($user_id != 0 || $session_key != 0 || $course_id != 0)
{
	// Make a database connection
	$mysqli = connect_to_database();
	
	$sql = "INSERT INTO " . $CFG->prefix . "block_phonehome VALUES ('', " . $user_id . ", '" . $session_key . "', " . $course_id . ", " . time() . ")";

	$mysqli->query($sql);

	close_database_connection($mysqli);
}


function connect_to_database()
{
	global $CFG;

	$db_host = $CFG->dbhost;
	$db_user = $CFG->dbuser;
	$db_password = $CFG->dbpass;
	$db_name = $CFG->dbname;

	$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

	/*
	 * This is the "official" OO way to do it,
	 * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
	 */
	if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '
				. $mysqli->connect_error);
	}

	/*
	 * Use this instead of $connect_error if you need to ensure
	 * compatibility with PHP versions prior to 5.2.9 and 5.3.0.
	 */
	if (mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
	}
	
	return $mysqli;
}

function close_database_connection($mysqli)
{
	$mysqli->close();
}

?>
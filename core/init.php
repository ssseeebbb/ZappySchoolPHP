<?php session_start();
//error_reporting(0);

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
if(logged_in() === true){
	$table = 'Parents';
	$session_user_id = $_SESSION['ID'];
	$user_data = user_data($conn, $session_user_id, $table, 'ID', 'NOM_ENFANT', 'PRENOM_ENFANT', 'EMAIL', 'PASSWORD', 'LIEN_PARENTAL');
	if(user_active($conn, $user_data['EMAIL'], $table) === false){
		session_destroy();
		header("Refresh:0; url=mon-espace.php");
		exit();
	}
	
}
$errors = array();


?>
<?php
	include 'core/init.php'; 

	if(empty($_POST) === false){

		$jour		= $_POST['DATE_OUVERTURE'];
		$ouverture 	= $_POST['OUVERTURE_COURS'];
		$fermeture 	= $_POST['FERMETURE_COURS'];
		$table = 'Ouverture';

		if(date_exist($conn, $table, $jour) === true){
			modify_ouverture($conn, $table, $jour, $ouverture, $fermeture);
		} else {
			insert_ouverture($conn, $table, $jour, $ouverture, $fermeture);
		}
		header('Location: mon-espace.php');

	}

?>
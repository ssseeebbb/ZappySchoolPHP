<?php
	include 'core/init.php'; 

	if(empty($_POST) === false){

		for ($day=0; $day<30; $day++){
			$jour		= date("Y-m-d",strtotime('+'.$day.' day'));
			$ouv  = 'OUVERTURE_COURS_'.$day;
			$ferm = 'FERMETURE_COURS_'.$day;
			$ouverture 	= $_POST[$ouv];
			$fermeture 	= $_POST[$ferm];
			$table = 'Ouverture';

			if(date_exist($conn, $table, $jour) === false){
				insert_ouverture($conn, $table, $jour, $ouverture, $fermeture);
			} else {
				
			}
		}
		header('Location: mon-espace.php');

	}

?>
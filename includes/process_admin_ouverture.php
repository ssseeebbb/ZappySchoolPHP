<?php
	include 'core/init.php'; 

	if(empty($_POST) === false){

		for ($day=0;$day<14;$day++){
			$jour		= date("Y-m-d",strtotime('+'.$day.' day') 
			//$ouverture 	= $_POST['OUVERTURE_COURS_'.$day];
			$fermeture 	= $_POST['FERMETURE_COURS_'.$day];
			$table = 'Ouverture';

			if(date_exist($conn, $table, $jour) === true){
				modify_ouverture($conn, $table, $jour, $ouverture, $fermeture);
			} else {
				insert_ouverture($conn, $table, $jour, $ouverture, $fermeture);
			}
		}

	}

?>
<?php  

$table_data = get_table_cours_tot($conn, 'Cours_Profs');
$compteur = 0;
	foreach($table_data as $cours){
		$prix_cours = $cours['A_PAYER'];
		$paiement_a_faire = $cours['PAYE'];


		if($paiement_a_faire < $prix_cours && $compteur == 0){
			echo '<h3>Cours Professeur à régler</h3>';
			echo '<table class="table table-striped">';
			echo '<tr><th>ID</th><th>Prenom</th><th>Nom</th><th>Date</th><th>Durée</th><th>A payer</th><th>Payé</th></tr>';
			$compteur = 1;
		}


		if($paiement_a_faire < $prix_cours){
			$id=$cours['ID'];
	  		$prenom = $cours['PRENOM_PROFESSEUR'];
	  		$nom = $cours['NOM_PROFESSEUR'];
	  		$date = $cours['DATE_HORAIRE'];
	  		$duree = $cours['DUREE'];

	  		echo '<tr><td>'.$id.'</td>';
	  		echo '<td>'.$prenom.'</td>';
	  		echo '<td>'.$nom.'</td>';
	  		echo '<td>'.$date.'</td>';
	  		echo '<td>'.$duree.' heures </td>';
	  		echo '<td>'.$prix_cours.' € </td>';
	  		echo '<td>'.$paiement_a_faire.' € </td></tr>';

  		}

	}
if($compteur == 1){
	echo '</table>';
}

?>

		
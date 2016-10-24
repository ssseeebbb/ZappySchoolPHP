<?php  

$table_data = get_table_cours_tot($conn, 'Cours');
$compteur = 0;
	foreach($table_data as $cours){
		$id = $cours['PARENT_RESERVATION_ID'];
		$prix_cours = $cours['PRIX'];
		$paiement_a_faire = $cours['PAYE'];
		$statut = $cours['STATUT'];

		if($id == $_SESSION['ID'] && $paiement_a_faire < $prix_cours && $statut == 1 && $compteur == 0){
			echo '<h3>Cours à régler</h3>';
			echo '<table class="table table-striped">';
			echo '<tr><th>Prenom</th><th>Nom</th><th>Date</th><th>Durée</th><th>Prix</th><th>Payé</th></tr>';
			$compteur = 1;
		}


		if($id == $_SESSION['ID'] && $paiement_a_faire < $prix_cours && $statut == 1){
	  		$prenom = $cours['PRENOM_ENFANT'];
	  		$nom = $cours['NOM_ENFANT'];
	  		$date = $cours['DATE_HORAIRE'];
	  		$duree = $cours['DUREE'];

	  		echo '<tr><td>'.$prenom.'</td>';
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

		
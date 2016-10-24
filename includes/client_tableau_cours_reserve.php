
		<h3>Cours réservé durant les deux prochaines semaines</h3>
		<table class="table table-striped">

			  <tr>
			    <th >Prenom</th>
			    <th >Nom</th>
			    <th >Matière</th>
			    <th >Date</th>
			    <th >Heure de début</th>
			    <th >Durée</th>
			    <th> Statut </th>
			  </tr>

			  <?php  

				$table_data = get_table_cours($conn, 'Cours');
			  	foreach($table_data as $cours){
			  		$id = $cours['PARENT_RESERVATION_ID'];

			  		if($id == $_SESSION['ID']){

			  		
				  		$prenom = $cours['PRENOM_ENFANT'];
				  		$nom = $cours['NOM_ENFANT'];
				  		$prof = $cours['NOM_PROFESSEUR'];
				  		$date = $cours['DATE_HORAIRE'];
				  		$heure_debut = $cours['HEURE_DEBUT'];
				  		$duree = $cours['DUREE'];
				  		$matiere = $cours['MATIERE'];

				  		if ($cours['STATUT'] == 0){
				  			$statut = 'En attente';
				  		} else if ($cours['STATUT'] == 1){
				  			$statut = 'Confirmé';
				  		}	else if ($cours['STATUT'] == 2){
				  			$statut = 'Cours Impossible';
				  		}
				  		

				  		echo '<tr><td>'.$prenom.'</td>';
				  		echo '<td>'.$nom.'</td>';
				  		echo '<td>'.$matiere.'</td>';
				  		echo '<td>'.$date.'</td>';
				  		echo '<td>'.$heure_debut.' </td>';
				  		echo '<td>'.$duree.' heures </td>';
				  		echo '<td>'.$statut.'</td></tr>';
				  	}

			  	}

			  ?>
		</table>
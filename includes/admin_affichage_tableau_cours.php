<?php
	
	if(empty($_POST) ===false){
		$table_data = get_table_cours($conn, 'Cours');
		foreach($table_data as $cours){
			$id = $cours['ID'];
			$statut=0;

			if (empty($_POST['PROF'.$id.'']) == false){


				if($_POST['PROF'.$id.''] == 'Annule'){
					$statut = 2;
				} else{
					$statut = 1;
				}

				$update_data = array(
					'NOM_PROFESSEUR' 		=> $_POST['PROF'.$id.''],
					'STATUT'				=>$statut,
					);

				update_user($conn, $update_data, $id, 'Cours');
			}


		}
	}

?>



<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Demande de cours !
	</h2>
	<form action="mon-espace.php?tableauCours" method="POST">
		<table class="table table-striped">
			  <tr>
			  	<th> ID </th> 
			    <th >Prenom</th>
			    <th >Nom</th>
			    <th >Matière</th>
			    <th >Professeur</th>
			    <th >Date</th>
			    <th >Début</th>
			    <th >Durée</th>
			  </tr>

			  <?php  
				$table_data = get_table_cours($conn, 'Cours');
			  	foreach($table_data as $cours){


			  		$id = $cours['ID'];
			  		$prenom = $cours['PRENOM_ENFANT'];
			  		$nom = $cours['NOM_ENFANT'];
			  		$prof = $cours['NOM_PROFESSEUR'];
			  		$date = $cours['DATE_HORAIRE'];
			  		$heure_debut = $cours['HEURE_DEBUT'];
			  		$duree = $cours['DUREE'];
			  		$matiere = $cours['MATIERE'];
			  		
			  		echo '<tr><td>'.$id.'</td>';
			  		echo '<td>'.$prenom.'</td>';
			  		echo '<td>'.$nom.'</td>';
			  		echo '<td>'.$matiere.'</td>';

			  		if ($prof == ""){

			  			
				  		echo 	'<td>
						  			<select name="PROF'.$id.'">
										<option disabled selected value> Professeur</option>';
										$data_professeur = get_name_actif_table($conn, 'Professeur');
											foreach($data_professeur as $professeur){
												$nom_professeur = $professeur['NOM'];
												$prenom_professeur = $professeur['PRENOM'];

												$laprof = ''.$prenom_professeur.' '.$nom_professeur.'';

												echo '<option>'.$laprof.'</option>';
											}
						echo 			'<option value="Annule"> Pas de professeur </option>';
						echo 		'</select>
								</td>';
					} else {
						echo '<td>'.$prof.'</td>';
					}

			  		echo '<td>'.$date.'</td>';
			  		echo '<td>'.$heure_debut.' </td>';
			  		echo '<td>'.$duree.' heures </td></tr>';

			  	}

			  ?>
		</table>
		<div class="col-sm-12">
			<div class="text-center">
				<a href="mon-espace.php?supprimerCours" class="btn  btn-bouton-gris  btn-lg">Supprimer une demande</a>
				<a href="mon-espace.php?modifierDureeCours" class="btn  btn-bouton-gris  btn-lg">Changer durée cours</a>
				<a href="mon-espace.php?modifierProfesseurCours" class="btn  btn-bouton-gris  btn-lg">Changer un prof</a>
				<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Mettre à jour les profs</button>
			</div>
		</div>
	</form>




</div>
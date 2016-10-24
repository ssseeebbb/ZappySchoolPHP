<?php
	
	if(empty($_POST) ===false){
		$id = $_POST['ID_COURS'];

		if (empty($_POST['NOM_PROFESSEUR']) == false){


				if($_POST['NOM_PROFESSEUR'] == 'Annule'){
					$statut = 2;
				} else{
					$statut = 1;
				}

				$update_data = array(
					'NOM_PROFESSEUR' 		=> $_POST['NOM_PROFESSEUR'],
					'STATUT'				=>$statut,
					);

				update_user($conn, $update_data, $id, 'Cours');
			}
		$_POST = NULL;
	}


?>



<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Modifier le professeur d'un cours
	</h2>
		<?php include 'includes/admin_tableau_demande_cours.php';?>
		
	<form method="POST" action="mon-espace.php?modifierProfesseurCours">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>
						ID
					</label>
					<select class="form-control" name="ID_COURS" >
						<option disabled selected value> ID du cours</option>
						<?php

							$table_data = get_table_cours($conn, 'Cours');
			  				foreach($table_data as $cours){
								$id=$cours['ID'];
								echo '<option>'.$id.'</option>';
							}
								
							

						?>
					</select>

				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-group">
					<label>
						Professeur
					</label>
					<select class="form-control" name="NOM_PROFESSEUR" >
						<option disabled selected value> Professeur</option>
						<?php

							$data_professeur = get_name_actif_table($conn, 'Professeur');
							foreach($data_professeur as $professeur){
								$nom_professeur = $professeur['NOM'];
								$prenom_professeur = $professeur['PRENOM'];

								$laprof = ''.$prenom_professeur.' '.$nom_professeur.'';

								echo '<option>'.$laprof.'</option>';
							}

						?>
						<option value="Annule"> Pas de professeur </option>
					</select>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="text-center">
					<a href="mon-espace.php?supprimerCours" class="btn  btn-bouton-gris  btn-lg">Supprimer une demande</a>
					<a href="mon-espace.php?modifierDureeCours" class="btn  btn-bouton-gris  btn-lg">Changer durée cours</a>
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Actualiser</button>
				</div>
			</div>
		</div>
	</form>

</div>
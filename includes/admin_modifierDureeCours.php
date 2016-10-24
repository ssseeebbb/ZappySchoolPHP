<?php
	
	if(empty($_POST) ===false){

		$id = $_POST['ID_COURS'];
		$type_cours = get_value($conn, 'Cours', $id, 'TYPE_COURS');

		if($type_cours == 'Groupe'){

			$cout= get_prices($conn, 'Tarification');
			foreach ($cout as $ligne) {
				if($ligne['CATEGORIE'] == 'COURS_GROUPE'){
					$COUT_HORAIRE = $ligne['PRIX'];
				}
			}

		} else if ($type_cours == 'Particulier'){
			$cout= get_prices($conn, 'Tarification');
			foreach ($cout as $ligne) {
				if($ligne['CATEGORIE'] == 'COURS_PARTICULIER'){
					$COUT_HORAIRE = $ligne['PRIX'];
				}
			}

		}


		if (empty($_POST['HEURE_DEBUT_COURS']) === true){

			$DUREE = (((int)  strtok($_POST['DUREE_COURS'], ':'))*60) + (int) substr($_POST['DUREE_COURS'], -2);
			$PRIX = ((int) $DUREE * (int) $COUT_HORAIRE)/60;

			$update_data = array(
			'DUREE' => $_POST['DUREE_COURS'],
			'PRIX' => $PRIX,
			);


		}else if (empty($_POST['DUREE_COURS']) === true){
			$update_data = array(
			'HEURE_DEBUT' => $_POST['HEURE_DEBUT_COURS'],
			);


		} else {

			$DUREE = (((int)  strtok($_POST['DUREE_COURS'], ':'))*60) + (int) substr($_POST['DUREE_COURS'], -2);
			$PRIX = ((int) $DUREE * (int) $COUT_HORAIRE)/60;

			$update_data = array(
			'HEURE_DEBUT' => $_POST['HEURE_DEBUT_COURS'],
			'DUREE' => $_POST['DUREE_COURS'],
			'PRIX' => $PRIX,
			);

		}
		
		update_user($conn, $update_data, $id, 'Cours');
		$_POST = NULL;
	}


?>



<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Modifier l'horaire d'un cours
	</h2>
		<?php include 'includes/admin_tableau_demande_cours.php';?>
		
	<form method="POST" action="mon-espace.php?modifierDureeCours">
		<div class="row">
			<div class="col-sm-2">
				<div class="form-group">
					<label>
						ID
					</label>
					<select class="form-control" name="ID_COURS" >
						<option disabled selected value> ID du cours</option>
						<?php

							$table_data = get_table_cours($conn, 'Cours');
			  				foreach($table_data as $cours){
								$id = $cours['ID'];
								echo '<option>'.$id.'</option>';	
							}
								
							

						?>
					</select>

				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<label>
						Heure de début
					</label>
					<select class="form-control" name="HEURE_DEBUT_COURS" >
						<option disabled selected value> Heure de début</option>
						<?php
							for($i = 8 ; $i<19; $i++){
								for($j=0; $j<60; $j+=15){
									if($j == 0){
										$j = '00';
									}


								echo '<option>'.$i.':'.$j.'</option>';
								
								}
							}

						?>
					</select>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<label>
						Durée
					</label>
					<select class="form-control" name="DUREE_COURS" >
						<option disabled selected value> Durée</option>
						<?php
							for($i = 1 ; $i<9; $i++){
								for($j=0; $j<60; $j+=15){
									if($j == 0){
										$j = '00';
									}
								echo '<option>'.$i.':'.$j.'</option>';
								
								}
							}
						?>
					</select>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="text-center">
					<a href="mon-espace.php?supprimerCours" class="btn  btn-bouton-gris  btn-lg">Supprimer une demande</a>
					<a href="mon-espace.php?modifierProfesseurCours" class="btn  btn-bouton-gris  btn-lg">Changer un prof</a>
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Actualiser</button>
				</div>
			</div>
		</div>
	</form>

</div>
<?php
	$table = 'Cours';
	$where = '';
	if(empty($_POST) ===false){
		
		$filtres = array(); 

		foreach ($_POST as $key => $value) {

			if(empty($value) == false){
				if($key == 'DATE_MIN'){
					$filtres[]= 'DATE_HORAIRE>=\''.$value.'\'';
				}

				if($key == 'DATE_MAX'){
					$filtres[]= 'DATE_HORAIRE<=\''.$value.'\'';
				}

				if($key == 'NOM_ENFANT'){
					$enfant_array = explode(" ", $value);
					$NOM_ENFANT = $enfant_array[1];
					$PRENOM_ENFANT =$enfant_array[0];

					$filtres[]= 'NOM_ENFANT=\''.$NOM_ENFANT.'\' AND PRENOM_ENFANT=\''.$PRENOM_ENFANT.'\'';
				}

				if($key == 'MATIERE'){
					$filtres[]= 'MATIERE=\''.$value.'\'';
				}

				if($key == 'ANNEE_SCOLAIRE'){
					$filtres[]= 'ANNEE_ETUDE=\''.$value.'\'';
				}

				if($key == 'ECOLE'){
					$filtres[]= 'ECOLE=\''.$value.'\'';
				}

				if($key == 'TYPE_COURS'){
					$filtres[]= 'TYPE_COURS=\''.$value.'\'';
				}

				if($key == 'PAIEMENT'){
					$filtres[]= 'PAIEMENT=\''.$value.'\'';
				}
			}
		}
		if(count($filtres) !== 0){

			$debut_where='WHERE';
			$data  = implode(' AND ', $filtres);

			$where = ''.$debut_where.' '.$data.'';
			$_POST = NULL;
		}

	}
?>


<div class="col-sm-8">
<h3> Filter la table des cours </h3>

	<form method="POST" action="mon-espace.php?resumecours">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Date début (YYYY-MM-DD)
					</label>
					<input class="form-control" type="text" name="DATE_MIN" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Date fin (YYYY-MM-DD)
					</label>
					<input class="form-control" name="DATE_MAX" />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Enfant
					</label>
					<select class="form-control" name="NOM_ENFANT" >
						<option disabled selected value> Nom de l'enfant</option>
						<?php 
							$champ1 = 'NOM_ENFANT';
							$champ2 = 'PRENOM_ENFANT';
							$data= get_name_table_cours($conn, $table);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								$enfant = ''.$value[$champ2].' '.$value[$champ1].'';
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $enfant){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									$liste_elem[] = $enfant;
									echo '<option>'.$enfant.'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Matière
					</label>
					<select class="form-control" name="MATIERE" >
						<option disabled selected value> Matière</option>
						<?php 
							$champ ='MATIERE';
							$data= get_values($conn, $table , $champ);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $value[$champ]){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									$liste_elem[] = $value[$champ];
									echo '<option>'.$value[$champ].'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Année scolaire
					</label>
					<select class="form-control" name="ANNEE_SCOLAIRE" >
						<option disabled selected value> Année scolaire</option>
						<?php 
							$champ ='ANNEE_ETUDE';
							$data= get_values($conn, $table , $champ);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $value[$champ]){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									$liste_elem[] = $value[$champ];
									echo '<option>'.$value[$champ].'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Ecole
					</label>
					<select class="form-control" name="ECOLE" >
						<option disabled selected value> Ecole</option>
						<?php 
							$champ = 'ECOLE';
							$data= get_values($conn, $table , $champ);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $value[$champ]){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									$liste_elem[] = $value[$champ];
									echo '<option>'.$value[$champ].'</option>';
								}
							}
						?>

					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Type de cours
					</label>
					<select class="form-control" name="TYPE_COURS" >
						<option disabled selected value> Type de cours</option>
						<?php 
							$champ ='TYPE_COURS';
							$data= get_values($conn, $table , $champ);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $value[$champ]){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									$liste_elem[] = $value[$champ];
									echo '<option>'.$value[$champ].'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Type de paiement
					</label>
					<select class="form-control" name="PAIEMENT" >
						<option disabled selected value> Type de paiement</option>
						<?php 
							$champ ='PAIEMENT';
							$data= get_values($conn, $table , $champ);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $value[$champ]){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									$liste_elem[] = $value[$champ];
									echo '<option>'.$value[$champ].'</option>';
								}
							}
						?>
					</select>
				</div>
			</div>
			

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Actualiser</button>
				</div>
			</div>
		</div>
	</form>


	<h3> Statistiques </h3>
	<?php 
	$duree_totale = 0;
	(float) $montant_total = 0;
	$table='Cours';
	$orderby ='ORDER BY DATE_HORAIRE ASC';
	$table_data = get_filter_table($conn, $table, $where, $orderby);

	foreach($table_data as $cours){
		
		$duree_brut = $cours['DUREE'];
		$duree_minutes = (((int)  strtok($duree_brut, ':'))*60) + (int) substr($duree_brut, -2);
		$duree_totale = $duree_totale + $duree_minutes;


		$montant_total = (float) $montant_total + (float) $cours['PRIX'];


	}



	if ($where !== ''){
		echo '<h4> Filtres : '.$where.'</h4>';
	} else{
		echo '<h4> Aucun Filtre </h4>';
	}
	?>
		<div class="col-sm-3">
			<div class="form-group">
				<label>
					Nombre de cours
				</label>
				<p class="form-control">
					<?php echo count($table_data);?>	
				</p>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>
					Nombre d'heures
				</label>
				<p class="form-control">
					<?php 


						/*echo $duree_totale;*/
						echo convertToHoursMins($duree_totale, '%02d heures %02d minutes');

					?>
				</p>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>
					Montant total
				</label>
				<p class="form-control">
					<?php echo $montant_total;?>
				</p>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<label>
					€/h
				</label>
				<p class="form-control">
					<?php 

					echo round(($montant_total/((float) $duree_totale/60)), 2);

					?>
						
				</p>
			</div>
		</div>

	<?php  
		
		$compteur = 0;
			foreach($table_data as $cours){
				$prix_cours = $cours['PRIX'];
				$paiement_a_faire = $cours['PAYE'];
				$statut = $cours['STATUT'];

				if($statut == 1 && $compteur == 0){
					echo '<h3>Historique des cours</h3>';
					echo '<table class="table table-striped">';
					echo '<tr><th>ID</th>';
					echo '<th>Prenom</th>';
					echo '<th>Nom</th>';
					echo '<th>Date</th>';
					echo '<th>Durée</th>';
					echo '<th>Prix</th>';
					echo '<th>Reçu</th>';
					echo '<th>Paiement</th></tr>';
					$compteur = 1;
				}


				if($statut == 1){
					$id=$cours['ID'];
			  		$prenom = $cours['PRENOM_ENFANT'];
			  		$nom = $cours['NOM_ENFANT'];
			  		$date = $cours['DATE_HORAIRE'];
			  		$duree = $cours['DUREE'];
			  		$type_paiement = $cours['PAIEMENT'];

			  		echo '<tr><td>'.$id.'</td>';
			  		echo '<td>'.$prenom.'</td>';
			  		echo '<td>'.$nom.'</td>';
			  		echo '<td>'.$date.'</td>';
			  		echo '<td>'.$duree.' </td>';
			  		echo '<td>'.$prix_cours.' € </td>';
			  		echo '<td>'.$paiement_a_faire.' € </td>';
			  		echo '<td>'.$type_paiement.' </td></tr>';

		  		}

			}
		if($compteur == 1){
			echo '</table>';
		}

	?>



</div>
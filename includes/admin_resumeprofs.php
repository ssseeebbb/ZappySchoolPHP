<?php
	$table = 'Cours_Profs';
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

				if($key == 'NOM_PROFESSEUR'){
					$enfant_array = explode(" ", $value);
					$NOM_ENFANT = $enfant_array[1];
					$PRENOM_ENFANT =$enfant_array[0];

					$filtres[]= 'NOM_PROFESSEUR=\''.$NOM_ENFANT.'\' AND PRENOM_PROFESSEUR=\''.$PRENOM_ENFANT.'\'';
				}

				if($key == 'MATIERE'){
					$filtres[]= 'MATIERE=\''.$value.'\'';
				}

				if($key == 'TYPE_COURS'){
					$filtres[]= 'TYPE_COURS=\''.$value.'\'';
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
<h3> Filter la table des cours professeurs </h3>

	<form method="POST" action="mon-espace.php?resumeprof">
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
						Professeur
					</label>
					<select class="form-control" name="NOM_PROFESSEUR" >
						<option disabled selected value> Nom du professeur</option>
						<?php 
							$champ1 = 'NOM_PROFESSEUR';
							$champ2 = 'PRENOM_PROFESSEUR';
							$table_cours_profs = 'Cours_Profs'; 
							$data= get_name_table_cours_prof($conn, $table_cours_profs);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								$prof = ''.$value[$champ2].' '.$value[$champ1].'';
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $prof){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									$liste_elem[] = $prof;
									echo '<option>'.$prof.'</option>';
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
			

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Actualiser</button>
				</div>
			</div>
		</div>
	</form>


<h3> Statistiques </h3>
	<?php 

	$compteur = 0;
	$orderby = 'ORDER BY DATE_HORAIRE ASC';
	$table = 'Cours_Profs';

	$table_data = get_filter_table($conn, $table, $where, $orderby);

	$duree_totale = 0;
	(float) $montant_total = 0;

	foreach($table_data as $cours){
		
		$duree_brut = $cours['DUREE'];
		$duree_minutes = (((int)  strtok($duree_brut, ':'))*60) + (int) substr($duree_brut, -2);
		$duree_totale = $duree_totale + $duree_minutes;


		$montant_total = (float) $montant_total + (float) $cours['A_PAYER'];


	}



	if ($where !== ''){
		echo '<h4> Filtres : '.$where.'</h4>';
	} else{
		echo '<h4> Aucun Filtre </h4>';
	}
	?> 
		<div class="col-sm-4">
			<div class="form-group">
				<label>
					Nombre de cours
				</label>
				<p class="form-control">
					<?php echo count($table_data);?>	
				</p>
			</div>
		</div>
		<div class="col-sm-4">
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
		<div class="col-sm-4">
			<div class="form-group">
				<label>
					Montant total
				</label>
				<p class="form-control">
					<?php 


						/*echo $duree_totale;*/
						echo $montant_total.' €';

					?>
				</p>
			</div>
		</div>

	<?php 
				
				foreach($table_data as $cours){

					if($compteur == 0){
						echo '<h3>Historique des cours</h3>';
						echo '<table class="table table-striped">';
					  	echo '<tr>';
					  	echo '<th> ID </th>';
					    echo '<th >Prenom</th>';
					    echo '<th >Nom</th>';
					    echo '<th >Matière</th>';
					    echo '<th >Date</th>';
					    echo '<th >Heure début</th>';
					    echo '<th >Durée</th>';
					    echo '<th> Type</th>';
					    echo '<th> A payer </th>';
					    echo '</tr>';
					    $compteur = 1;
					}

			  		$id = $cours['ID'];
			  		$prenom = $cours['PRENOM_PROFESSEUR'];
			  		$nom = $cours['NOM_PROFESSEUR'];
			  		$date = $cours['DATE_HORAIRE'];
			  		$heure_debut = $cours['HEURE_DEBUT'];
			  		$duree = $cours['DUREE'];
			  		$matiere = $cours['MATIERE'];
			  		$type_cours = $cours['TYPE_COURS'];
			  		$apayer = $cours['A_PAYER'];
			  		
			  		echo '<tr><td>'.$id.'</td>';
			  		echo '<td>'.$prenom.'</td>';
			  		echo '<td>'.$nom.'</td>';
			  		echo '<td>'.$matiere.'</td>';
			  		echo '<td>'.$date.'</td>';
			  		echo '<td>'.$heure_debut.' </td>';
			  		echo '<td>'.$duree.' heures </td>';
			  		echo '<td>'.$type_cours.' </td>';
			  		echo '<td>'.$apayer.' </td></tr>';
			  	}

			  	if($compteur == 1){		
					echo '</table>';
				}
	?>



</div>
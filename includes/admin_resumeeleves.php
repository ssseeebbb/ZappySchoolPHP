<?php
	$table = 'Enfants';
	$where = '';
	if(empty($_POST) ===false){
		
		$filtres = array(); 

		foreach ($_POST as $key => $value) {

			if(empty($value) == false){

				if($key == 'NOM_ENFANT'){
					$enfant_array = explode(" ", $value);
					$NOM_ENFANT = $enfant_array[1];
					$PRENOM_ENFANT =$enfant_array[0];

					$filtres[]= 'NOM=\''.$NOM_ENFANT.'\' AND PRENOM=\''.$PRENOM_ENFANT.'\'';
				}

				if($key == 'POSTAL'){
					$filtres[]= 'POSTAL=\''.$value.'\'';
				}

				if($key == 'AGE'){
					$date_min = date("Y-m-d", strtotime('-'.$value.' year')); 
					$date_max = date("Y-m-d", strtotime('-'.((int)$value+1).' year'));

					$filtres[]= 'NAISSANCE <= \''.$date_min.'\' AND NAISSANCE > \''.$date_max.'\'';
				}

				if($key == 'ANNEE_SCOLAIRE'){
					$filtres[]= 'ANNEE_ETUDE=\''.$value.'\'';
				}

				if($key == 'ECOLE'){
					$filtres[]= 'ECOLE=\''.$value.'\'';
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
<h3> Filter la table des enfants inscrits </h3>

	<form method="POST" action="mon-espace.php?resumeeleves">
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Enfant
					</label>
					<select class="form-control" name="NOM_ENFANT" >
						<option disabled selected value> Nom de l'enfant</option>
						<?php 
							$table = 'Enfants';
							$champ1 = 'NOM';
							$champ2 = 'PRENOM';

							$data= get_name_table($conn, $table);
							foreach ($data as $value) {
								$enfant = ''.$value[$champ2].' '.$value[$champ1].'';
								echo '<option>'.$enfant.'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Code Postal
					</label>
					<select class="form-control" name="POSTAL" >
						<option disabled selected value> Année scolaire</option>
						<?php 
							$champ ='POSTAL';
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
						Age
					</label>
					<select class="form-control" name="AGE" >
						<option disabled selected value> Age</option>
						<?php 
							$champ ='NAISSANCE';
							$data= get_values($conn, $table , $champ);
							$liste_elem = array();
							foreach ($data as $value) {
								$compteur=0;
								$birthDate = explode("-", $value[$champ]);
								$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1): (date("Y") - $birthDate[0]));
								foreach ($liste_elem as $key => $valueSelect) {
									if($valueSelect == $age){
										$compteur = 1;
									}
								}
								if ($compteur==0){
									
									$liste_elem[] = (int) $age;
								}
							}
							sort($liste_elem);

							for($i=0; $i<count($liste_elem) ; $i++){
								echo '<option> '.$liste_elem[$i].' </option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
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
								}
							}
							sort($liste_elem);
							for($i=0; $i<count($liste_elem) ; $i++){
								echo '<option>'.$liste_elem[$i].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
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
								}
							}
							sort($liste_elem);
							for($i=0; $i<count($liste_elem) ; $i++){
								echo '<option>'.$liste_elem[$i].'</option>';
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
	$orderby ='';
	$table='Enfants';
	$table_data = get_filter_table($conn, $table, $where, $orderby);

	if ($where !== ''){
		echo '<h4> Filtres : '.$where.'</h4>';
	} else{
		echo '<h4> Aucun Filtre </h4>';
	}
	?>
		<div class="col-sm-12">
			<div class="form-group">
				<label>
					Nombre d'élèves
				</label>
				<p class="form-control">
					<?php echo count($table_data);?>	
				</p>
			</div>
		</div>

	<?php  
		
		$compteur = 0;
			foreach($table_data as $cours){

				if($compteur == 0){
					echo '<h3>Historique des cours</h3>';
					echo '<table class="table table-striped">';
					echo '<tr><th>ID</th>';
					echo '<th>Prenom</th>';
					echo '<th>Nom</th>';
					echo '<th>Age</th>';
					echo '<th>Ecole</th>';
					echo '<th>Année</th>';
					echo '<th>Ville</th>';
					echo '<th>E-mail</th>';
					echo '<th>Telephone</th></tr>';
					$compteur = 1;
				}



					$id=$cours['ID'];
			  		$prenom = $cours['PRENOM'];
			  		$nom = $cours['NOM'];
			  		$birth = $cours['NAISSANCE'];
			  		$ecole = $cours['ECOLE'];
			  		$annee = $cours['ANNEE_ETUDE'];
			  		$ville = $cours['VILLE'];
			  		$tel = $cours['TELEPHONE_PARENT'];
			  		$mail = $cours['MAIL_PARENT'];


			  		$birthDate = explode("-", $birth);
					  //get age from date or birthdate
					$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y") - $birthDate[0]) - 1): (date("Y") - $birthDate[0]));


			  		echo '<tr><td>'.$id.'</td>';
			  		echo '<td>'.$prenom.'</td>';
			  		echo '<td>'.$nom.'</td>';
			  		echo '<td>'.$age.'</td>';
			  		echo '<td>'.$ecole.' </td>';
			  		echo '<td>'.$annee.' </td>';
			  		echo '<td>'.$ville.' </td>';
			  		echo '<td>'.$mail.' </td>';
			  		echo '<td>'.$tel.'  </td></tr>';

		  

			}
		if($compteur == 1){
			echo '</table>';
		}

	?>



</div>
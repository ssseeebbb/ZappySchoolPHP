
<script type="text/javascript">

	function changeHeure(s1, s2, s3){
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);
		var s3 = document.getElementById(s3);
		s3.innerHTML = "";

		<?php
			$table_data = get_table($conn, 'Ouverture');
			foreach($table_data as $day){
				$date = date("d-m-Y", strtotime($day['DATE_HORAIRE']));
				$ouv = $day['HEURE_DEBUT'];
	  			$ferm = $day['HEURE_FIN'];
		  		$heure_ouv = (int) strtok($ferm, ':') - (int) strtok($ouv, ':');
		  		if ($heure_ouv > 0){
			  		$listHeure = array();
		  			for($j=0; $j<$heure_ouv; $j++){
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':00';
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':15';
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':30';
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':45';
		  			} 
		  			array_pop($listHeure);
		  			array_pop($listHeure);
		  			array_pop($listHeure);
		  		foreach ($listHeure as $heureCommencement) {

		  			$listeDuree = array();
		  			$min_tot_ouv_cours = ((int) strtok($ferm, ':') - (int) strtok($heureCommencement, ':'))*60 + ((int) substr($ferm, -2) - (int) substr($heureCommencement, -2));
		  			$heure_ouv_cours = ($min_tot_ouv_cours -($min_tot_ouv_cours%60))/60;
		  			$min_ouv_cours = $min_tot_ouv_cours%60;
		  			for($j=1; $j<=$heure_ouv_cours; $j++){
		  				$listeDuree[]= $j .':00|'.$j.':00';
		  				$listeDuree[]= $j .':15|'.$j.':15';
		  				$listeDuree[]= $j .':30|'.$j.':30';
		  				$listeDuree[]= $j .':45|'.$j.':45';
		  			}
		  			for($m = 0 ; $m < $min_ouv_cours; $m+=15){
		  				$listeDuree[]= $heure_ouv_cours .':'.$m.'|'.$heure_ouv_cours.':'.$m.'';
		  			}

		  			array_pop($listeDuree);
		  			array_pop($listeDuree);
		  			array_pop($listeDuree);
		  			$optionLine = implode(' ", " ',$listeDuree);

		  			echo '
		  				var optionArray = [];
				  		if( s1.value == 
				  			"'.$date.'" 

				  			&&

				  			s2.value ==
				  			"'.$heureCommencement.'"
				  			){
							var optionArray = ["|", "'.$optionLine.'"];
						}
						for(var option in optionArray){
							var pair = optionArray[option].split("|");
							var newOption = document.createElement("option");
							
							newOption.innerHTML = pair[1];
							s3.options.add(newOption);
						}

				  		';

			  		} 		
				}
		  	}
		?>
	}



	
	function populate(s1, s2){
		var s1 = document.getElementById(s1);
		var s2 = document.getElementById(s2);
		s2.innerHTML = ""; //on nettoie la liste select

		<?php
			$table_data = get_table($conn, 'Ouverture');
			foreach($table_data as $day){
				$date = date("d-m-Y", strtotime($day['DATE_HORAIRE']));
				$ouv = $day['HEURE_DEBUT'];
		  		$ferm = $day['HEURE_FIN'];
		  		$heure_ouv = (int) strtok($ferm, ':') - (int) strtok($ouv, ':');
		  		if ($heure_ouv > 0){
		  			$listHeure = array();
		  			for($j=0; $j<$heure_ouv; $j++){
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':00|'.((int) strtok($ouv, ':')+$j).':00';
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':15|'.((int) strtok($ouv, ':')+$j).':15';
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':30|'.((int) strtok($ouv, ':')+$j).':30';
		  				$listHeure[]=((int) strtok($ouv, ':')+$j).':45|'.((int) strtok($ouv, ':')+$j).':45';
		  			} 
		  			array_pop($listHeure);
		  			array_pop($listHeure);
		  			array_pop($listHeure);
		  			$optionLine = implode(' ", " ',$listHeure);

					echo '
					var optionArray =[];

					if(s1.value ==

					"'.$date.'"

					){
						var optionArray = ["|", "'.$optionLine.'"];
					}
					for(var option in optionArray){
						var pair = optionArray[option].split("|");
						var newOption = document.createElement("option");
						
						newOption.innerHTML = pair[1];
						s2.options.add(newOption);
					}';
				}
			}
		?>

	}

</script>





<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Réservez votre cours !
	</h2>
	<?php
	if((empty($errors) === false)){
			echo output_errors($errors);
		}
	?>
		
	<form method="POST" action="process_reservationCoursAdmin.php">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Prénom de l'enfant :
					</label>
					<input class="form-control" name="PRENOM_ENFANT">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Nom de l'enfant :
					</label>
					<input class="form-control" name="NOM_ENFANT">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Date du cours :
					</label>
					<select id="dateCours" class="form-control" name="DATE_COURS" onchange="populate(this.id, 'debutCours')">
						<option disabled selected value> Date du cours</option>

						<?php 
							$table_data = get_table($conn, 'Ouverture');
							foreach($table_data as $day){
		  						$daydate = date("l", strtotime($day['DATE_HORAIRE']));
						  		$date = date("d-m-Y", strtotime($day['DATE_HORAIRE']));
						  		$ouv = $day['HEURE_DEBUT'];
						  		$ferm = $day['HEURE_FIN'];
						  		$heure_ouv = (int) strtok($ferm, ':') - (int) strtok($ouv, ':');


						  		if ($heure_ouv > 0){
						  			echo '<option>'.$date.'</option>';
						  		}
						  	}
						?>

					</select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Heure de début :
					</label>
					<select id="debutCours" class="form-control" name="HEURE_DEBUT" onchange="changeHeure('dateCours', 'debutCours', 'dureeCoursHeure')"></select>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Durée :
					</label>
					<select id="dureeCoursHeure" class="form-control" name="DUREE_HEURE"></select>
				</div>
			</div>
			
			<div class="col-sm-3">
				<div class="form-group">
					<label>
						Matière à voir :
					</label>
					<select class="form-control" name="MATIERE">
						<option disabled selected value> Matière</option>
						<option>Mathématique</option>
						<option>Sciences</option>
						<option>Anglais / Néerlandais</option>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>
						Type de cours:
					</label>
					<select class="form-control" name="TYPE_COURS">
						<option disabled selected value> Type du cours</option>
						<option>Particulier</option>
						<option>Groupe</option>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>
						École
					</label>
					<input class="form-control" name="ECOLE">
				</div>
			</div>
			<div class="col-sm-3">
							<div class="form-group">
								<label>
									Année d'étude
								</label>
								<!-- <input class="form-control" name="ANNEE_ETUDE" /> -->
								<select class="form-control" name="ANNEE_ETUDE">
								  <option>1ère secondaire</option>
								  <option>2ème secondaire</option>
								  <option>3ème secondaire</option>
								  <option>4ème secondaire</option>
								  <option>5ème secondaire</option>
								  <option>6ème secondaire</option>
								</select>
							</div>
						</div>
			
			<div class="col-sm-12">
				<button class="bloc-button btn   btn-lg btn-bouton-gris" type="submit">
					<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Réserver le cours
				</button>
			</div>
		</div>
	</form>
</div>
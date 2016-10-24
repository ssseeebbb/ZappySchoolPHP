<?php

$session_user_id = $_SESSION['ID'];
$user_data_parent = user_data($conn, $session_user_id, 'Parents',  'ID', 'ADRESSE', 'POSTAL', 'VILLE', 'TELEPHONE', 'NOM_ENFANT', 'PRENOM_ENFANT', 'EMAIL', 'PASSWORD', 'LIEN_PARENTAL', 'NOM_ENFANT_2', 'PRENOM_ENFANT_2', 'NOM_ENFANT_3', 'PRENOM_ENFANT_3', 'NOM_ENFANT_4', 'PRENOM_ENFANT_4');



?>

<div class="col-sm-8">
	<div class="row">
		<form action="process_modification_infos.php" method="POST" >
			<h1 class="mg-md text-center">
				Modifier des informations
			</h1>

			<?php
				if((empty($errors) === false)){
					echo output_errors($errors);
				}
			?>
			<h2> Moi, Parent </h2>
			<div class="form-group">
				<label>
					Email
				</label>
				<input class="form-control" type="text" name="EMAIL_PARENT" value = '<?php echo $user_data_parent['EMAIL'];?>' />
			</div>
			<div class="form-group">
				<label>
					Téléphone
				</label>
				<input class="form-control" type="text" name="TELEPHONE_PARENT" value = '<?php echo $user_data_parent['TELEPHONE'];?>' />
			</div>
			<div class="form-group">
				<label>
					Rue et numéro
				</label>
				<input class="form-control" name="ADRESSE_PARENT" value = '<?php echo $user_data_parent['ADRESSE'];?>' />
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>
							Code Postal
						</label>
						<input class="form-control" name="POSTAL_PARENT"  value = '<?php echo $user_data_parent['POSTAL'];?>' />
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>
							Ville
						</label>
						<input class="form-control" name="VILLE_PARENT" value = '<?php echo $user_data_parent['VILLE'];?>' />
					</div>
				</div>
			</div>

			<h2> Mon Enfant : <?php echo ''.$user_data_parent['PRENOM_ENFANT'].' '.$user_data_parent['NOM_ENFANT'].''; ?> </h2>
			<?php 

			$child = child_data($conn, 'Enfants' , $user_data_parent['NOM_ENFANT'], $user_data_parent['PRENOM_ENFANT']);

			?>
			<div class="form-group">
				<label>
					Rue et numéro
				</label>
				<input class="form-control" type="text" name="ADRESSE_ENFANT_1" value = '<?php echo $child['ADRESSE'];?>'/>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>
							Code Postal
						</label>
						<input class="form-control" name="POSTAL_ENFANT_1" value = '<?php echo $child['POSTAL'];?>' />
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>
							Ville
						</label>
						<input class="form-control" name="VILLE_ENFANT_1" value = '<?php echo $child['VILLE'];?>' />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label>
							Ecole fréquentée
						</label>
						<input class="form-control" name="ECOLE_ENFANT_1"  value = '<?php echo $child['ECOLE'];?>' />
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label>
							Année d'étude
						</label>
						<!-- <input class="form-control" name="ANNEE_ETUDE" /> -->
						<select class="form-control" name="ANNEE_ETUDE_1">
						  <option <?php if ($child['ANNEE_ETUDE'] == "1ère secondaire") echo "selected='selected'";?> > 1ère secondaire</option>
						  <option <?php if ($child['ANNEE_ETUDE'] == "2ème secondaire") echo "selected='selected'";?> > 2ème secondaire</option>
						  <option <?php if ($child['ANNEE_ETUDE'] == "3ème secondaire") echo "selected='selected'";?> > 3ème secondaire</option>
						  <option <?php if ($child['ANNEE_ETUDE'] == "4ème secondaire") echo "selected='selected'";?> > 4ème secondaire</option>
						  <option <?php if ($child['ANNEE_ETUDE'] == "5ème secondaire") echo "selected='selected'";?> > 5ème secondaire</option>
						  <option <?php if ($child['ANNEE_ETUDE'] == "6ème secondaire") echo "selected='selected'";?> > 6ème secondaire</option>
						</select>
					</div>
				</div>
			</div>

			<?php 
			$table_parents = 'Parents';
			$id = $_SESSION['ID'];
			if (nombre_enfant_inscrit($conn, $id, $table_parents) > 1){ 
				for($i=2 ; $i<=nombre_enfant_inscrit($conn, $id, $table_parents); $i++){

					$child = child_data($conn, 'Enfants' , $user_data_parent['NOM_ENFANT_'.$i.''], $user_data_parent['PRENOM_ENFANT_'.$i.'']);

					echo '<h2> Mon Enfant : '.$user_data_parent['PRENOM_ENFANT_'.$i.''].' '.$user_data_parent['NOM_ENFANT_'.$i.''].' </h2>
							<div class="form-group">
								<label>
									Rue et numéro
								</label>
								<input class="form-control" type="text" name="ADRESSE_ENFANT_'.$i.'" value="'.$child['ADRESSE'].'" />
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>
											Code Postal
										</label>
										<input class="form-control" name="POSTAL_ENFANT_'.$i.'" value="'.$child['POSTAL'].'"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>
											Ville
										</label>
										<input class="form-control" name="VILLE_ENFANT_'.$i.'" value="'.$child['VILLE'].'"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>
											Ecole fréquentée
										</label>
										<input class="form-control" name="ECOLE_ENFANT_'.$i.'" value="'.$child['ECOLE'].'" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>
											Année d\'étude
										</label>
										<select class="form-control" name="ANNEE_ETUDE_'.$i.'">
										  <option ';
										if ($child['ANNEE_ETUDE'] == "1ère secondaire"){
											echo "selected='selected'";
										}
										
										echo '> 1ère secondaire</option> <option ';

										if ($child['ANNEE_ETUDE'] == "2ème secondaire"){
											echo "selected='selected'"; 
										}

										echo '> 2ème secondaire</option> <option ';

										if ($child['ANNEE_ETUDE'] == "3ème secondaire"){ 
											echo "selected='selected'";
										}

										echo '> 3ème secondaire</option> <option '; 

										if ($child['ANNEE_ETUDE'] == "4ème secondaire"){
											echo "selected='selected'"; 
										}

										echo '> 4ème secondaire</option> <option ';

										if ($child['ANNEE_ETUDE'] == "5ème secondaire"){ 
											echo "selected='selected'";
										}

										echo '> 5ème secondaire</option> <option ';

										if ($child['ANNEE_ETUDE'] == "6ème secondaire"){ 
											echo "selected='selected'";
										}

										echo '> 6ème secondaire</option> ';

										echo '</select>
									</div>
								</div>
							</div>';
				}

			}
		?>




			<div class="text-center">
				<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
					<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Modifier mes infos
				</button>
			</div>
		</form>


	</div>
</div>


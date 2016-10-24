<?php
	
	if(empty($_POST) ===false){
		$data_professeur = get_name_table($conn, 'Professeur');
		$id= $_POST['ID_PROFESSEUR'];

		$update_data = array(
			'ACTIF' => $_POST['ETAT_PROF'],
			);
		update_user($conn, $update_data, $id, 'Professeur');
		$_POST = NULL;
	}


?>



<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Modifier l'état d'un professeur
	</h2>

	<table class="table table-striped">
			  <tr>
			    <th >Prenom</th>
			    <th >Nom</th>
			    <th >Telephone</th>
			    <th >E-mail</th>
			    <th >Matière 1</th>
			    <th >Matière 2</th>
			    <th >Matière 3</th>
			    <th >Actif </th> 
			  </tr>

			  <?php  
				$table_data = get_prof_table($conn, 'Professeur');
			  	foreach($table_data as $prof){


			  		$prenom = $prof['PRENOM'];
			  		$nom = $prof['NOM'];
			  		$telephone = $prof['TELEPHONE_PROF'];
			  		$email = $prof['EMAIL'];
			  		$mat1 = $prof['MATIERE_PROF_1'];
			  		$mat2 = $prof['MATIERE_PROF_2'];
			  		$mat3 = $prof['MATIERE_PROF_3'];
			  		$actif = $prof['ACTIF'];
			  		
			  		echo '<tr><td>'.$prenom.'</td>';
			  		echo '<td>'.$nom.'</td>';
			  		echo '<td>'.$telephone.'</td>';
			  		echo '<td>'.$email.'</td>';
					echo '<td>'.$mat1.'</td>';
			  		echo '<td>'.$mat2.'</td>';
			  		echo '<td>'.$mat3.' </td>';
			  		echo '<td>'.$actif.' </td></tr>';

			  	}

			  ?>
		</table>




	<form method="POST" action="mon-espace.php?activationProf">
		<div class="row">
			<div class="col-sm-7">
				<div class="form-group">
					<label>
						Professeur
					</label>
					<select class="form-control" name="ID_PROFESSEUR" >
						<option disabled selected value> Professeur</option>
						<?php

							$data_professeur = get_name_table($conn, 'Professeur');
							foreach($data_professeur as $professeur){
								$id=	$professeur['ID']; 
								$nom_professeur = $professeur['NOM'];
								$prenom_professeur = $professeur['PRENOM'];

								$laprof = ''.$prenom_professeur.' '.$nom_professeur.'';

								echo '<option value ='.$id.'>'.$laprof.'</option>';
							}

						?>
					</select>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<label>
						Etat du professeur
					</label>
					<select class="form-control" name="ETAT_PROF" >
						<option disabled selected value> Etat</option>
						<option value="0">Desactiver</option>
						<option value="1">Activer</option>
					</select>

				</div>
			</div>

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Mettre à jour</button>
				</div>
			</div>
		</div>
	</form>

</div>
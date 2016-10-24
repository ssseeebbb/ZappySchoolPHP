<?php
	
	if(empty($_POST) ===false){
		$id = $_POST['ID_COURS'];
		delete_line($conn, $id, 'Cours_Profs');
		$_POST = NULL;
	}


?>



<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Supprimer le cours d'un professeur
	</h2>
		<?php include 'includes/admin_tableau_cours_professeurs.php';?>

	<form method="POST" action="mon-espace.php?supprimerCoursProfesseur">
		<div class="row">
			<div class="col-sm-12" class = "text-center">
				<div class="form-group">
					<label>
						ID
					</label>
					<select class="form-control" name="ID_COURS" >
						<option disabled selected value> ID du cours</option>
						<?php

							$table_data = get_table_cours($conn, 'Cours_Profs');
							foreach($table_data as $cours){
								$id = $cours['ID'];
								echo '<option>'.$id.'</option>';
								
							}
						?>
					</select>

				</div>
			</div>
			<div class="col-sm-12">
				<div class="text-center">
					<a href="mon-espace.php?modifiercoursprofesseurs" class="btn  btn-bouton-gris  btn-lg">Changer durée cours</a>
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Supprimer</button>
				</div>
			</div>
		</div>
	</form>

</div>
<?php

	if(empty($_POST) ===false){
		$id = $_POST['ID_COURS'];
		$update_data = array(
			'NOM_PROFESSEUR' => $_POST['NOM_PROFESSEUR'],
			);
		update_user($conn, $update_data, $id, 'Cours');
	}


?>



<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Modifier le professeur d'un cours
	</h2>
	<form method="POST" action="mon-espace.php?modifierProfesseurCours">
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					<label>
						ID
					</label>
					<input class="form-control" value ="" name= "ID_COURS"/>

				</div>
			</div>
			<div class="col-sm-9">
				<div class="form-group">
					<label>
						Professeur
					</label>
					<select class="form-control" name="NOM_PROFESSEUR" >
						<option disabled selected value> Professeur</option>
						<option>Prof 1</option>
						<option>Prof 2</option>
					</select>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Actualiser le programme des cours</button>
				</div>
			</div>
		</div>
	</form>
</div>
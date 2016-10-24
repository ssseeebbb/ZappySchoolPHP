<?php
	
	$table='Tarification';

	if(empty($_POST) ===false){

		$categorie = $_POST['CATEGORIE'];
		$prix = $_POST['PRIX'];

		if($prix !== '' && $categorie != ''){
		
			modify_prix($conn, $table, $categorie, $prix);
			$_POST = NULL;

		}
	}


?>



<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Modifier le prix des cours
	</h2>

	<table class="table table-striped">
	  <tr>
	  	<th> Categorie </th> 
	    <th >Prix</th>
	  </tr>

	  <?php  
		$table_data = get_table_brut($conn, $table);
	  	foreach($table_data as $cours){


	  		$categorie = $cours['CATEGORIE'];
	  		$prix = $cours['PRIX'];

	  		
	  		echo '<tr><td>'.$categorie.'</td>';
	  		echo '<td>'.$prix.' </td></tr>';

	  	}

	  ?>
</table>
		
	<form method="POST" action="mon-espace.php?modifierPrixCours">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Catégorie
					</label>
					<select class="form-control" name="CATEGORIE" >
						<option disabled selected value> Type de cours </option>
						<?php
							foreach($table_data as $cours){

								echo '<option>'.$cours['CATEGORIE'].'</option>';
								
								
							}

						?>
					</select>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="form-group">
					<label>
						Prix
					</label>
					<input class = "form-control" type="text" name="PRIX">
				</div>
			</div>

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Actualiser</button>
				</div>
			</div>
		</div>
	</form>

</div>
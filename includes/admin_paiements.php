<?php
	
	if(empty($_POST) ===false){
		

		if (empty($_POST['ID_COURS']) == false){
				$id = $_POST['ID_COURS'];
				$type_paiement = $_POST['PAIEMENT'];


				$table_data = get_table_cours_tot($conn, 'Cours');
				foreach($table_data as $cours){
					if($cours['ID'] == $id){
						$prix_a_payer = $cours['PRIX'];
					}
				}

				$update_data = array(
					'PAYE' 		=> $prix_a_payer,
					'PAIEMENT'  => $type_paiement,
					);

				update_user($conn, $update_data, $id, 'Cours');
			}
		$_POST = NULL;
	}


?>



<div class="col-sm-8">

	<?php include 'includes/admin_tableau_paiement_cours.php';?>

	<form method="POST" action="mon-espace.php?paiements">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						ID
					</label>
					<select class="form-control" name="ID_COURS" >
						<option disabled selected value> ID du cours</option>
						<?php

							$table_data = get_table_cours_tot($conn, 'Cours');
							foreach($table_data as $cours){
								$prix_cours = $cours['PRIX'];
								$paiement_a_faire = $cours['PAYE'];
								$statut = $cours['STATUT'];

								if($paiement_a_faire < $prix_cours && $statut == 1){
									$id=$cours['ID'];
									echo '<option>'.$id.'</option>';
								}
							}
								
							

						?>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Type de paiement
					</label>
					<select class="form-control" name="PAIEMENT" >
						<option disabled selected value> Type de paiement</option>
						<option>Cash</option>
						<option>Virement</option>
					</select>
				</div>
			</div>
			

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">OK</button>
				</div>
			</div>
		</div>
	</form>

</div>
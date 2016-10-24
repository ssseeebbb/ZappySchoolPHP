<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Ajouter un autre enfant à ma charge
	</h2>
	<?php
		if((empty($errors) === false)){
			echo output_errors($errors);
		}
	?>
	<form method="POST" action="process_ajouter_enfant.php">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Prénom
					</label>
					<input class="form-control" name="PRENOM_ENFANT" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Nom
					</label>
					<input class="form-control" name="NOM_ENFANT" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>
				Date de naissance (ndlr: Jour - Mois - Année (17-12-1993))
			</label>
			<input class="form-control" type="text" name="NAISSANCE" />
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Ecole fréquentée
					</label>
					<input class="form-control" name="ECOLE"/>
				</div>
			</div>
			<div class="col-sm-6">
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
		</div>
		<div class="text-center">
				<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
					<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Terminer
				</button>
		</div>
	</form>
</div>
<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Ajouter un nouveau professeur
	</h2>
	<?php
		if((empty($errors) === false)){
			echo output_errors($errors);
		}
	?>
	<form method="POST" action="process_admin_nouveau_prof.php">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						E-mail
					</label>
					<input class="form-control" type="text" name="EMAIL_PROF" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Prénom
					</label>
					<input class="form-control" type="text" name="PRENOM_PROFESSEUR" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Nom
					</label>
					<input class="form-control" type="text" name="NOM_PROFESSEUR" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						Téléphone
					</label>
					<input class="form-control" type="text" name="TELEPHONE_PROF" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						Date de naissance (ndlr: Jour - Mois - Année (17-12-1993))
					</label>
					<input class="form-control" type="text" name="NAISSANCE_PROF" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						Rue et numéro
					</label>
					<input class="form-control" type="text" name="ADRESSE_PROF" />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Code Postal
					</label>
					<input class="form-control" name="POSTAL_PROF"/>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="form-group">
					<label>
						Ville
					</label>
					<input class="form-control" name="VILLE_PROF" />
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						Profession
					</label>
					<input class="form-control" name="PROFESSION_PROF" />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Matière préférée *
					</label>
					<input class="form-control" name="MATIERE_PROF_1" />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Matière préférée 2
					</label>
					<input class="form-control" name="MATIERE_PROF_2" />
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
					<label>
						Matière préférée 3
					</label>
					<input class="form-control" name="MATIERE_PROF_3" />
				</div>
			</div>
			<div class="text-center">
				<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
					<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Ajouter le nouveau professeur
				</button>
		</div>
		</div>
	</form>
</div>
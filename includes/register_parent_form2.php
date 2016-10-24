<div class="bloc bgc-white-smoke l-bloc" id="bloc-9">
	<div class="container bloc-lg">
		<div class="row voffset-md ">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<form action="register_parent_page2.php" method="POST" >
					<h1 class="mg-md text-center">
						Enregistrer mon enfant!
					</h1>

					<h3 class="mg-md text-center">
						<?php echo username_from_user_id($conn, $_SESSION['ID_REGISTER'], 'Parents');?>
					</h3>

					<?php
						if((empty($errors) === false)){
							echo output_errors($errors);
						}
					?>
					<div class="panel">
						<div class="panel-body">
							<p>
								Si vous avez plusieurs enfants, vous aurez l'occasion de les inscrire depuis votre profil utilisateur.
							</p>
						</div>
					</div>
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
					<div class="form-group">
						<label>
							Rue et numéro
						</label>
						<input class="form-control" type="text" name="ADRESSE" />
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>
									Code Postal
								</label>
								<input class="form-control" name="POSTAL"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>
									Ville
								</label>
								<input class="form-control" name="VILLE" />
							</div>
						</div>
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
						<a href="enregistrement.php?enfantinscrit">
							<button class="bloc-button btn   btn-lg btn-bouton-gris" type="button">
								<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Mon enfant est déjà inscrit
							</button>
						</a>
							</form>
							<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
								<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Terminer
							</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
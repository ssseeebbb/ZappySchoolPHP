<div class="bloc bgc-white-smoke l-bloc" id="bloc-9">
	<div class="container bloc-lg">
		<div class="row voffset-md ">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<form action="process_enfant_deja_inscrit.php" method="POST" >
					<h1 class="mg-md text-center">
						Qui est votre enfant ?
					</h1>

					<h3 class="mg-md text-center">
						<?php echo username_from_user_id($conn, $_SESSION['ID_REGISTER'], 'Parents');?>
					</h3>

					<?php
						if((empty($errors) === false)){
							echo output_errors($errors);
						}
					?>
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
					<div class="text-center">
							<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
								<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Terminer
							</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
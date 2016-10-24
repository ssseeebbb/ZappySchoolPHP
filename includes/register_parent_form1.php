<!-- bloc-12 -->
<div class="bloc bgc-white-smoke l-bloc" id="bloc-9">
	<div class="container bloc-lg">
		<div class="row voffset-md ">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<form action="register_parent_page1.php" method="POST" >
					<h1 class="mg-md text-center">
						Parents ? Enregistrez-vous pour reserver des séances!
					</h1>

					<?php
						if((empty($errors) === false)){
							echo output_errors($errors);
						}
					?>

					<div class="form-group">
						<label>
							Lien de parenté
						</label><br>
						<input type="radio" name="LIEN_PARENTAL" value="Papa"> Papa <br>
						<input type="radio" name="LIEN_PARENTAL" value="Maman"> Maman <br>
						<input type="radio" name="LIEN_PARENTAL" value="Autre"> Autre <br>
					</div>

					<div class="form-group">
						<label>
							E-mail
						</label>
						<input class="form-control" type="text" name="EMAIL" />
					</div>
					<div class="form-group">
						<label>
							Mot de passe
						</label>
						<input class="form-control" type="password" name="PASSWORD"  />
					</div>
					<div class="form-group">
						<label>
							Confirmer le mot de passe
						</label>
						<input class="form-control" type="password" name="PASSWORD_AGAIN" />
					</div>
					<div class="form-group">
						<label>
							Numéro de téléphone
						</label>
						<input class="form-control" type="text" name="TELEPHONE" />
					</div>
					<div class="text-center">
						<div class="text-center">
							<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
								<span class="ion ion-arrow-right-c icon-anti-flash-white icon-spacer"></span>Poursuivre
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- bloc-12 END -->
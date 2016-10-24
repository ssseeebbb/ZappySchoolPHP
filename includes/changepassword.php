<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Changer de mot de passe
	</h2>
	<?php
		if((empty($errors) === false)){
			echo output_errors($errors);
		}
	?>
	<form method="POST" action="process_changepassword.php">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						Mot de passe actuel
					</label>
					<input class="form-control" name="PASSWORD_ACTUEL" type="password" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						Nouveau mot de passe
					</label>
					<input class="form-control" name="NOUVEAU_PASSWORD" type="password" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label>
						Nouveau mot de passe - confirmation
					</label>
					<input class="form-control" name="NOUVEAU_PASSWORD_AGAIN" type="password" />
				</div>
			</div>
		</div>
		<div class="text-center">
			<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
				<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span> Changer de mot de passe
			</button>
		</div>
	</form>
</div>
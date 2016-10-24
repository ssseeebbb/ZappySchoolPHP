<!-- bloc-9 -->
<div class="bloc bgc-white-smoke l-bloc" id="bloc-9">
	<div class="container bloc-lg">
		<div class="row voffset-md ">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<form action="login.php" method="POST" >
					<h1 class="mg-md text-center">
						Connectez-vous !
					</h1>

					<?php
						if((empty($errors) === false)){
							echo output_errors($errors);
						}
						if(isset($_GET['registered']) && empty($_GET['registered'])){
							echo 'Votre nouveau compte a été créé, veuillez vous connecter!';
						}
					?>

					<div class="form-group">
						<label>
							E-mail
						</label>
						<input class="form-control" type="text" name="EMAIL" id="input_1741" />
					</div>
					<div class="form-group">
						<label>
							Mot de passe
						</label>
						<input class="form-control" type="password" name="PASSWORD" id="input_2200" />
					</div>
					<div class="text-center">
						<a href="index.php" class="a-btn">Mot de passe oublié ?</a>
						<div class="text-center">
							<a href="enregistrement.php" class="a-btn">Pas encore membre ? Enregistrez vous !</a>
							<div class="text-center">
								<button class="bloc-button btn   btn-lg btn-lapis-lazuli" type="submit">
									<span class="ion ion-checkmark-round icon-anti-flash-white icon-spacer"></span>Se connecter
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- bloc-9 END -->
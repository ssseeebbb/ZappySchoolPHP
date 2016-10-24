	<div class="bloc bgc-white-smoke l-bloc" id="bloc-11">
	<div class="container bloc-lg">
		<div class="row">
		<?php
				include 'includes/reservation_cours_groupe.php';
		?>
			<div class="col-sm-4">
				<h3 class="mg-md">
					Bonjour <strong><?php echo $user_data['EMAIL']; ?></strong>
				</h3>
				<h4><?php echo $user_data['LIEN_PARENTAL']; ?> de <?php echo $user_data['PRENOM_ENFANT'].' '.$user_data['NOM_ENFANT']; ?></h4>
				<a href="mon-espace.php?ajoutenfant" class="a-btn a-block">Ajouter un autre enfant</a>
				<a href="changepassword.php" class="a-btn a-block">Changer le mot de passe</a>
				<a href="settings.php" class="a-btn a-block">Modifier mes informations</a>
				<!-- <form id="form_1722" novalidate>
					<a href="index.html" class="btn  btn-bouton-gris   btn-sm pull-right">Envoyer</a>
					<div class="form-group">
						<label>
							Exprimez vous !
						</label>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="4" cols="50" id="textarea_2293"></textarea>
					</div>
				</form> -->
				<form id="form_1757" novalidate>
					<div class="text-center">
						<a href="logout.php" class="btn  btn-lapis-lazuli  btn-lg">Se déconnecter</a>
					</div>
				</form>
			</div>			
		</div>
	</div>
</div>
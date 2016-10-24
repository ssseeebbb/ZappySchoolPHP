<?php
	include 'core/init.php';
	include'includes/upper.php';
?>

	<div class="bloc bgc-white-smoke l-bloc" id="bloc-11">
		<div class="container bloc-lg">
			<div class="row">
			
			<?php
				
			if (empty($_GET) === true){
				include 'includes/admin_defaut.php';
				
			} else if (isset($_GET['ajoutheurecours']) && empty($_GET['ajoutheurecours'])){
				include 'includes/admin_ajout_dispo_cours.php';
				
			} else {

			}
			?>
				
				<div class="col-sm-4">
					<h3 class="mg-md">
						Bonjour cher administrateur
					</h3>
					<a href="index.html" class="a-btn a-block">Enregistrer mon enfant</a>
					<a href="changepassword.php" class="a-btn a-block">Changer le mot de passe</a>
					<a href="settings.php" class="a-btn a-block">Modifier mes informations</a>
					<div class="text-center">
						<a href="logout.php" class="btn  btn-lapis-lazuli  btn-lg">Se déconnecter</a>
					</div>
				</div>


				
			</div>
		</div>
	</div>
<?php
	include'includes/lower.php';
?>
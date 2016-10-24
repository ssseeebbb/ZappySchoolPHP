<div class="bloc bgc-white-smoke l-bloc" id="bloc-11">
	<div class="container bloc-lg">
		<div class="row">
		<?php

			if (empty($_GET) === true){

				include'includes/client_tableaurecap.php';
				
			} else if (isset($_GET['reserveruncours']) && empty($_GET['reserveruncours'])){

				include 'includes/choix_type_cours.php';
				
			} else if(isset($_GET['coursencadre']) && empty($_GET['coursencadre'])){

				include 'includes/reservation_cours_groupe.php';

			} else if(isset($_GET['ajoutenfant']) && empty($_GET['ajoutenfant'])){

				include 'includes/ajouterenfant.php';
				
			} else if(isset($_GET['changepassword']) && empty($_GET['changepassword'])){

				include 'includes/changepassword.php';
				
			} else if(isset($_GET['reserveruncoursparticulier']) && empty($_GET['reserveruncoursparticulier'])){

				include 'includes/client_reserver_cours_particulier.php';

			} else if(isset($_GET['modifierinfos']) && empty($_GET['modifierinfos'])){

				include 'includes/client_modifier_infos.php';
			} else if(isset($_GET['choixinscription']) && empty($_GET['choixinscription'])){

				include 'includes/choix_inscription_support_cours.php';
			}



			

		include 'includes/client_side_menu.php';
			
		?>
						
		</div>
	</div>
</div>
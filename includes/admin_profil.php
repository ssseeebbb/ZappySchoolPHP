<div class="bloc bgc-white-smoke l-bloc" id="bloc-11">
	<div class="container bloc-lg">
		<div class="row">
		<?php

			if (empty($_GET) === true){

				include'includes/admin_horaire_zappy.php';
				
			} else if (isset($_GET['admin_ouverture']) && empty($_GET['admin_ouverture'])){

				include'includes/admin_ouverture_ecole.php';
			}

			else if (isset($_GET['adminChangerUneDate']) && empty($_GET['adminChangerUneDate'])){

				include'includes/admin_ouverture_ecole_solo.php';
			}

			else if (isset($_GET['tableauCours']) && empty($_GET['tableauCours'])){

				include'includes/admin_affichage_tableau_cours.php';
			}
			else if (isset($_GET['modifierProfesseurCours']) && empty($_GET['modifierProfesseurCours'])){

				include'includes/admin_modifierProfesseurCours.php';
			}
			else if (isset($_GET['ajouterNouveauProfesseur']) && empty($_GET['ajouterNouveauProfesseur'])){

				include'includes/admin_ajouter_nouveau_professeur.php';
			}
			else if (isset($_GET['activationProf']) && empty($_GET['activationProf'])){

				include'includes/admin_activationProf.php';
			}
			else if(isset($_GET['modifierDureeCours']) && empty($_GET['modifierDureeCours'])){
				
				include'includes/admin_modifierDureeCours.php';

			}
			else if(isset($_GET['supprimerCours']) && empty($_GET['supprimerCours'])){
				
				include'includes/admin_supprimerCours.php';

			}
			else if(isset($_GET['paiements']) && empty($_GET['paiements'])){
				
				include'includes/admin_paiements.php';

			}

			else if(isset($_GET['paiementsprofs']) && empty($_GET['paiementsprofs'])){
				
				include'includes/admin_paiementsprofs.php';

			}

			else if(isset($_GET['resumecours']) && empty($_GET['resumecours'])){
				
				include'includes/admin_resumecours.php';

			}
			else if(isset($_GET['resumeeleves']) && empty($_GET['resumeeleves'])){
				
				include'includes/admin_resumeeleves.php';

			}

			else if(isset($_GET['resumeprof']) && empty($_GET['resumeprof'])){
				
				include'includes/admin_resumeprofs.php';

			}

			else if(isset($_GET['coursprofesseur']) && empty($_GET['coursprofesseur'])){
				
				include'includes/admin_coursprofesseur.php';

			}
			else if(isset($_GET['modifierPrixCours']) && empty($_GET['modifierPrixCours'])){
				
				include'includes/modifierPrixCours.php';

			}
			else if(isset($_GET['modifiercoursprofesseurs']) && empty($_GET['modifiercoursprofesseurs'])){
				
				include'includes/admin_modifiercoursprofesseurs.php';

			}
			else if(isset($_GET['supprimerCoursProfesseur']) && empty($_GET['supprimerCoursProfesseur'])){
				
				include'includes/admin_supprimerCoursProfesseur.php';

			}

			else if(isset($_GET['inscriptioncourseleve']) && empty($_GET['inscriptioncourseleve'])){
				
				include'includes/admin_inscriptioncourseleve.php';

			}

			


			

			







				
		?>
		<?php include 'includes/admin_menu_cote.php'; ?>		
		</div>
	</div>
</div>
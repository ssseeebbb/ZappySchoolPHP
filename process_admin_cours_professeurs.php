<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){

	$required_fields = array('DATE_COURS', 'HEURE_DEBUT', 'TYPE_COURS', 'DUREE_HEURE','MATIERE', 'NOM_PROFESSEUR');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}



}

if (empty($errors) === true && empty($_POST) === false){

	$table_reservation='Cours_Profs';
	$table_prof = 'Professeur';
	$cout= get_prices($conn, 'Tarification');
	foreach ($cout as $ligne) {

		if($ligne['CATEGORIE'] == 'PROF_PRIX_GROUPE' && $_POST['TYPE_COURS'] == 'Groupe'){
			$COUT_HORAIRE = $ligne['PRIX'];
		} else if ($ligne['CATEGORIE'] == 'PROF_PRIX_INDIVIDUEL' && $_POST['TYPE_COURS'] == 'Particulier'){
			$COUT_HORAIRE = $ligne['PRIX'];
		}
	}

	
	$DUREE = (((int)  strtok($_POST['DUREE_HEURE'], ':'))*60) + (int) substr($_POST['DUREE_HEURE'], -2);
	$PRIX = ((int) $DUREE * (int) $COUT_HORAIRE)/60;

	$professeur = $_POST['NOM_PROFESSEUR'] ;
	$prof_array = explode(" ", $professeur);

	$NOM_PROF = $prof_array[1];
	$PRENOM_PROF =$prof_array[0];


	$register_data_cours_prof = array(
		'NOM_PROFESSEUR' 		=> $NOM_PROF,
		'PRENOM_PROFESSEUR' 	=> $PRENOM_PROF,
		'DATE_HORAIRE' 					=> date("Y-m-d", strtotime($_POST['DATE_COURS'])),
		'HEURE_DEBUT'			=> $_POST['HEURE_DEBUT'],
		'DUREE' 				=> $_POST['DUREE_HEURE'],
		'A_PAYER'				=> $PRIX,
		'PAYE'					=> 0,
		'MATIERE'				=> $_POST['MATIERE'],
		'TYPE_COURS'			=> $_POST['TYPE_COURS'],
		);
	
	register_user_no_password($conn, $register_data_cours_prof, $table_reservation);
	header('Location: mon-espace.php?coursprofesseur');
	exit();

} else if (empty($errors) === false){
	include 'includes/upper.php'; 
	echo '<div class="bloc bgc-white-smoke l-bloc" id="bloc-11"><div class="container bloc-lg"><div class="row">';
	include'includes/admin_coursprofesseur.php';
	include 'includes/admin_menu_cote.php';
	echo '</div></div></div>';
	include 'includes/lower.php';
} else{
	$errors[]= 'Il faut remplir les champs avant de soumettre le formulaire';
	include 'includes/upper.php'; 
	echo '<div class="bloc bgc-white-smoke l-bloc" id="bloc-11"><div class="container bloc-lg"><div class="row">';
	include'includes/admin_coursprofesseur.php';
	include 'includes/admin_menu_cote.php';
	echo '</div></div></div>';
	include 'includes/lower.php';

}
?>

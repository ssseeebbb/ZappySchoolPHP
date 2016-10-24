<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$required_fields = array('DATE_COURS', 'HEURE_DEBUT', 'DUREE_HEURE','MATIERE','TYPE_COURS',  'NOM_ENFANT', 'PRENOM_ENFANT');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}

$table_reservation='Cours';
$table_enfant = 'Enfants';
$cout= get_prices($conn, 'Tarification');

	if (empty($errors) === true){
		foreach ($cout as $ligne) {
			if($ligne['CATEGORIE'] == 'COURS_GROUPE' && $_POST['TYPE_COURS'] == 'Groupe'){
				$COUT_HORAIRE = $ligne['PRIX'];
			} else if($ligne['CATEGORIE'] == 'COURS_PARTICULIER' && $_POST['TYPE_COURS'] == 'Particulier'){
				$COUT_HORAIRE = $ligne['PRIX'];
			}
		}
		//Le nom et prenom de l'enfant existe déjà
		//La date de naissance est au dessus de 22ans ou en dessous de 10 ans
		//
		if(child_exists($conn, $_POST['NOM_ENFANT'], $_POST['PRENOM_ENFANT'], $table_enfant) === false){
			$errors[] = 'L\'enfant '.$_POST['PRENOM_ENFANT'].' '.$_POST['NOM_ENFANT'].' n\'est pas inscrit dans la base de donnée';
		}
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$id=(int) $_SESSION['ID'];

	$today = date("Y-m-d H:i:s"); 
	//$date_format=date('Y-m-d', strtotime($_POST['NAISSANCE']));
	$DUREE = (((int)  strtok($_POST['DUREE_HEURE'], ':'))*60) + (int) substr($_POST['DUREE_HEURE'], -2);
	$PRIX = ((int) $DUREE * (int) $COUT_HORAIRE)/60;

	$register_data_cours = array(
		'NOM_ENFANT' 			=> $_POST['NOM_ENFANT'],
		'PRENOM_ENFANT' 		=> $_POST['PRENOM_ENFANT'],
		'DATE_HORAIRE' 			=> date("Y-m-d", strtotime($_POST['DATE_COURS'])),
		'DUREE' 				=> $_POST['DUREE_HEURE'],
		'PRIX'					=> $PRIX,
		'HEURE_DEBUT'			=> $_POST['HEURE_DEBUT'],
		'PAYE'					=> 0,
		'MATIERE'				=> $_POST['MATIERE'],
		'TYPE_COURS'			=> $_POST['TYPE_COURS'],
		'ECOLE'					=> $_POST['ECOLE'] ,
		'ANNEE_ETUDE'			=> $_POST['ANNEE_ETUDE'] ,
		'PARENT_RESERVATION_ID' => 0,
		);

	$table_reservation='Cours';
	register_user_no_password($conn, $register_data_cours, $table_reservation);
	header('Location: mon-espace.php');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php';
	echo '<div class="bloc bgc-white-smoke l-bloc" id="bloc-11">
	<div class="container bloc-lg">
	<div class="row"> ';
	include 'includes/admin_inscriptioncourseleve.php';
	include 'includes/admin_menu_cote.php'; 		
	echo '</div></div></div>';
	include 'includes/lower.php';
}
?>

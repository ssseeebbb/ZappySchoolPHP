<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$required_fields = array('DATE_COURS', 'HEURE_DEBUT', 'DUREE_HEURE','MATIERE', 'NOM_ENFANT', 'PRENOM_ENFANT');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}

$table_reservation='Cours';
$table_enfant = 'Enfants';
$cout= get_prices($conn, 'Tarification');
foreach ($cout as $ligne) {
	if($ligne['CATEGORIE'] == 'COURS_GROUPE'){
		$COUT_HORAIRE = $ligne['PRIX'];
	}
}




	if (empty($errors) === true){
		//Le nom et prenom de l'enfant existe déjà
		//La date de naissance est au dessus de 22ans ou en dessous de 10 ans
		//
		/*if(child_exists($conn, $_POST['NOM_ENFANT'], $_POST['PRENOM_ENFANT'], $table_enfant) === false){
			$errors[] = 'Votre enfant '.$_POST['PRENOM_ENFANT'].' '.$_POST['NOM_ENFANT'].' n\'est pas inscrit dans la base de donnée';
		}*/
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$id=(int) $_SESSION['ID'];

	$today = date("Y-m-d H:i:s"); 
	//$date_format=date('Y-m-d', strtotime($_POST['NAISSANCE']));
	$DUREE = (((int)  strtok($_POST['DUREE_HEURE'], ':'))*60) + (int) substr($_POST['DUREE_HEURE'], -2);
	$PRIX = ((int) $DUREE * (int) $COUT_HORAIRE)/60;

	$enfant = $_POST['NOM_ENFANT'] ;
	$enfant_array = explode(" ", $enfant);

	$NOM_ENFANT = $enfant_array[1];
	$PRENOM_ENFANT =$enfant_array[0];

	$line_enfant= child_data($conn, $table_enfant , $NOM_ENFANT, $PRENOM_ENFANT);


	$register_data_cours = array(
		'NOM_ENFANT' 			=> $NOM_ENFANT,
		'PRENOM_ENFANT' 		=> $PRENOM_ENFANT,
		'DATE_HORAIRE' 			=> date("Y-m-d", strtotime($_POST['DATE_COURS'])),
		'DUREE' 				=> $_POST['DUREE_HEURE'],
		'PRIX'					=> $PRIX,
		'HEURE_DEBUT'			=> $_POST['HEURE_DEBUT'],
		'PAYE'					=> 0,
		'MATIERE'				=> $_POST['MATIERE'],
		'TYPE_COURS'			=> 'Groupe',
		'ECOLE'					=> $line_enfant['ECOLE'] ,
		'ANNEE_ETUDE'			=> $line_enfant['ANNEE_ETUDE'] ,
		'PARENT_RESERVATION_ID' => $id,
		);
	
	register_user_no_password($conn, $register_data_cours, $table_reservation);
	header('Location: mon-espace.php');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php'; 
	include 'includes/error_reservation_cours.php';
	include 'includes/lower.php';
}
?>

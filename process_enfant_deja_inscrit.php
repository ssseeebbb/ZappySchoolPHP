<?php 
include 'core/init.php'; 

$table_parent='Parents';
$table_enfant='Enfants';


if(empty($_POST) ===false){
	$required_fields = array('PRENOM_ENFANT', 'NOM_ENFANT', 'NAISSANCE');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}


	if (empty($errors) === true){
		//Le nom et prenom de l'enfant existe déjà
		//La date de naissance est au dessus de 22ans ou en dessous de 10 ans
		//


		if(child_exists($conn, $_POST['NOM_ENFANT'], $_POST['PRENOM_ENFANT'], $table_enfant) === false){
			$errors[] = 'Votre enfant '.$_POST['PRENOM_ENFANT'].' '.$_POST['NOM_ENFANT'].' n\'est pas encore inscrit dans la base de donnée';
		}

		if(validateDate($_POST['NAISSANCE']) === false){
			$errors[] = 'La date de naissance que vous avez entré n\'est pas valide';
		}

		$date_format = date('Y-m-d', strtotime($_POST['NAISSANCE']));

		if(child_birth_test($conn, $_POST['NOM_ENFANT'], $_POST['PRENOM_ENFANT'], $date_format,  $table_enfant) === false){
			$errors[] = 'La date de naissance ne coincide pas avec le nom et prenom de l\'enfant';
		}
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$today = date("Y-m-d H:i:s"); 
	$id_enfant = user_id_from_name_and_surname($conn, $_POST['NOM_ENFANT'], $_POST['PRENOM_ENFANT'], $table_enfant);
	$child_data = user_data($conn, $id_enfant, $table_enfant, 'ADRESSE', 'POSTAL', 'VILLE');


	$update_data_parents = array(
		'NOM_ENFANT'	=> $_POST['NOM_ENFANT'],
		'PRENOM_ENFANT'	=> $_POST['PRENOM_ENFANT'],
		'ADRESSE' 		=> $child_data['ADRESSE'],
		'POSTAL' 		=> $child_data['POSTAL'],
		'VILLE'			=> $child_data['VILLE'],
		'DATE_INSCRIPTION' => $today,
		);


	$id=(int) $_SESSION['ID_REGISTER'];
	update_user($conn, $update_data_parents, $id, $table_parent);
	unset($_SESSION['ID_REGISTER']);
	header('Location: mon-espace.php?registered');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php'; 
	include 'includes/enfantdejainscrit.php';
	include 'includes/lower.php';
}
?>


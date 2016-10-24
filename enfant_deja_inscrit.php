<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$required_fields = array('PRENOM_ENFANT', 'NOM_ENFANT', 'NAISSANCE');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}

$table_parent='Parents';
$table_enfant='Enfants';


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

		if(child_exists($conn, $_POST['NOM_ENFANT'], $_POST['PRENOM_ENFANT'], $table_enfant) === false) || validateDate($_POST['NAISSANCE']) === false){
			$errors[] = 'La date de naissance ne coincide pas avec le nom de l\'enfant';
		}
		// if(strlen($_POST['PASSWORD'])<6){
		// 	$errors[] = 'Your password must be at least 6 characters';
		// }
		// if ($_POST['PASSWORD'] !== $_POST['PASSWORD_AGAIN']){
		// 	$errors[] = 'Your passwords do not match';
		// }
		// if (filter_var($_POST['EMAIL'], FILTER_VALIDATE_EMAIL) === false){
		// 	$errors[]='a valid email address is required';
		// }
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$today = date("Y-m-d H:i:s"); 

	$update_data_parents = array(
		'NOM_ENFANT'	=> $_POST['NOM_ENFANT'],
		'PRENOM_ENFANT'	=> $_POST['PRENOM_ENFANT'],
		'ADRESSE' 		=> $_POST['ADRESSE'],
		'POSTAL' 		=> $_POST['POSTAL'],
		'VILLE'			=> $_POST['VILLE'],
		'DATE_INSCRIPTION' => $today,
		);
	$register_data_enfants = array(
		'NOM' 			=> $_POST['NOM_ENFANT'],
		'PRENOM' 		=> $_POST['PRENOM_ENFANT'],
		'ADRESSE' 		=> $_POST['ADRESSE'],
		'POSTAL' 		=> $_POST['POSTAL'],
		'VILLE'			=> $_POST['VILLE'],
		'NAISSANCE'		=> $_POST['NAISSANCE'],
		'ECOLE'			=> $_POST['ECOLE'],
		'ANNEE_ETUDE'	=> $_POST['ANNEE_ETUDE'],
		);

	$id=(int) $_SESSION['ID_REGISTER'];
	register_user_no_password($conn, $register_data_enfants, $table_enfant);
	update_user($conn, $update_data_parents, $id, $table_parent);
	unset($_SESSION['ID_REGISTER']);
	header('Location: mon-espace.php');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php'; 
	include 'includes/register_parent_form2.php';
	include 'includes/lower.php';
}
?>


<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$required_fields = array('PRENOM_ENFANT', 'NOM_ENFANT', 'ECOLE', 'NAISSANCE','ADRESSE', 'POSTAL', 'VILLE', 'ANNEE_ETUDE');
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


		if(child_exists($conn, $_POST['NOM_ENFANT'], $_POST['PRENOM_ENFANT'], $table_enfant) === true){
			$errors[] = 'Votre enfant '.$_POST['PRENOM_ENFANT'].' '.$_POST['NOM_ENFANT'].' est déjà inscrit dans la base de donnée';
		}

		if(validateDate($_POST['NAISSANCE']) === false){
			$errors[] = 'La date de naissance que vous avez entré n\'est pas valide';
		}

		if(validate_code_postal($_POST['POSTAL']) === false){
			$errors[] = 'Le code postal n\'est pas valide';

		}
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$id=(int) $_SESSION['ID_REGISTER'];
	$today = date("Y-m-d H:i:s"); 
	$parent_data = user_data($conn, $id, $table_parent, 'ID', 'NOM_ENFANT', 'PRENOM_ENFANT', 'EMAIL', 'PASSWORD', 'LIEN_PARENTAL', 'TELEPHONE');
	$date_format=date('Y-m-d', strtotime($_POST['NAISSANCE']));

	$update_data_parents = array(
		'NOM_ENFANT'		=> addslashes($_POST['NOM_ENFANT']),
		'PRENOM_ENFANT'		=> addslashes($_POST['PRENOM_ENFANT']),
		'ADRESSE' 			=> addslashes($_POST['ADRESSE']),
		'POSTAL' 			=> addslashes($_POST['POSTAL']),
		'VILLE'				=> addslashes($_POST['VILLE']),
		'DATE_INSCRIPTION' 	=> $today,
		);
	$register_data_enfants = array(
		'NOM' 				=> addslashes($_POST['NOM_ENFANT']),
		'PRENOM' 			=> addslashes($_POST['PRENOM_ENFANT']),
		'ADRESSE' 			=> addslashes($_POST['ADRESSE']),
		'POSTAL' 			=> addslashes($_POST['POSTAL']),
		'VILLE'				=> addslashes($_POST['VILLE']),
		'NAISSANCE'			=> $date_format,
		'ECOLE'				=> addslashes($_POST['ECOLE']),
		'ANNEE_ETUDE'		=> addslashes($_POST['ANNEE_ETUDE']),
		'TELEPHONE_PARENT' 	=> addslashes($parent_data['TELEPHONE']),
		'MAIL_PARENT'		=> addslashes($parent_data['EMAIL']),
		);
	
	register_user_no_password($conn, $register_data_enfants, $table_enfant);
	update_user($conn, $update_data_parents, $id, $table_parent);
	unset($_SESSION['ID_REGISTER']);
	header('Location: mon-espace.php?registered');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php'; 
	include 'includes/register_parent_form2.php';
	include 'includes/lower.php';
}
?>

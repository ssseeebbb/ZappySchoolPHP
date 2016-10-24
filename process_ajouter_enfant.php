<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$required_fields = array('PRENOM_ENFANT', 'NOM_ENFANT', 'ECOLE', 'NAISSANCE','ANNEE_ETUDE');
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
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$id=(int) $_SESSION['ID'];

	$today = date("Y-m-d H:i:s"); 
	$parent_data = user_data($conn, $id, $table_parent, 'ID', 'NOM_ENFANT', 'PRENOM_ENFANT', 'EMAIL', 'PASSWORD', 'LIEN_PARENTAL', 'TELEPHONE', 'ADRESSE', 'POSTAL', 'VILLE');
	$ieme_enfant = nombre_enfant_inscrit($conn, $id, $table_parent);
	$date_format=date('Y-m-d', strtotime($_POST['NAISSANCE']));

	$update_data_parents = array(
		'NOM_ENFANT_'.$ieme_enfant			=> $_POST['NOM_ENFANT'],
		'PRENOM_ENFANT_'.$ieme_enfant		=> $_POST['PRENOM_ENFANT'],
		);
	$register_data_enfants = array(
		'NOM' 				=> $_POST['NOM_ENFANT'],
		'PRENOM' 			=> $_POST['PRENOM_ENFANT'],
		'ADRESSE' 			=> $parent_data['ADRESSE'],
		'POSTAL' 			=> $parent_data['POSTAL'],
		'VILLE'				=> $parent_data['VILLE'],
		'NAISSANCE'			=> $date_format,
		'ECOLE'				=> $_POST['ECOLE'],
		'ANNEE_ETUDE'		=> $_POST['ANNEE_ETUDE'],
		'TELEPHONE_PARENT' 	=> $parent_data['TELEPHONE'],
		'MAIL_PARENT'		=> $parent_data['EMAIL'],
		);
	
	register_user_no_password($conn, $register_data_enfants, $table_enfant);
	update_user($conn, $update_data_parents, $id, $table_parent);
	header('Location: mon-espace.php');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php'; 
	include 'includes/error_ajouter_enfant.php';
	include 'includes/lower.php';
}
?>

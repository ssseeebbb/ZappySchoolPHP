<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$required_fields = array('EMAIL_PROF', 'PRENOM_PROFESSEUR', 'NOM_PROFESSEUR', 'TELEPHONE_PROF','NAISSANCE_PROF', 'ADRESSE_PROF', 'POSTAL_PROF', 'VILLE_PROF', 'PROFESSION_PROF', 'MATIERE_PROF_1');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}

$table_prof		='Professeur';
$telephone 		= $_POST['TELEPHONE_PROF'];



	if (empty($errors) === true){
		//Le nom et prenom de l'enfant existe déjà
		//La date de naissance est au dessus de 22ans ou en dessous de 10 ans
		//

		if(user_exists($conn, $_POST['EMAIL_PROF'],$table_prof) === true){
			$errors[] = 'Désolé, un compte avec le mail '.$_POST['EMAIL_PROF'].' existe déjà.';
		}
		if (filter_var($_POST['EMAIL_PROF'], FILTER_VALIDATE_EMAIL) === false){
			$errors[]='Vous devez entrer un e-mail valide';
		}
		if(validate_telephon(telephon_transform($telephone)) === false){
			$errors[] = 'Le numero de telephone n\'est pas valide';
		}


		if(validateDate($_POST['NAISSANCE_PROF']) === false){
			$errors[] = 'La date de naissance que vous avez entré n\'est pas valide';
		}

		if(validate_code_postal($_POST['POSTAL_PROF']) === false){
			$errors[] = 'Le code postal n\'est pas valide';

		}
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$today = date("Y-m-d H:i:s"); 
	$naissance_professeur=date('Y-m-d', strtotime($_POST['NAISSANCE_PROF']));


	$register_data_prof = array(
		'NOM' 						=> addslashes($_POST['NOM_PROFESSEUR']),
		'PRENOM'			 		=> addslashes($_POST['PRENOM_PROFESSEUR']),
		'TELEPHONE_PROF' 			=> addslashes($_POST['TELEPHONE_PROF']),
		'ADRESSE_PROF' 				=> addslashes($_POST['ADRESSE_PROF']),
		'POSTAL_PROF'				=> addslashes($_POST['POSTAL_PROF']),
		'VILLE_PROF'				=> addslashes($_POST['VILLE_PROF']),
		'EMAIL'						=> addslashes($_POST['EMAIL_PROF']),
		'NAISSANCE_PROF'			=> $naissance_professeur,
		'PROFESSION_PROF'			=> addslashes($_POST['PROFESSION_PROF']),
		'MATIERE_PROF_1' 			=> addslashes($_POST['MATIERE_PROF_1']),
		'MATIERE_PROF_2'			=> addslashes($_POST['MATIERE_PROF_2']),
		'MATIERE_PROF_3' 			=> addslashes($_POST['MATIERE_PROF_3']),
		'DATE_INSCRIPTION_PROF' 	=> $today,
		);
	
	register_user_no_password($conn, $register_data_prof, $table_prof);
	header('Location: mon-espace.php');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php'; 
	include 'includes/error_ajouter_nouveau_professeur.php';
	include 'includes/lower.php';
}
?>

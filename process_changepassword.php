<?php 
	include 'core/init.php'; 
	$table='Parents';

	if(empty($_POST) === false){
		$required_fields = array('PASSWORD_ACTUEL', 'NOUVEAU_PASSWORD', 'NOUVEAU_PASSWORD_AGAIN');

		foreach ($_POST as $key => $value) {
			if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs ne sont pas remplis';
			break 1;
			}
		}

		if(md5($_POST['PASSWORD_ACTUEL']) === $user_data['PASSWORD']){
			if(trim($_POST['NOUVEAU_PASSWORD']) !== trim($_POST['NOUVEAU_PASSWORD_AGAIN'])){ // trim enleve les espaces blanc d droite et a gauche
				$errors[]='Your new passwords do not match';
			} else if(strlen($_POST['NOUVEAU_PASSWORD'])<6){
				$errors[]='Votre mot de passe doit contenir au moins 6 caractères';
			}
		} else{
			$errors[] = 'Votre mot de passe actuel ne correspond pas';
		}
	}

	if(empty($errors) === true && empty($_POST) === false){
		change_password($conn, $_SESSION['ID'], $_POST['NOUVEAU_PASSWORD'], $table);
		header ('Location:mon-espace.php');

	} else if(empty($errors) ===false){
		include 'includes/upper.php'; 
		include 'includes/error_change_password.php';
		include 'includes/lower.php';
	}
?>
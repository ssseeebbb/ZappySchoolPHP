<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$required_fields = array('EMAIL', 'PASSWORD', 'PASSWORD_AGAIN', 'TELEPHONE','LIEN_PARENTAL');
	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}
	
$table_parent	= 'Parents';
$telephone 		= $_POST['TELEPHONE'];


	if (empty($errors) === true){
		if(user_exists($conn, $_POST['EMAIL'],$table_parent) === true && user_active($conn, $_POST['EMAIL'], $table_parent) === true){
			$errors[] = 'Désolé, un compte avec le mail '.$_POST['EMAIL'].' existe déjà.';
		}
		if(strlen($_POST['PASSWORD'])<6){
			$errors[] = 'Votre mot de passe doit contenir au minimum 6 caractères';
		}
		if ($_POST['PASSWORD'] !== $_POST['PASSWORD_AGAIN']){
			$errors[] = 'Vos deux mots de passe ne correspondent pas';
		}
		if (filter_var($_POST['EMAIL'], FILTER_VALIDATE_EMAIL) === false){
			$errors[]='a valid email address is required';
		}
		if(validate_telephon(telephon_transform($telephone)) === false){
			$errors[] = 'Le numero de telephone n\'est pas valide';
		}
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$register_data = array(
		'EMAIL' 		=> addslashes($_POST['EMAIL']),
		'PASSWORD' 		=> addslashes($_POST['PASSWORD']),
		'TELEPHONE'		=> telephon_transform($_POST['TELEPHONE']),
		'LIEN_PARENTAL'	=> addslashes($_POST['LIEN_PARENTAL']),
		);
	register_user($conn, $register_data, $table_parent);
	$_SESSION['ID_REGISTER'] = user_id_from_username($conn, $_POST['EMAIL'], $table_parent);
	header('Location: enregistrement.php');
	exit();
} else if (empty($errors) === false){
	include 'includes/upper.php'; 
	include 'includes/register_parent_form1.php';
	include'includes/lower.php';
}
?>

<?php

include 'core/init.php';

if(empty($_POST['EMAIL']) === false || empty($_POST['PASSWORD']) === false){
	$email=$_POST['EMAIL'];
	$password = $_POST['PASSWORD'];
	$table='Parents';

	if(empty($email) || empty($password)){
		$errors[] = 'Vous devez rentrer un e-mail ainsi qu\'un mot de passe';
	} else if(user_exists($conn, $email, $table) === false){
		$errors[] = 'On ne trouve pas votre adresse e-mail ! Vous êtes vous enregistrer ?';
	} else if(user_active($conn, $email, $table) ===false){
		$errors[] = "Vous n'avez pas activé votre compte !";
	} else {
		$login = login($conn, $email, $password, $table);
		if($login ===false){
			$errors[]='La combinaison de l\'e-mail avec le mot de passe est incorrecte';
		} else{
			$_SESSION['ID'] = $login;
			header("Refresh:0; url=mon-espace.php");
			exit();
		}
	}
} else{
	$errors[]= 'Aucune donnée n\'a été encodée';
}
?>


<?php
if(empty($errors) === false){
	include'includes/upper.php';
	include 'includes/login_form.php';
	include'includes/lower.php';
}


?>
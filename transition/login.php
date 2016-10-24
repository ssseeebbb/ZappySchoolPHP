<?php

include 'core/init.php';

if(empty($_POST['EMAIL']) === false || empty($_POST['PASSWORD']) === false){
	$email=$_POST['EMAIL'];
	$password = $_POST['PASSWORD'];
	$table='Parents';

	if(empty($email) || empty($password)){
		$errors[] = 'You need to enter a username and password';
	} else if(user_exists($conn, $email, $table) === false){
		$errors[] = 'We cant find that username. Have you registered ?';
	} else if(user_active($conn, $email, $table) ===false){
		$errors[] = "You haven't activate your account !";
	} else {
		$login = login($conn, $email, $password, $table);
		if($login ===false){
			$errors[]='That username and password combination is not correct';
		} else{
			$_SESSION['ID'] = $login;
			header("Refresh:0; url=mon-profil.php");
			exit();
		}
	}
} else{
	$errors[]= 'No data received';
}
?>


<?php
if(empty($errors) === false){
	echo output_errors($errors);
}


?>
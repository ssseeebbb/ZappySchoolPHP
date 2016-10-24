<?php
	include 'core/init.php';
	include'includes/upper.php';


	if(logged_in() ===true){
		if(is_admin($conn, 'Parents') === true){
			include 'includes/admin_profil.php';
		} else{
			include 'includes/mon_profil.php';
		}
	} 
	else{
		include 'includes/login_form.php';
	}

	include'includes/lower.php';
?>
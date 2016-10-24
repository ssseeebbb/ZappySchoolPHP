<?php 
	include 'core/init.php';
	include 'includes/upper.php'; 
	/*if(empty($_GET) === true){
		include 'includes/register_parent_form1.php';
	}*/
	if (is_registering()===true && empty($_GET) === true){
		include 'includes/register_parent_form2.php';
	} else if(is_registering()===true && isset($_GET['ajoutenfant']) && empty($_GET['ajoutenfant'])) {
		include 'includes/ajouterenfant.php';
	}
	else if(is_registering()===true && isset($_GET['enfantinscrit']) && empty($_GET['enfantinscrit'])) {
		include 'includes/enfantdejainscrit.php';
	}
	else{
		include 'includes/register_parent_form1.php';
	}
	include'includes/lower.php';
?>

<?php 
include 'core/init.php'; 
if(empty($_POST) ===false){
	$table_parent = 'Parents';
	$id = $_SESSION['ID'];



	$nom_formulaire = array('ADRESSE_ENFANT_', 'POSTAL_ENFANT_', 'VILLE_ENFANT_', 'ECOLE_ENFANT_','ANNEE_ETUDE_');

	$required_fields = array('EMAIL_PARENT', 'TELEPHONE_PARENT', 'ADRESSE_PARENT', 'POSTAL_PARENT','VILLE_PARENT');

	for($i=1; $i<=nombre_enfant_inscrit($conn, $id, $table_parent); $i++){
	foreach ($nom_formulaire as $ieme_formulaire) {
		$required_fields[] = $ieme_formulaire.$i;
	}
}




	foreach ($_POST as $key => $value) {
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[]= 'Tous les champs doivent être remplis';
			break 1;
		}
	}

$table_enfant	='Enfants';
$telephone 		= $_POST['TELEPHONE_PARENT'];


	if (empty($errors) === true){

		if(user_exists($conn, $_POST['EMAIL_PARENT'],$table_parent) === true && user_active($conn, $_POST['EMAIL_PARENT'], $table_parent) === true && $id !== user_id_from_username($conn, $_POST['EMAIL_PARENT'], $table_parent)){
			$errors[] = 'Désolé, un compte avec le mail '.$_POST['EMAIL_PARENT'].' existe déjà.';
		}

		if(validate_telephon(telephon_transform($telephone)) === false){
			$errors[] = 'Le numero de telephone n\'est pas valide';
		}
	}
}

if (empty($errors) === true && empty($_POST) === false){
	$today = date("Y-m-d H:i:s"); 
	

	$update_data_parents = array(
		'EMAIL'				=> addslashes($_POST['EMAIL_PARENT']),
		'TELEPHONE' 		=> addslashes(telephon_transform($_POST['TELEPHONE_PARENT'])),
		'ADRESSE' 			=> addslashes($_POST['ADRESSE_PARENT']),
		'POSTAL' 			=> addslashes($_POST['POSTAL_PARENT']),
		'VILLE'				=> addslashes($_POST['VILLE_PARENT']),
		);

	update_user($conn, $update_data_parents, $id, $table_parent);

	$update_data_enfant = array(
		'ADRESSE' 			=> addslashes($_POST['ADRESSE_ENFANT_1']),
		'POSTAL' 			=> addslashes($_POST['POSTAL_ENFANT_1']),
		'VILLE'				=> addslashes($_POST['VILLE_ENFANT_1']),
		'ECOLE'				=> addslashes($_POST['ECOLE_ENFANT_1']),
		'ANNEE_ETUDE'		=> addslashes($_POST['ANNEE_ETUDE_1']),
		'TELEPHONE_PARENT' 	=> addslashes(telephon_transform($_POST['TELEPHONE_PARENT'])),
		'MAIL_PARENT'		=> addslashes($_POST['EMAIL_PARENT']),
		);

	update_user($conn, $update_data_enfant, $id, $table_enfant);

	for($i=2; $i<=nombre_enfant_inscrit($conn, $id, $table_parent); $i++){
		$user_data_parent = user_data($conn, $id, 'Parents',  'ID', 'ADRESSE', 'POSTAL', 'VILLE', 'TELEPHONE', 'NOM_ENFANT', 'PRENOM_ENFANT', 'EMAIL', 'PASSWORD', 'LIEN_PARENTAL', 'NOM_ENFANT_2', 'PRENOM_ENFANT_2', 'NOM_ENFANT_3', 'PRENOM_ENFANT_3', 'NOM_ENFANT_4', 'PRENOM_ENFANT_4');

		$child = child_data($conn, 'Enfants' , $user_data_parent['NOM_ENFANT_'.$i.''], $user_data_parent['PRENOM_ENFANT_'.$i.'']);

		$update_data_enfant_i = array(
			'ADRESSE' 			=> addslashes($_POST['ADRESSE_ENFANT_'.$i.'']),
			'POSTAL' 			=> addslashes($_POST['POSTAL_ENFANT_'.$i.'']),
			'VILLE'				=> addslashes($_POST['VILLE_ENFANT_'.$i.'']),
			'ECOLE'				=> addslashes($_POST['ECOLE_ENFANT_'.$i.'']),
			'ANNEE_ETUDE'		=> addslashes($_POST['ANNEE_ETUDE_'.$i.'']),
			'TELEPHONE_PARENT' 	=> addslashes(telephon_transform($_POST['TELEPHONE_PARENT'])),
			'MAIL_PARENT'		=> addslashes($_POST['EMAIL_PARENT']),
			);

		$id_enfant=$child['ID'];

		update_user($conn, $update_data_enfant_i, $id_enfant, $table_enfant);
	
	}

	
	header('Location: mon-espace.php?modifierinfos');
	exit();

} else if (empty($errors) === false){
	//include 'core/init.php';
	include 'includes/upper.php'; 
	echo '<div class="bloc bgc-white-smoke l-bloc" id="bloc-11"><div class="container bloc-lg"><div class="row">';
		include 'includes/client_modifier_infos.php';
		include 'includes/client_side_menu.php';


	echo '</div></div></div>';

	include 'includes/lower.php';
}
?>
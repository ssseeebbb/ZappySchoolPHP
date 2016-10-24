<?php

function delete_line($conn, $id, $table){
	$sql = "DELETE FROM $table WHERE ID=$id";
	$query = mysqli_query($conn, $sql) or die (mysqli_error($conn));
	}

function get_prices($conn, $table){
	$table_data=array();
	$sql = "SELECT * FROM $table";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;

}

function get_values($conn, $table, $champ){
	$table_data=array();
	$sql = "SELECT $champ FROM $table";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}

function get_value($conn, $table, $id, $champ){
	$table_data=array();
	$sql = "SELECT $champ FROM $table WHERE ID=$id";
	$query = mysqli_query($conn, $sql);

	$data = mysqli_fetch_assoc($query);
	return $data[''.$champ.''];
}




function get_table($conn, $table){
	$table_data=array();
	$today = date("Y-m-d");
	$fin = date("Y-m-d",strtotime('+14 day'));

	$sql = "SELECT * FROM $table WHERE DATE_HORAIRE>='$today' AND DATE_HORAIRE<='$fin' ORDER BY DATE_HORAIRE ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}

function get_data_cours($conn, $table, $nombreJours, $offset){
	$table_data=array();
	$debut = date("Y-m-d",strtotime('+'.$offset.' day'));
	$fin = date("Y-m-d",strtotime('+'.($offset+$nombreJours).' day'));

	$sql = "SELECT * FROM $table WHERE DATE_HORAIRE>='$debut' AND DATE_HORAIRE<'$fin' ORDER BY DATE_HORAIRE ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}




function get_name_table_cours($conn, $table){
	$table_data=array();

	$sql = "SELECT ID, NOM_ENFANT, PRENOM_ENFANT FROM $table ORDER BY NOM_ENFANT ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}

function get_name_table_cours_prof($conn, $table){
	$table_data=array();

	$sql = "SELECT ID, NOM_PROFESSEUR, PRENOM_PROFESSEUR FROM $table ORDER BY NOM_PROFESSEUR ASC";
	$query = mysqli_query($conn, $sql) or die (mysqli_error($conn));

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}



function get_name_table($conn, $table){
	$table_data=array();

	$sql = "SELECT * FROM $table ORDER BY NOM ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}


function get_table_brut($conn, $table){
	$table_data=array();

	$sql = "SELECT * FROM $table";
	$query = mysqli_query($conn, $sql) or die (mysqli_error($conn));

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}

function get_name_actif_table($conn, $table){
	$table_data=array();

	$sql = "SELECT ID, NOM, PRENOM, ACTIF FROM $table WHERE ACTIF=1 ORDER BY NOM ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}

function get_prof_table($conn, $table){
	$table_data=array();

	$sql = "SELECT * FROM $table WHERE ACTIF='1' ORDER BY MATIERE_PROF_1, NOM  ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}

function get_table_cours($conn, $table){
	$table_data=array();
	$today = date("Y-m-d");
	$fin = date("Y-m-d",strtotime('+14 day'));

	$sql = "SELECT * FROM $table WHERE DATE_HORAIRE>='$today' AND DATE_HORAIRE<='$fin' ORDER BY DATE_HORAIRE, HEURE_DEBUT ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;
}


function get_filter_table($conn, $table, $where, $orderby){
	$table_data=array();

	$sql = "SELECT * FROM $table $where $orderby";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;

}


function get_table_cours_tot($conn, $table){
	$table_data=array();

	$sql = "SELECT * FROM $table ORDER BY DATE_HORAIRE ASC";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) > 0) {
	    while($row = mysqli_fetch_assoc($query)) {
	    	$table_data[]= $row;
	    }	
	}
	return $table_data;


}



function date_exist($conn, $table, $jour){
	$sql = "SELECT * FROM $table WHERE DATE_HORAIRE='$jour'";
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query)>0){
		return true;
	} else{
		return false;
	}
}

function modify_prix($conn, $table, $categorie, $prix){
	mysqli_query($conn, "UPDATE $table SET PRIX=$prix WHERE CATEGORIE='$categorie' ") or die (mysqli_error($conn));
}

function modify_ouverture($conn, $table, $jour, $ouverture, $fermeture){
	mysqli_query($conn, "UPDATE $table SET HEURE_DEBUT='$ouverture', HEURE_FIN='$fermeture' WHERE DATE_HORAIRE = '$jour'") or die (mysqli_error($conn));
}


function insert_ouverture($conn, $table, $jour, $ouverture, $fermeture){
	mysqli_query($conn, "INSERT INTO $table (`DATE_HORAIRE`, `HEURE_DEBUT`, `HEURE_FIN`) VALUES ('$jour', '$ouverture', '$fermeture')");
}



function nombre_enfant_inscrit($conn, $id, $table){

	$sql = "SELECT * FROM $table WHERE ID=$id";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($query);

	if (empty($row['NOM_ENFANT_2']) == true){
		return 1;
	}
	else if(empty($row['NOM_ENFANT_3']) == true){
		return 2;
	}
	else if(empty($row['NOM_ENFANT_4']) == true){
		return 3;
	}
	else {
		return 4;
	}
}



function update_user($conn, $update_data, $session_user_id, $table){
	$update = array();
	array_walk($update_data, 'array_sanitize', $conn);
	foreach ($update_data as $field => $data) {
		$update[]= ''.$field.'=\''.$data.'\'';
	}
	$query_line = implode(', ',$update);
	mysqli_query($conn, "UPDATE $table SET $query_line WHERE ID = $session_user_id") or die (mysqli_error($conn));
}



function change_password($conn, $user_id, $password, $table){
	$user_id = (int)$user_id;
	$password = md5($password);

	mysqli_query($conn, "UPDATE $table SET PASSWORD='$password' WHERE ID='$user_id'");
}

function register_user($conn, $register_data, $table){
	array_walk($register_data, 'array_sanitize', $conn);
	$register_data['PASSWORD'] = md5($register_data['PASSWORD']);
	
	$fields = '`'.implode('`, `', array_keys($register_data)).'`';
	$data   = '\''.implode('\', \'', $register_data).'\'';

	mysqli_query($conn, "INSERT INTO $table ($fields) VALUES ($data)");
}

function register_user_no_password($conn, $register_data, $table){
	array_walk($register_data, 'array_sanitize', $conn);
	
	$fields = '`'.implode('`, `', array_keys($register_data)).'`';
	$data   = '\''.implode('\', \'', $register_data).'\'';

	mysqli_query($conn, "INSERT INTO $table ($fields) VALUES ($data)") or die (mysqli_error($conn));
}



function user_count($conn, $table){
	$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(ID) FROM $table WHERE active = 1"));
	return $data['COUNT(ID)'];
}


function user_data($conn, $user_id, $table){
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if ($func_num_args > 2){
		unset($func_get_args[0]);
		unset($func_get_args[1]);
		unset($func_get_args[2]);

		$fields = ''.implode(', ', $func_get_args).'';
		$sql_query   =  "SELECT $fields FROM $table WHERE ID = '$user_id'";
		$query = mysqli_query($conn, $sql_query);

		$data = mysqli_fetch_assoc($query);
		return $data;
	}

}

function is_admin($conn, $table){
	$id = $_SESSION['ID'];
	$sql = "SELECT * FROM $table WHERE ID=$id AND ACTIF=2";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		return true;
	} else{
		return false;
	}
}

function logged_in(){
	return(isset($_SESSION['ID'])) ? true :false;
}

function is_registering(){
	return(isset($_SESSION['ID_REGISTER'])) ? true :false;
}


function user_exists($conn, $mail, $table){
	$mail=sanitize($conn, $mail);
	$sql = "SELECT * FROM $table WHERE EMAIL='$mail'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		return true;
	} else{
		return false;
	}
}


function prof_exists($conn, $nom, $prenom, $table){
	$nom=sanitize($conn, $nom);
	$prenom=sanitize($conn, $prenom);

	$sql = "SELECT * FROM $table WHERE NOM_PROFESSEUR='$nom' AND PRENOM_PROFESSEUR='$prenom'";
	$query = mysqli_query($conn,$sql);

	if(mysqli_num_rows($query)>0){
		return true;
	} else{
		return false;
	}
}

function child_data($conn, $table , $nom, $prenom){

	$sql = "SELECT * FROM $table WHERE NOM='$nom' AND PRENOM='$prenom'";
	$query = mysqli_query($conn,$sql) or die (mysqli_error($conn));

	$row = mysqli_fetch_assoc($query);

	return $row;
}





function child_exists($conn, $nom, $prenom, $table){
	$nom=sanitize($conn, $nom);
	$prenom=sanitize($conn, $prenom);

	$sql = "SELECT * FROM $table WHERE NOM='$nom' AND PRENOM='$prenom'";
	$query = mysqli_query($conn,$sql);

	if(mysqli_num_rows($query)>0){
		return true;
	} else{
		return false;
	}
}

function child_birth_test($conn, $nom, $prenom, $naissance,  $table){
	$nom=sanitize($conn, $nom);
	$prenom=sanitize($conn, $prenom);
	$naissance=sanitize($conn, $naissance);

	$sql = "SELECT * FROM $table WHERE NOM='$nom' AND PRENOM='$prenom' AND NAISSANCE='$naissance'";
	$query = mysqli_query($conn,$sql);

	if(mysqli_num_rows($query)>0){
		return true;
	} else{
		return false;
	}
}




function user_active($conn, $mail, $table){
	$mail=sanitize($conn, $mail);
	$sql = "SELECT * FROM $table WHERE EMAIL='$mail' AND ACTIF=1 OR ACTIF=2";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		return true;
	} else{
		return false;
	}
}

function user_id_from_name_and_surname($conn, $nom, $prenom, $table){
	$nom = sanitize($conn, $nom);
	$prenom = sanitize($conn, $prenom);
	$sql = "SELECT ID FROM $table WHERE NOM='$nom' AND PRENOM='$prenom'";
	$query = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($query);
	$id = $row['ID'];
	return $id;
}

function user_id_from_username($conn, $mail, $table){
	$mail = sanitize($conn, $mail);
	$sql = "SELECT ID, EMAIL FROM $table WHERE EMAIL='$mail'";
	$query = mysqli_query($conn,$sql);

	$row = mysqli_fetch_assoc($query);
	$id = $row['ID'];

	return $id;
}

function username_from_user_id($conn, $id, $table){
	$sql = "SELECT ID, EMAIL FROM $table WHERE ID=$id";
	$query = mysqli_query($conn,$sql);

	$row = mysqli_fetch_assoc($query);
	$email = $row['EMAIL'];

	return $email;
	

}


function login($conn, $mail, $password, $table){
	$user_id = user_id_from_username($conn, $mail, $table);
	
	$mail = sanitize($conn, $mail);
	$password=md5($password);

	$sql = "SELECT * FROM $table WHERE EMAIL='$mail' AND PASSWORD='$password'";
	$query = mysqli_query($conn, $sql);

	return (mysqli_num_rows($query)>0) ? $user_id : false;
}
?>
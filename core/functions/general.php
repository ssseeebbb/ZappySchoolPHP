<?php
function logged_in_redirect(){
	if(logged_in() === true){
		header('Location: mon-espace.php');
	}
}

function protect_page(){
	if(logged_in() === false){
		header('Location:protected.php');
	}
}

function array_sanitize($value, $key, $bdd){
	$item = htmlentities(strip_tags(mysqli_real_escape_string($bdd, $value)));
}
function sanitize($bdd, $data){
	$data_sani = htmlentities(strip_tags(mysqli_real_escape_string($bdd, $data)));
	return $data_sani;
}


function output_errors($errors){
	$output = array();
	foreach($errors as $error){
		$output[]='<li>'.$error.'</li>';
	}
	return '<b>Erreur</b> : <br> <ul class="list-unstyled">'.implode('', $output).'</ul>';
}

function validateDate($date){
    $d = DateTime::createFromFormat('d-m-Y', $date);
    return $d && $d->format('d-m-Y') === $date;
}

function telephon_transform($telephone){
	$telephone_modif1 = preg_replace("/[+]/",'00',$telephone); // transforme le + en deux zéros
	$telephone_modif2 = preg_replace("/[^0-9]/i",'',$telephone_modif1); 	//Retire tout ce qui n'est pas un chiffre
	return $telephone_modif2;

}

function validate_telephon($telephone){
	if(strlen($telephone)>=9 && strlen($telephone)<=13){
		return true;
	} else {  
		return false;
	}
}

function validate_code_postal($postal){
	if ( preg_match ( '`^\d{2,}$`', $postal ) ){
		return true;
	} else{
		return false;
	}
}

function convertToHoursMins($time, $format = '%02d:%02d') {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function gcf($a, $b) { 
	return ( $b == 0 ) ? ($a):( gcf($b, $a % $b) ); 
}
function lcm($a, $b) { 
	return ( $a / gcf($a,$b) ) * $b; 
}
function lcm_nums($ar) {
	if (count($ar) > 1) {
		$ar[] = lcm( array_shift($ar) , array_shift($ar) );
		return lcm_nums( $ar );
	} else {
		return $ar[0];
	}
}



?>
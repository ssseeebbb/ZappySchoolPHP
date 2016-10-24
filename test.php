<?php 
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

$nombre= array(80, 4, 5, 6);

echo lcm_nums($nombre);

?>
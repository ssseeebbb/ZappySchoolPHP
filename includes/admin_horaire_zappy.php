<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Planning
	</h2>

	<style type="text/css">
		.table .bleu-lapis		{background-color:#086DA8;color:#fff;}
		.table .antiqueWhite 	{background-color:#FAEBD7;color:#000;}
		.table .aqua 			{background-color:#00FFFF;color:#000;}
		.table .aquamarine 		{background-color:#7FFFD4;color:#000;}
		.table .blueViolet 		{background-color:#8A2BE2;color:#fff;}
		.table .brown 			{background-color:#A52A2A;color:#000;}
		.table .cadetBlue 		{background-color:#5F9EA0;color:#000;}
		.table .cornflowerBlue 	{background-color:#6495ED;color:#fff;}
		.table .darkBlue		{background-color:#00008B;color:#fff;}
		.table .deepPink 		{background-color:#FF1493;color:#fff;}
		.table .Gray 			{background-color:#808080;color:#fff;}
		.table .HotPink 		{background-color:#FF69B4;color:#fff;}
		.table .RoyalBlue 		{background-color:#4169E1;color:#fff;}
		.table .Indigo  		{background-color:#4B0082;color:#fff;}
		.table .Lavender 		{background-color:#E6E6FA;color:#000;}
		.table .LightBlue  		{background-color:#ADD8E6;color:#000;}
		.table .LightCoral  	{background-color:#F08080;color:#000;}
		.table .LightGreen  	{background-color:#90EE90;color:#000;}
		.table .LightPink  		{background-color:#FFB6C1;color:#000;}
		.table .LightSalmon  	{background-color:#FFA07A;color:#000;}
		.table .LightSeaGreen  	{background-color:#20B2AA;color:#000;}
		.table .LightSkyBlue  	{background-color:#87CEFA;color:#000;}
		.table .LightSlateGray  {background-color:#778899;color:#000;}



		
	</style>

	<?php 
		/*Valeurs par défaut*/

		
		if (!isset($_SESSION['OffsetJour'])){
			$_SESSION['OffsetJour'] = 0;
		}

		$offset_jour = $_SESSION['OffsetJour'];
		

		if (empty($_POST) === true){
			$offset_jour=0;
		} else if(isset($_POST['submitMoins'])){
			$offset_jour = $offset_jour - 1;

		} else if(isset($_POST['submitPlus'])){
			$offset_jour = $offset_jour + 1;
		}

		$_SESSION['OffsetJour'] = $offset_jour;

		$nombre_jours_affiche = 1;

		$heures_horaire = array();
		for($i = 8; $i<20 ; $i++){
			for($j=0; $j<60 ; $j+=15){
				if($j==0){
					$j='00';
				}
				$heures_horaire[] = ''.$i.':'.$j.'';
			}
		}
		$couleurs=array(
			'bleu-lapis', 'antiqueWhite', 'aqua', 'aquamarine', 'blueViolet', 'brown', 'cadetBlue', 'cornflowerBlue', 'darkBlue', 'deepPink', 'Gray', 'HotPink', 'RoyalBlue', 'Indigo', 'Lavender', 'LightBlue', 'LightCoral', 'LightGreen', 'LightPink', 'LightSalmon', 'LightSeaGreen', 'LightSkyBlue', 'LightSlateGray',
			);


	?>


	<form action="" method="POST">
		<div class="col-sm-3">
			<div class="text-center">
				<button class="bloc-button btn   btn-md btn-lapis-lazuli" type="submit" name="submitMoins" value = "moins">
					<span class="ion ion-arrow-left-c icon-anti-flash-white icon-spacer"></span>
				</button>
			</div>
		</div>
			<div class="col-sm-6">
				<text class="form-control">
					<?php echo date("l d-m-Y",strtotime('+'.$offset_jour.' day')).'';?>
				</text>
			</div>
			<div class="col-sm-3">
			<div class="text-center">
					<button class="bloc-button btn   btn-md btn-lapis-lazuli" type="submit" name="submitPlus" value = "plus">
						<span class="ion ion-arrow-right-c icon-anti-flash-white icon-spacer"></span>
					</button>

			</div>
		</div>
	</form>


	<table class="table" border="1">

	<?php


	//On va chercher les donnees dans la base de donnees
		$table='Cours';
		$data = array();
		$data_cours = get_data_cours($conn, $table, $nombre_jours_affiche, $offset_jour);
		foreach ($data_cours as $cours) {
			$nom= ''.$cours['PRENOM_ENFANT'].' '.$cours['NOM_ENFANT'].'';
			$jour = $cours['DATE_HORAIRE'];
			$debut = $cours['HEURE_DEBUT'];
			$duree = $cours['DUREE'];
			$id = $cours['ID'];

			$duree_minute = (((int)  strtok($duree, ':'))*60) + (int) substr($duree, -2);
			$nombre_iteration = ($duree_minute/15);

			$heure_list=array();
			for($i=0; $i<$nombre_iteration; $i++){
				$debut_minute = (((int)  strtok($debut, ':'))*60) + (int) substr($debut, -2);
				$heure_minute = $debut_minute + $i*15;
				$heure= convertToHoursMins($heure_minute, '%02d:%02d');
				$data[$jour][$heure][$id]=$nom;
			
			}
		}
	/*On calcule le colspan en fonction des jours à afficher*/
	//Par defaut
		$colspan=array();
		
		for($i=0; $i<$nombre_jours_affiche; $i++){
			$colspan[]=1;
		}


		$increment = 0;
		$id_cours_journee=array();
		foreach ($data as $jour) {
			$nombre_client=array();
			foreach($jour as $heure){
				foreach ($heure as $key => $value) {
					if(!array_key_exists($key, $id_cours_journee)){
						$id_cours_journee[$key]=0;
					} 
				}
			}
			$colspan[$increment] = count($id_cours_journee);
			$increment += 1;
		}

	/*Chaque cours a son propre colspan*/


	//Information sur chaque cours : [0]=> nombre max d'eleve sur la journée, [1]=>position dans le tableau , [2]=>Couleur
	
	$cours_info=array();
	foreach($data as $jour){
		$nombre_max_eleve=0;
		foreach ($jour as $heure) {
			foreach($heure as $key => $nom){
				if(!array_key_exists($key, $cours_info)){
					$cours_info[$key]=0;
				} 
				$cours_info[$key]=array(count($id_cours_journee));
			}
		}
	}

	//Ajouter Position
	$position = 0;
	foreach($cours_info as $key_element => $element){
		array_push($cours_info[$key_element],  $position);
		$position+=1;
	}

	//Ajouter Couleur
	$cou = 0;
	foreach($cours_info as $key_element => $element){

		array_push($cours_info[$key_element],  $couleurs[$cou]);
		$cou+=1;
		if($cou >= 23){
			$cou=0;
		}
	}


	/*On imprime l'entete*/
		echo '<tr><th ></th>';
		for($i=$offset_jour; $i<($nombre_jours_affiche + $offset_jour); $i++){
			 echo '<th class="text-center" colspan="'.$colspan[($i- $offset_jour)].'">';
			 echo date("l d-m-Y",strtotime('+'.$i.' day')).'</th>';
		}
		echo '</tr>';
		

		foreach ($heures_horaire as $key => $heure){
			echo '<tr><td class="text-center" >'.$heure.'</td>';
			for($jour=$offset_jour; $jour<($nombre_jours_affiche+$offset_jour); $jour++){
				$date = date("Y-m-d",strtotime('+'.$jour.' day'));
				if (array_key_exists($date, $data)) {
					if(array_key_exists($heure, $data[$date])){
						$array = $data[$date][$heure];
						$cles = array_keys($array);

						
						$horaire_heure=array();

						foreach ($cles as $numberKey =>$key) {
							$maximum = $cours_info[$key][0];
							$colspan_cours = ($colspan[($jour-$offset_jour)]/$cours_info[$key][0]);
							$position_cours = $cours_info[$key][1];
							$couleur = $cours_info[$key][2];

							$horaire_heure[$position_cours]=array($colspan_cours, $couleur );
						}
						ksort($horaire_heure);
						$i=0;
						foreach ($horaire_heure as $id => $hor) {
							$maximum = $cours_info[$key][0];
							$colspan_cours = $hor[0];
							$position_cours = $id;
							$couleur = $hor[1];

							if($position_cours>$i){
								for ($j=$i; $j<$position_cours; $j++){
									echo '<td class=" text-center " colspan="'.$colspan_cours.'"> - </td>';

								}
							} 
							$i=$position_cours + 1;
							echo '<td class=" '.$couleur.' text-center" colspan="'.$colspan_cours.'" > '.$data[$date][$heure][$key].' </td>';
						}
						if($i<$maximum){
							for ($j=$i; $j<$maximum; $j++){
								echo '<td class=" text-center " colspan="'.$colspan_cours.'"> - </td>';
							}
						}
					} 
					else{
						echo '<td class=" text-center " colspan="'.$colspan[$jour-$offset_jour].'"> - </td>';
					}
				}
				else{
					echo '<td class=" text-center " colspan="'.$colspan[$jour-$offset_jour].'"> - </td>';
				}
			}
			echo'</tr>';
		}




	?>

		</table>




	<div class="col-sm-12">
		<div class="text-center">
			<a href="mon-espace.php?adminChangerUneDate" class="btn  btn-bouton-gris  btn-lg">Modifier une date</a>
		</div>
	</div>
</div>
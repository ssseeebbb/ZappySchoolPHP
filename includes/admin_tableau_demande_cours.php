<table class="table table-striped">
	  <tr>
	  	<th> ID </th> 
	    <th >Prenom</th>
	    <th >Nom</th>
	    <th >Matière</th>
	    <th >Professeur</th>
	    <th >Date</th>
	    <th >Heure de début</th>
	    <th >Durée</th>
	    <th> Type</th>
	    <th> Statut </th>
	  </tr>

	  <?php  
		$table_data = get_table_cours($conn, 'Cours');
	  	foreach($table_data as $cours){


	  		$id = $cours['ID'];
	  		$prenom = $cours['PRENOM_ENFANT'];
	  		$nom = $cours['NOM_ENFANT'];
	  		$prof = $cours['NOM_PROFESSEUR'];
	  		$date = $cours['DATE_HORAIRE'];
	  		$heure_debut = $cours['HEURE_DEBUT'];
	  		$duree = $cours['DUREE'];
	  		$matiere = $cours['MATIERE'];
	  		$type_cours = $cours['TYPE_COURS'];
	  		$statut = $cours['STATUT'];
	  		
	  		echo '<tr><td>'.$id.'</td>';
	  		echo '<td>'.$prenom.'</td>';
	  		echo '<td>'.$nom.'</td>';
	  		echo '<td>'.$matiere.'</td>';
			echo '<td>'.$prof.'</td>';
	  		echo '<td>'.$date.'</td>';
	  		echo '<td>'.$heure_debut.' </td>';
	  		echo '<td>'.$duree.' heures </td>';
	  		echo '<td>'.$type_cours.' </td>';
	  		echo '<td>'.$statut.' </td></tr>';

	  	}

	  ?>
</table>
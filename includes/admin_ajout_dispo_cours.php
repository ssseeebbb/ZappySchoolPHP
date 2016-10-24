<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Ajoute un professeur au planning
	</h2>
	<form method="POST" action="mon_profil.php">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Professeur
					</label>
					<select class="form-control" name="DATE_COURS">
					  <option>1ère secondaire</option>
					  <option>2ème secondaire</option>
					  <option>3ème secondaire</option>
					  <option>4ème secondaire</option>
					  <option>5ème secondaire</option>
					  <option>6ème secondaire</option>
					</select>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Date (Annee - Mois - Jour)
					</label>
					<input class="form-control" name="DATE" />
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Heure de début :
					</label>
					<select class="form-control" name="HEURE_DEBUT">
					  <option>1ère secondaire</option>
					  <option>2ème secondaire</option>
					  <option>3ème secondaire</option>
					  <option>4ème secondaire</option>
					  <option>5ème secondaire</option>
					  <option>6ème secondaire</option>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Heure de fin :
					</label>
					<!-- <input class="form-control" name="ANNEE_ETUDE" /> -->
					<select class="form-control" name="DUREE">
					  <option>1 heure</option>
					  <option>1 heure 30</option>
					  <option>2 heures </option>
					  <option>2 heures 30</option>
					  <option>3 heures</option>
					  <option>3 heures 30</option>
					  <option>4 heures</option>
					  <option>4 heures 30</option>
					  <option>5 heures</option>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Matière à voir :
					</label>
					<!-- <input class="form-control" name="ANNEE_ETUDE" /> -->
					<select class="form-control" name="MATIERE">
					  <option>Mathématique</option>
					  <option>Sciences</option>
					  <option>Anglais / Néerlandais</option>
					  <option>4ème secondaire</option>
					  <option>5ème secondaire</option>
					  <option>6ème secondaire</option>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="text-center">
					<a href="index.html" class="btn  btn-bouton-gris  btn-lg">Ajouter le professeur au planning</a>
				</div>
			</div>
		</div>
	</form>
</div>
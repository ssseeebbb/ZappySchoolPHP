<div class="col-sm-8">
	<h2 class="mg-md text-center">
		Modifier le planning
	</h2>
	<form method="POST" action="process_admin_ouverture_solo.php">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>
						Jour
					</label>
					<select class="form-control" name="DATE_OUVERTURE" >
						<?php 

						for ($day=0;$day<30;$day++){

							echo '<option>'.date("Y-m-d",strtotime('+'.$day.' day')) .'</option>';
						
						}
						?>
					</select>

				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>
						Ouverture
					</label>
					<select class="form-control" name="OUVERTURE_COURS" >
						<option>8:00</option>
						<option>9:00</option>
						<option>10:00</option>
						<option>11:00</option>
						<option>12:00</option>
						<option>13:00</option>
						<option>14:00</option>
						<option selected="selected">15:00</option>
						<option>16:00</option>
						<option>17:00</option>
						<option>18:00</option>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group">
					<label>
						Fermeture
					</label>
					<select class="form-control" name="FERMETURE_COURS">
						<option>9:00</option>
						<option>10:00</option>
						<option>11:00</option>
						<option>12:00</option>
						<option>13:00</option>
						<option>14:00</option>
						<option>15:00</option>
						<option>16:00</option>
						<option>17:00</option>
						<option>18:00</option>
						<option selected="selected" >19:00</option>
						<option>20:00</option>
					</select>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="text-center">
					<button type="submit" class="btn  btn-lapis-lazuli  btn-lg">Actualiser le planning</button>
				</div>
			</div>
		</div>
	</form>
</div>
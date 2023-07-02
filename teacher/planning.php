<?php

//========================================================================
// Author:  Valéry Jérôme Michaux
// Resume:  http://cafe-lingua.org
//
// Copyright (c) 2017 Valéry Jérôme Michaux
//
// Published under the OpenSource license with restiction : https://github.com/michaux4/SchoolManagementSoftware
//          Consider it as a proof of concept!
//          No warranty of any kind.
//          Use and abuse at your own risks.
//========================================================================


include 'menuhead.php';
include './php/class/planning.php';

$myPlanning = new Planning();
?>


<section>
	<div class="col-lg-12 text-center">
		<h2>Üblicher Stundenplans</h2>
	</div>
	<form id="form1" name="form1" method="post">



		<table width="300%" border="0" align="center">

			<td>Jahr</td>
			<td>
				<select name="c1" style="width:170px;">

					<?php
					$requete = 'SELECT years FROM `years` order by years desc';
					$result = mysqli_query($cn, $requete);

					$requeteActuelle = 'SELECT year FROM `reference`';
					$resultAct = mysqli_query($cn, $requeteActuelle);
					$selecAct = mysqli_fetch_array($resultAct);



					while ($ligne = mysqli_fetch_array($result)) {
						if (!empty($_POST["c1"])) {
							$selectionnee = ($ligne[0] == $_POST["c1"]) ? " SELECTED " : "";
						} else {
							$selectionnee = ($ligne[0] == $selecAct[0]) ? " SELECTED " : "";
						}


						echo "<option value='", addslashes($ligne['years']), "' $selectionnee >", addslashes($ligne['years']), '</option>';

					}

					?>
				</select>


				&nbsp;
			</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Schulhalbjahr</td>
				<td><select name="c2" style="width:170px;">

						<?php
						$requete = 'SELECT semester FROM `semester`';
						$result = mysqli_query($cn, $requete);

						$requeteActuelle = 'SELECT semester FROM `reference`';
						$resultAct = mysqli_query($cn, $requeteActuelle);
						$selecAct = mysqli_fetch_array($resultAct);


						while ($ligne = mysqli_fetch_array($result)) {

							if (!empty($_POST["c2"])) {
								$selectionnee = ($ligne[0] == $_POST["c2"]) ? " SELECTED " : "";
							} else {
								$selectionnee = ($ligne[0] == $selecAct[0]) ? " SELECTED " : "";
							}

							echo "<option value='", addslashes($ligne['semester']), "' $selectionnee >", addslashes($ligne['semester']), '</option>';
						}
						?>
					</select>

				<td>&nbsp;</td>
			</tr>

			<tr>
				<td>Klasse</td>
				<td><select name="c3" style="width:170px;">
						<option value="">Wählen Sie aus</option>

						<?php
						$requete = 'SELECT classe FROM `classe` ORDER BY id ASC';
						$result = mysqli_query($cn, $requete);
						while ($ligne = mysqli_fetch_array($result)) {
							$selectionnee = ($ligne[0] == $_POST["c3"]) ? " SELECTED " : "";
							echo "<option value='", addslashes($ligne['classe']), "' $selectionnee >", addslashes($ligne['classe']), '</option>';
						}
						?>
					</select>

					&nbsp;</td>
				<td><input name="b2" type="submit" class="btn btn-success" value="Suchen" id="b2"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>


		</table>
		<?php

		// insert a course SQL code
		if (isset($_POST['b3'])) {

			if ($_POST['c3'] == '') {
				echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Es gibt bereits einen Unterricht. </center></b></font><br>";
			} else {

				if (!isset($_POST['prof'])) {
					echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Ein Lehrer muss verfügbar sein. </center></b></font><br>";

				} else {
					$requete = "SELECT * FROM `planning` where hour = '" . addslashes($_POST['hour']) . "' and day ='" . addslashes($_POST['day']) . "' and classe ='" . addslashes($_POST['c3']) . "' and semester ='" . addslashes($_POST['c2']) . "' and year ='" . addslashes($_POST['c1']) . "'";
					$result = mysqli_query($cn, $requete);
					$resultat = mysqli_fetch_array($result);

					if ($resultat != 0) {
						echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Es gibt bereits einen Unterricht. </center></b></font><br>";
					} else {

						$dr = mysqli_query($cn, "INSERT INTO planning (`classe`, `year`, `semester`, `hour`, `course`, `room`, `day`, `prof` ) VALUES ('" . addslashes($_POST['c3']) . "','" . addslashes($_POST['c1']) . "','" . addslashes($_POST['c2']) . "','" . addslashes($_POST['hour']) . "','" . addslashes($_POST['course']) . "','" . addslashes($_POST['room']) . "','" . addslashes($_POST['day']) . "','" . addslashes($_POST['prof']) . "')");
					}
				}


			}
		}

		// Delete a course
		if (isset($_POST['submit'])) {
			$dr = mysqli_query($cn, "DELETE FROM planning where code='" . addslashes($_POST['submit']) . "'");
		}

		if (isset($_POST['b2']) or isset($_POST['b3']) or isset($_POST['submit'])) {

			$sql = $myPlanning->viewPlanning(addslashes($_POST['c3']), addslashes($_POST['c1']), addslashes($_POST['c2']));

			$dr = mysqli_query(
				$cn,
				$sql
			);
			// var_dump($sql);
			if (!empty($_POST["c3"])) {
				?>
				<!-- $requete = "SELECT * FROM `planning` where hour = '". addslashes($_POST['hour']) ."' and day ='". addslashes($_POST['day'])."' and classe ='". addslashes($_POST['c3'])."' and semester ='". addslashes($_POST['c2'])."' and year ='". addslashes($_POST['c1'])."'"; -->

				<table width="300" border="2" align="center" class="table-style-two">
					<tbody>
						<tr>
							<th><b>Stunde</b></th>
							<th><b>Montag</b></th>
							<th><b>Dienstag</b></th>
							<th><b>Mittwoch</b></th>
							<th><b>Donnerstag</b></th>
							<th><b>Freitag</b></th>
							<th><b>Samstag</b></th>
						</tr>

						<?php

						while ($ligne = mysqli_fetch_array($dr)) {
							?>

							<tr>
								<td>
									<?php echo addslashes($ligne[0]); ?>
								</td>
								<td>
									<?php if ($ligne[1]) { ?>
										<button type="submit" name="submit" value="<?php echo $ligne[2]; ?>" class="btImg"><img
												src="../img/b_drop.png" data-toggle='tooltip' data-placement='top'
												title='Löschen'></button>
									<?php }
									// recherche de Liste de la classe occupante
									$ligneControlRoom = $myPlanning->countCourseRoomfHour($cn, addslashes($ligne['hour']), "Montag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[13]));

									// recherche de Liste de prof plusieurs fois à la même heure
									$ligneControlProf = $myPlanning->countCourseProffHour($cn, addslashes($ligne['hour']), "Montag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[13]), addslashes($ligne[25]));


									if ($ligneControlRoom[0] > '1') {
										//Liste de la classe occupante. 
										$errormessage = $myPlanning->listRoomsHour($cn, addslashes($ligne['hour']), "Montag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[13]));
										echo "<img src='../img/warning.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessage) . "' WIDTH=15 HEIGHT=15 />" . " ";
									}


									if ($ligneControlProf[0] > '0') {
										//Liste de prof plusieurs fois à la même heure
										$errormessageProf = $myPlanning->listCourseProfHour($cn, addslashes($ligne['hour']), "Montag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[13]), addslashes($ligne[25]));
										echo "<img src='../img/warning3.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessageProf) . "' WIDTH=15 HEIGHT=15 />" . " ";
									}
									echo addslashes($ligne[1]); ?>

									<br>
									<?php echo addslashes($ligne[13]); ?>
									&nbsp;
									<?php echo addslashes($ligne[19]); ?>

								</td>

								<td>
									<?php if ($ligne[3]) { ?>
										<button type="submit" name="submit" value="<?php echo $ligne[4]; ?>" class="btImg"><img
												src="../img/b_drop.png" data-toggle='tooltip' data-placement='top'
												title='Löschen'></button>
									<?php }
									// recherche de Liste de la classe occupante
									$ligneControlRoom = $myPlanning->countCourseRoomfHour($cn, addslashes($ligne['hour']), "Dienstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[14]));

									// recherche de Liste de prof plusieurs fois à la même classe la même heure
									$ligneControlProf = $myPlanning->countCourseProffHour($cn, addslashes($ligne['hour']), "Dienstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[14]), addslashes($ligne[26]));

									if ($ligneControlRoom[0] > '1') {

										//Liste de la classe occupante. 
										$errormessage = $myPlanning->listRoomsHour($cn, addslashes($ligne['hour']), "Dienstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[14]));
										echo "<img src='../img/warning.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessage) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									if ($ligneControlProf[0] > '0') {

										//Liste de prof plusieurs fois à la même heure
										$errormessageProf = $myPlanning->listCourseProfHour($cn, addslashes($ligne['hour']), "Dienstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[14]), addslashes($ligne[26]));
										echo "<img src='../img/warning3.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessageProf) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}
									?>

									<?php echo addslashes($ligne[3]); ?>
									<br>
									<?php echo addslashes($ligne[14]); ?>
									&nbsp;
									<?php echo addslashes($ligne[20]); ?>
								</td>
								<td>
									<?php if ($ligne[5]) { ?>
										<button type="submit" name="submit" value="<?php echo $ligne[6]; ?>" class="btImg"><img
												src="../img/b_drop.png" data-toggle='tooltip' data-placement='top'
												title='Löschen'></button>
									<?php }

									// recherche de Liste de la classe occupante
									$ligneControlRoom = $myPlanning->countCourseRoomfHour($cn, addslashes($ligne['hour']), "Mittwoche", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[15]));

									// recherche de Liste de prof plusieurs fois à la même classe la même heure
									$ligneControlProf = $myPlanning->countCourseProffHour($cn, addslashes($ligne['hour']), "Mittwoche", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[15]), addslashes($ligne[27]));

									if ($ligneControlRoom[0] > '1') {

										//Liste de la classe occupante. 
										$errormessage = $myPlanning->listRoomsHour($cn, addslashes($ligne['hour']), "Mittwoche", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[15]));
										echo "<img src='../img/warning.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessage) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									if ($ligneControlProf[0] > '0') {

										//Liste de prof plusieurs fois à la même heure
										$errormessageProf = $myPlanning->listCourseProfHour($cn, addslashes($ligne['hour']), "Mittwoche", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[15]), addslashes($ligne[27]));
										echo "<img src='../img/warning3.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessageProf) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									echo addslashes($ligne[5]); ?>
									<br>
									<?php echo addslashes($ligne[15]); ?>
									&nbsp;
									<?php echo addslashes($ligne[21]); ?>
								</td>
								<td>
									<?php if ($ligne[7]) { ?>
										<button type="submit" name="submit" value="<?php echo $ligne[8]; ?>" class="btImg"><img
												src="../img/b_drop.png" data-toggle='tooltip' data-placement='top'
												title='Löschen'></button>
									<?php }

									// recherche de Liste de la classe occupante
									$ligneControlRoom = $myPlanning->countCourseRoomfHour($cn, addslashes($ligne['hour']), "Donnerstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[16]));

									// recherche de Liste de prof plusieurs fois à la même classe la même heure
									$ligneControlProf = $myPlanning->countCourseProffHour($cn, addslashes($ligne['hour']), "Donnerstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[16]), addslashes($ligne[28]));

									if ($ligneControlRoom[0] > '1') {

										//Liste de la classe occupante. 
										$errormessage = $myPlanning->listRoomsHour($cn, addslashes($ligne['hour']), "Donnerstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[16]));
										echo "<img src='../img/warning.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessage) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									if ($ligneControlProf[0] > '0') {

										//Liste de prof plusieurs fois à la même heure
										$errormessageProf = $myPlanning->listCourseProfHour($cn, addslashes($ligne['hour']), "Donnerstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[16]), addslashes($ligne[28]));
										echo "<img src='../img/warning3.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessageProf) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									echo addslashes($ligne[7]); ?>
									<br>
									<?php echo addslashes($ligne[16]); ?>
									&nbsp;
									<?php echo addslashes($ligne[22]); ?>
								</td>
								<td>
									<?php if ($ligne[9]) { ?>
										<button type="submit" name="submit" value="<?php echo $ligne[10]; ?>" class="btImg"><img
												src="../img/b_drop.png" data-toggle='tooltip' data-placement='top'
												title='Löschen'></button>
									<?php }

									// recherche de Liste de la classe occupante
									$ligneControlRoom = $myPlanning->countCourseRoomfHour($cn, addslashes($ligne['hour']), "Freitag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[17]));

									// recherche de Liste de prof plusieurs fois à la même classe la même heure
									$ligneControlProf = $myPlanning->countCourseProffHour($cn, addslashes($ligne['hour']), "Freitag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[17]), addslashes($ligne[29]));

									if ($ligneControlRoom[0] > '1') {

										//Liste de la classe occupante. 
										$errormessage = $myPlanning->listRoomsHour($cn, addslashes($ligne['hour']), "Freitag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[17]));
										echo "<img src='../img/warning.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessage) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									if ($ligneControlProf[0] > '0') {

										//Liste de prof plusieurs fois à la même heure
										$errormessageProf = $myPlanning->listCourseProfHour($cn, addslashes($ligne['hour']), "Freitag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[17]), addslashes($ligne[29]));
										echo "<img src='../img/warning3.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessageProf) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									echo addslashes($ligne[9]); ?>
									<br>
									<?php echo addslashes($ligne[17]); ?>
									&nbsp;
									<?php echo addslashes($ligne[23]); ?>
								</td>
								<td>
									<?php if ($ligne[11]) { ?>
										<button type="submit" name="submit" value="<?php echo $ligne[12]; ?>" class="btImg"><img
												src="../img/b_drop.png" data-toggle='tooltip' data-placement='top'
												title='Löschen'></button>
									<?php }


									// recherche de Liste de la classe occupante
									$ligneControlRoom = $myPlanning->countCourseRoomfHour($cn, addslashes($ligne['hour']), "Samstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[18]));

									// recherche de Liste de prof plusieurs fois à la même classe la même heure
									$ligneControlProf = $myPlanning->countCourseProffHour($cn, addslashes($ligne['hour']), "Samstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[18]), addslashes($ligne[30]));

									if ($ligneControlRoom[0] > '1') {

										//Liste de la classe occupante. 
										$errormessage = $myPlanning->listRoomsHour($cn, addslashes($ligne['hour']), "Samstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[18]));
										echo "<img src='../img/warning.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessage) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									if ($ligneControlProf[0] > '0') {

										//Liste de prof plusieurs fois à la même heure
										$errormessageProf = $myPlanning->listCourseProfHour($cn, addslashes($ligne['hour']), "Samstag", addslashes($_POST['c1']), addslashes($_POST['c2']), addslashes($ligne[18]), addslashes($ligne[30]));
										echo "<img src='../img/warning3.png' data-toggle='tooltip' data-placement='top' title='" . addslashes($errormessageProf) . "' WIDTH=15 HEIGHT=15 />" . " ";

									}

									echo addslashes($ligne[11]); ?>
									<br>
									<?php echo addslashes($ligne[18]); ?>
									&nbsp;
									<?php echo addslashes($ligne[24]); ?>
								</td>
							</tr>

							<?php
						}

						?>
					</tbody>
				</table>

				<br><br>

				<table width="300" border="2" align="center" class="table-style-two">
					<tbody>
						<tr>
							<center><strong>Stunde hinzufügen</strong></center><br>
						</tr>
						<tr>
							<th>
								<center><b>Stunde</b></center>
							</th>
							<th>
								<center><b>Tag</b></center>
							</th>
							<th>
								<center><b>Fach</b></center>
							</th>
							<th>
								<center><b>Lehrer</b></center>
							</th>
							<th>
								<center><b>Raum</b></center>
							</th>

						</tr>
						<tr>

							<td><select name="hour" style="width:60px;">
									<?php
									$requete = 'SELECT * FROM `hour`';
									$result = mysqli_query($cn, $requete);
									while ($ligne = mysqli_fetch_array($result)) {
										if (!empty($_POST["hour"])) {
											$selectionnee = ($ligne[0] == $_POST["hour"]) ? " SELECTED " : "";
										} else {
											$selectionnee = ($ligne[0] == $selecAct[0]) ? " SELECTED " : "";
										}
										echo "<option value='", addslashes($ligne['hour']), "' $selectionnee >", addslashes($ligne['hour']), '</option>';
									}
									?>
								</select></td>

							<td><select name="day" style="width:100px;">
									<option <?php if (isset($_POST['day'])) {
										if ($_POST['day'] == 'Montag')
											echo 'selected';
									} ?> value="Montag">Montag</option>
									<option <?php if (isset($_POST['day'])) {
										if ($_POST['day'] == 'Dienstag')
											echo 'selected';
									} ?> value="Dienstag">Dienstag</option>
									<option <?php if (isset($_POST['day'])) {
										if ($_POST['day'] == 'Mittwoch')
											echo 'selected';
									} ?> value="Mittwoch">Mittwoch</option>
									<option <?php if (isset($_POST['day'])) {
										if ($_POST['day'] == 'Donnerstag')
											echo 'selected';
									} ?> value="Donnerstag">Donnerstag</option>
									<option <?php if (isset($_POST['day'])) {
										if ($_POST['day'] == 'Freitag')
											echo 'selected';
									} ?> value="Freitag">Freitag</option>
									<option <?php if (isset($_POST['day'])) {
										if ($_POST['day'] == 'Samstag')
											echo 'selected';
									} ?> value="Samstag">Samstag</option>

								</select>
							</td>




							<td><select name="course" style="width:120px;">
									<?php
									$requete = 'SELECT code, name FROM `course`';
									$result = mysqli_query($cn, $requete);
									while ($ligne = mysqli_fetch_array($result)) {
										if (!empty($_POST["course"])) {
											$selectionnee = ($ligne[0] == $_POST["course"]) ? " SELECTED " : "";
										} else {
											$selectionnee = ($ligne[0] == $selecAct[0]) ? " SELECTED " : "";
										}
										echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", addslashes($ligne['name']), '</option>';
									}
									?>
								</select></td>

							<td><select name="prof" style="width:120px;">
									<?php
									$requete = "SELECT login, nom FROM `users` WHERE prof='1' AND open='1'";
									$result = mysqli_query($cn, $requete);
									while ($ligne = mysqli_fetch_array($result)) {
										$selectionnee = ($ligne[0] == $_POST["prof"]) ? " SELECTED " : "";
										echo "<option value='", addslashes($ligne['login']), "' $selectionnee >", $ligne['nom'], '</option>';
									}
									?>
								</select></td>


							<td><select name="room" style="width:120px;">
									<?php
									$requete = 'SELECT nummer FROM `room`';
									$result = mysqli_query($cn, $requete);
									while ($ligne = mysqli_fetch_array($result)) {
										$selectionnee = ($ligne[0] == $_POST["room"]) ? " SELECTED " : "";
										echo "<option value='", addslashes($ligne['nummer']), "' $selectionnee >", $ligne['nummer'], '</option>';
									}
									?>
								</select></td>


						</tr>
						<tr>
							<td colspan="9">
								<center><input name="b3" type="submit" class="btn btn-success" value="Hinzufügen" id="b3">
								</center>
							</td>
						</tr>

					</tbody>
				</table>
			<?php }
		} ?>
	</form>
</section>


<?php
include 'menubottom.php';
?>
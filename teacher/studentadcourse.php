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
?>


<section>
	<div class="col-lg-12 text-center">
		<h2>Schüler einem Fach zuordnen</h2>
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
				<td></td>
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
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Schülername :</td>

				<td><input type="text" name="t1" id="t1" value="<?php if (isset($_POST['t1'])) {
					echo $_POST['t1'];
				} ?>"
						size="12" style="width:170px;"></td>
				<td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Suchen"></td>
			</tr>
		</table>
		<br>

		<?php
		if (isset($_POST['b2'])) {
			if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '') {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			} else {
				?>
				<table width="80%" border="2" align="center" class="table-style-two">
					<tbody>
						<tr>
							<th><b>Code</b></th>
							<th><b>Nachname</b></th>
							<th><b>Vorname</b></th>
							<th><b>Adresse</b></th>
							<th><b>PLZ</b></th>
							<th><b>Stadt</b></th>
							<th><b>E-mail</b></th>
							<th><b>Auswahl</b></th>
						</tr>

						<?php

						$dr = mysqli_query($cn, "SELECT r.code, s.name, s.firstname, s.adresse, s.cp, s.city,  s.email, r.semester, r.year, r.classe FROM registration r, student s WHERE s.code = r.student and r.semester='" . addslashes($_POST['c2']) . "' and r.year='" . addslashes($_POST['c1']) . "' and r.classe='" . addslashes($_POST['c3']) . "' and s.name like '%" . addslashes($_POST['t1']) . "%'");
						while ($ligne = mysqli_fetch_array($dr)) {
							?>
							<tr>
								<td>
									<?php echo addslashes($ligne[0]); ?>
								</td>
								<td>
									<?php echo addslashes($ligne[1]); ?>
								</td>
								<td>
									<?php echo addslashes($ligne[2]); ?>
								</td>
								<td>
									<?php echo addslashes($ligne[3]); ?>
								</td>
								<td>
									<?php echo addslashes($ligne[4]); ?>
								</td>
								<td>
									<?php echo addslashes($ligne[5]); ?>
								</td>
								<td>
									<?php echo addslashes($ligne[6]); ?>
								</td>
								<td>
									<?php echo '&nbsp; &nbsp; <input type="checkbox" name="chck[]" value="', addslashes($ligne[0]), '" >'; ?>
								</td>

							</tr>


							<?php
						}
			}
			echo '</tbody>';
			echo '</table>';
		}
		?>
				<br>
				<?php
				if (isset($_POST['b2']) or isset($_POST['b3'])) {
					if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '') {
					} else {
						?>
						<center>
							Das Fach
							<select name="c4" style="width:170px;">
								<option value="">Wählen Sie aus</option>
								<?php
								$requete = 'SELECT code, name FROM `course`';
								$result = mysqli_query($cn, $requete);

								while ($ligne = mysqli_fetch_array($result)) {
									echo '<option value=', addslashes($ligne['code']), '>', $ligne['name'], '</option>';
								}

								?>
							</select>
							ausgewählten Schülern zuordnen &nbsp;&nbsp;<input name="b3" type="submit" id="b3"
								class="btn btn-success" value="Bestätigen">
						</center>

						<?php
					}
				}
				if (isset($_POST['b3'])) {
					if ($_POST['c4'] == '') {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
					} else {
						if (!empty($_POST['chck'])) {

							foreach ($_POST['chck'] as $value) {
								$dr2 = mysqli_query($cn, "SELECT * 
FROM entry
WHERE course='" . addslashes($_POST['c4']) . "' 
AND registration='" . $value . "'");
								$ligne2 = mysqli_fetch_array($dr2);


								if (empty($ligne2)) {

									$dr = mysqli_query($cn, "INSERT INTO entry 
values ( '', '" . addslashes($value) . "', '" . addslashes($_POST['c4']) . "', '0');");
								}
							}
						} else {
							echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
						}
					}
				}
				?>
	</form>
</section>

<?php
include 'menubottom.php';
?>
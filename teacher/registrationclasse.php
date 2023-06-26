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
		<h2>Anmeldungen pro Klasse</h2>
	</div>
	<form id="form1" name="form1" method="post">
		<br>
		<table width="300" border="0" align="center">


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
		</table>
		<br>
		<?php
		if (isset($_POST['b2'])) {
			if (addslashes($_POST['c1']) == '' or addslashes($_POST['c2']) == '' or addslashes($_POST['c3']) == '') {
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

						$dr = mysqli_query($cn, "SELECT r.code, s.name, s.firstname, s.adresse, s.cp, s.city,  s.email, r.semester, r.classe, r.year, s.code 
FROM registration r, student s 
WHERE s.code = r.student 
AND r.semester='" . addslashes($_POST['c2']) . "' 
AND r.year='" . addslashes($_POST['c1']) . "' 
AND r.classe='" . addslashes($_POST['c3']) . "'");

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
									<?php echo '&nbsp; &nbsp; <input type="checkbox" name="chck[]" value="', addslashes($ligne[10]), '" >'; ?>
								</td>
							</tr>

						<?php
						}
						?>
					</tbody>
				</table>
				<br>
				<table width="300" border="0" align="center">
					<tr>
						<td><b>Die ausgewählten Schüler einschreiben in:</b></td>
					</tr>
					<tr>
						<td>Jahr</td>
						<td>
							<select name="c11" style="width:170px;">
								<option value="">Wählen Sie aus</option>
								<?php

								$requete = 'SELECT years FROM `years` order by years desc';
								$result = mysqli_query($cn, $requete);
								while ($ligne = mysqli_fetch_array($result)) {
									$selectionnee = ($ligne[0] == $_POST["c1"]) ? " SELECTED " : "";
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
						<td><select name="c22" style="width:170px;">
								<option value="">Wählen Sie aus</option>
								<?php
								$requete = 'SELECT semester FROM `semester`';
								$result = mysqli_query($cn, $requete);
								while ($ligne = mysqli_fetch_array($result)) {
									$selectionnee = ($ligne[0] == $_POST["c2"]) ? " SELECTED " : "";
									echo "<option value='", addslashes($ligne['semester']), "' $selectionnee >", addslashes($ligne['semester']), '</option>';

								}
								?>
							</select>
						<td>&nbsp;</td>
					</tr>

					<tr>
						<td>Klasse</td>
						<td><select name="c33" style="width:170px;">
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
						<td><input name="b3" type="submit" class="btn btn-success" value="Einschreiben" id="b2"></td>
					</tr>
				</table>



				<?php
			}
		}
		if (isset($_POST['b3'])) {
			if (!empty($_POST['chck'])) {
				foreach ($_POST['chck'] as $value) {
					$dr2 = mysqli_query($cn, "SELECT * 
FROM registration
WHERE semester='" . addslashes($_POST['c22']) . "' 
AND year='" . addslashes($_POST['c11']) . "' 
AND student='" . $value . "'");
					$ligne2 = mysqli_fetch_array($dr2);

					if (empty($ligne2)) {

						$requete = "INSERT INTO registration VALUES ('', '" . addslashes($_POST['c11']) . "', '" . addslashes($_POST['c22']) . "', '" . addslashes($_POST['c33']) . "', '" . addslashes($value) . "', '')";
						$result = mysqli_query($cn, $requete);
					} else {
						$requete = "UPDATE registration SET semester = '" . addslashes($_POST['c22']) . "', year='" . addslashes($_POST['c11']) . "', classe='" . addslashes($_POST['c33']) . "'
	WHERE semester='" . addslashes($_POST['c22']) . "' 
	AND year='" . addslashes($_POST['c11']) . "' 
	AND student='" . $value . "'";
						$result = mysqli_query($cn, $requete);
					}

				}

			} else {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			}

		}
		?>
	</form>
</section>



<?php
include 'menubottom.php';
?>
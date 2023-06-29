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
		<h2>Schülerliste pro Fach</h2>
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
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Fach</td>
				<td><select name="c4" style="width:170px;">
						<option value="">Wählen Sie aus</option>

						<?php
						$requete = 'SELECT code, name FROM `course`';
						$result = mysqli_query($cn, $requete);
						while ($ligne = mysqli_fetch_array($result)) {
							$selectionnee = ($ligne[0] == $_POST["c4"]) ? " SELECTED " : "";
							echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
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
		if (isset($_POST['submit'])) {
			$dr = mysqli_query($cn, "SELECT * from testline where student='" . addslashes($_POST['submit']) . "'");
			$ligne = mysqli_fetch_array($dr);

			if (!empty($ligne)) {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Kann nicht gelöscht werden: Es sind Noten für diesen Schüler gespeichert. </center></b></font><br>";
			} else {
				$dr = mysqli_query($cn, "DELETE FROM entry where code='" . addslashes($_POST['submit']) . "'");
			}
		}

		if (isset($_POST['b3'])) {
			if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '') {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'>Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			} else {
				$dr2 = mysqli_query($cn, "SELECT count(e.code) FROM entry e, registration r, student s WHERE s.code = r.student AND r.code = e.registration and r.semester='" . addslashes($_POST['c2']) . "' and r.year='" . addslashes($_POST['c1']) . "' and r.classe='" . addslashes($_POST['c3']) . "' and e.course='" . addslashes($_POST['c4']) . "'");
				$result = $ligne = mysqli_fetch_array($dr2);
				$NbrLigne = $result[0];


				for ($l = 0; $l < $NbrLigne; $l++) {
					$dr = mysqli_query($cn, "UPDATE entry SET niveauG='0' WHERE code ='" . $_POST['code'][$l] . "'");
					$dr = mysqli_query($cn, "UPDATE entry SET niveauG='0' WHERE code ='" . $_POST['code'][$l] . "'");
				}

				for ($l = 0; $l < $NbrLigne; $l++) {
					if (isset($_POST['chck'][$l])) {
						$dr = mysqli_query($cn, "UPDATE entry SET niveauG='1' WHERE code ='" . $_POST['chck'][$l] . "'");
					}
				}

				$dr = mysqli_query($cn, "SELECT 
e.code, s.name, s.firstname, s.adresse, s.cp, s.city,  s.email, e.niveauG, r.semester, r.classe, r.year, e.course 
FROM entry e, registration r, student s 
WHERE s.code = r.student 
AND r.code = e.registration 
AND r.semester='" . addslashes($_POST['c2']) . "' 
AND r.year='" . addslashes($_POST['c1']) . "' 
AND r.classe='" . addslashes($_POST['c3']) . "' 
AND e.course='" . addslashes($_POST['c4']) . "'");

			}
		}

		if (isset($_POST['b2']) or isset($_POST['submit']) or isset($_POST['b3'])) {

			if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '') {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'>Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			} else {

				$dr10 = mysqli_query($cn, "SELECT glevel from level");
				$ligne10 = mysqli_fetch_array($dr10);
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
							<th><b>
									<?php echo addslashes($ligne10[0]); ?> Niveau
								</b></th>
							<th><b>Löschen</b></th>
						</tr>

						<?php
						$dr = mysqli_query($cn, "SELECT 
e.code, s.name, s.firstname, s.adresse, s.cp, s.city,  s.email, e.niveauG, r.semester, r.classe, r.year, e.course 
FROM entry e, registration r, student s 
WHERE s.code = r.student 
AND r.code = e.registration 
AND r.semester='" . addslashes($_POST['c2']) . "' 
AND r.year='" . addslashes($_POST['c1']) . "' 
AND r.classe='" . addslashes($_POST['c3']) . "' 
AND e.course='" . addslashes($_POST['c4']) . "'");

						while ($ligne = mysqli_fetch_array($dr)) {

							?>
							<tr>
								<td>
									<?php echo addslashes($ligne[0]); ?>
								</td>
								<input type="hidden" name="code[]" value="<?php echo $ligne[0]; ?>">
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
								<td> &nbsp; &nbsp; <input type="checkbox" name="chck[]" value="<?php echo $ligne[0]; ?>" <?php if ($ligne[7] == true)
									   echo ' checked="checked"'; ?>></td>
								<td> &nbsp;&nbsp;<button type="submit" name="submit" value="<?php echo $ligne[0]; ?>"
										class="btImg"><img src="../img/b_drop.png" /></button></td>
							</tr>


							<?php
						}
						?>
					</tbody>
				</table>

				<table width="80%" border="0" align="center">
					<tbody>
						<tr>
							<td>&nbsp; </td>
						</tr>
						<tr>
							<td>
								<?php if (isset($_POST['b2']) or isset($_POST['b3']) or isset($_POST['submit'])) { ?>
									<center><input name="b3" type="submit" class="btn btn-success" value="Aktualisieren" id="b3">
									<?php } ?>
								</center>
							</td>
						</tr>
					</tbody>
				</table>

				<?php
			}
		}




		?>
	</form>
</section>


<?php
include 'menubottom.php';
?>
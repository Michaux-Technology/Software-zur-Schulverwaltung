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



include '../log.php';
$log = mysqli_query($cn, "INSERT INTO security (date, hour, ip, computer, col1, success, page) values ('" . $date . "','" . $hour . "','" . $ip_address . "', '" . $os . "','" . addslashes($_SESSION['login']) . "','1','.../teacher/testad.php')");



?>

<div class="col-lg-12 text-center">
	<h2>Prüfung hinzufügen</h2>
</div>
<form id="form1" name="form1" method="post">

	<table width="300" border="0" align="center">

		<tr>
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
			<td><input name="b2" type="submit" class="btn btn-success" value="Schülerliste" id="b2"></td>
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
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Prüfungsdatum</td>
			<td><input type="date" name='id3' id="id3" value="<?php echo date("Y-m-d"); ?>" style="width:170px;"></td>
			<br>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>Höchstmögliche Note</td>
			<td><input type="text" name="id2" id="id2" value="<?php if (isset($_POST['id2'])) {
				echo $_POST['id2'];
			} ?>"
					style="width:170px;"></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>Prüfungstyp</td>
			<td><select name="c5" style="width:170px;">
					<option value="">Wählen Sie aus</option>
					<?php
					$requete = 'SELECT code, name FROM `worktype`';
					$result = mysqli_query($cn, $requete);
					while ($ligne = mysqli_fetch_array($result)) {
						$selectionnee = ($ligne[0] == $_POST["c5"]) ? " SELECTED " : "";
						echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
					}
					?>
				</select>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>



		&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<?php

	if (isset($_POST['b2'])) {
		if ($_POST['c5'] == '' or $_POST['id2'] == '' or $_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {


			$dr = mysqli_query($cn, "SELECT * from profcourse 
		WHERE prof='" . addslashes($_SESSION['login']) . "' AND
		year='" . addslashes($_POST['c1']) . "' AND
		semester='" . addslashes($_POST['c2']) . "' AND
		course='" . addslashes($_POST['c4']) . "' AND
		classe='" . addslashes($_POST['c3']) . "'");


			$ligne = mysqli_fetch_array($dr);

			if (!empty($ligne)) {

				?>
				<table width="80%" border="2" align="center" class="table-style-two">
					<tbody>
						<tr>
							<th><b>Code</b></th>
							<th><b>Name</b></th>
							<th><b>Vorname</b></th>
							<th><b>Note</b></th>
						</tr>

						<?php

						$dr = mysqli_query($cn, "SELECT s.code, s.name, s.firstname, s.adresse, s.cp, s.city,  s.email, r.semester, r.classe, r.year, e.course 
 FROM entry e, registration r, student s 
 WHERE s.code = r.student 
 AND r.code = e.registration 
 and r.semester='" . addslashes($_POST['c2']) . "' 
 and r.year='" . addslashes($_POST['c1']) . "' 
 and r.classe='" . addslashes($_POST['c3']) . "' 
 and e.course='" . addslashes($_POST['c4']) . "' 
  ORDER BY s.name");
						$i = 0;

						while ($ligne = mysqli_fetch_array($dr)) {
							?>
							<tr>
								<td>
									<?php echo addslashes($ligne[0]); ?>
									<?php echo '<input type="hidden" name="code[]" value="', addslashes($ligne[0]), '" >'; ?>
								</td>
								<td>
									<?php echo addslashes($ligne[1]); ?>
									<?php echo '<input type="hidden" name="name" value="', addslashes($ligne[0]), '" >'; ?>
								</td>
								<td>
									<?php echo addslashes($ligne[2]); ?>
									<?php echo '<input type="hidden" name="firstname" value="', addslashes($ligne[0]), '" >'; ?>
								</td>
								<TD width=120><input type="text" name="id1[]" size="2" style="width:100px;"></td>
							</tr>

							<?php
							$i = $i + 1;
						}
						?>
			</form>
			</tbody>
			</table>
			<br>

			<center><input name="b4" type="submit" class="btn btn-success" value="Bestätigen" id="b4"></center>

			<?php
			} else {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Kann nicht hinzugefügt werden: Sie müssen der oder die Lehrer(in) für diese Klasse sein. </center></b></font><br>";
			}
		}

	}
	if (isset($_POST['b4'])) {
		$dr = mysqli_query($cn, "SELECT * FROM worktypescale where course = '" . addslashes($_POST['c4']) . "' AND worktype = '" . addslashes($_POST['c5']) . "'");
		$ligne = mysqli_fetch_array($dr);

		if (empty($ligne)) {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Es gibt keine konfigurierte Umrechnungstabelle für dieses Fach und diesen Prüfungstyp.</center></b></font><br>";
		} else {

			$dr = mysqli_query($cn, "INSERT INTO test (date, point, worktype, year, semester, classe, course, prof) VALUES ('" . addslashes($_POST['id3']) . "', '" . addslashes($_POST['id2']) . "', '" . addslashes($_POST['c5']) . "','" . addslashes($_POST['c1']) . "', '" . addslashes($_POST['c2']) . "', '" . addslashes($_POST['c3']) . "', '" . addslashes($_POST['c4']) . "','" . addslashes($_SESSION['login']) . "')");
			$_SESSION['notemax'] = $_POST['id2'];

			$query = mysqli_query($cn, "SELECT MAX(code) as Max FROM test where course = '" . addslashes($_POST['c4']) . "'");
			$max = mysqli_fetch_assoc($query);
			$cpte = 1;

			foreach ($_POST['code'] as $key => $value) {
				if ($_POST['id1'][$key]) {

					$dr = mysqli_query($cn, "INSERT INTO testline (codeline, student, test) VALUES ('" . addslashes($cpte) . "', '" . addslashes($value) . "', '" . addslashes($max["Max"]) . "')");
				}
				$cpte = $cpte + 1;
			}

			foreach ($_POST['id1'] as $key => $value) {

				if (!empty($value)) {
					$key = $key + 1;
					$pourcentage = $value / $_POST['id2'] * 100;
					$dr = mysqli_query($cn, "UPDATE testline SET note='" . $value . "', grade = '" . $pourcentage . "' WHERE test= '" . addslashes($max["Max"]) . "' AND codeline = '" . $key . "'");
				}
			}

			$_SESSION['numtest'] = $max["Max"];

			print "<script>window.location='testad2.php';</script>";
		}
	}
	?>
</form>
</section>


<?php
include 'menubottom.php';
?>
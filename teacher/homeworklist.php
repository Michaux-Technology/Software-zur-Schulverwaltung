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


<div class="col-lg-12 text-center">
	<h2>Hausaufgabenliste pro Klasse</h2>
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
			<td><input name="b3" type="submit" class="btn btn-success" value="Suchen" id="b3"></td>
			<td>&nbsp;</td>
		</tr>

	</table>
	<br>

	<?php
	if (isset($_POST['b2'])) {
		print "<script>window.location='homeprof.php';</script>";
	}

	if (isset($_POST['b4'])) {
		print "<script>window.location='homeworkad.php';</script>";
	}

	if (isset($_POST['b3'])) {

		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {

			$sql = "SELECT c.name as course, h.date as date, h.homework as homework
FROM homework h, course c 
WHERE h.course= c.code AND
h.year='" . addslashes($_POST['c1']) . "' AND 
h.semester='" . addslashes($_POST['c2']) . "' AND 
h.classe = '" . addslashes($_POST['c3']) . "' AND
h.date >= CURDATE() 
AND h.date <= curdate() + interval 7 day
ORDER BY date";
			$result = mysqli_query($cn, $sql);
			$dates = array();
			$niveauEs = array();

			$result = mysqli_query($cn, $sql);

			$data = array();
			$dates = array();

			while ($row = mysqli_fetch_array($result)) { // fetching result
				if (!isset($data[$row['course']])) {
					$data[$row['course']] = array();
				}

				if (!isset($data[$row['course']][$row['date']])) {
					$data[$row['course']][$row['date']] = array();
				}

				if (!in_array($row['date'], $dates)) {
					$dates[] = $row['date'];
				}

				$data[$row['course']][$row['date']] = $row['homework'];
			}
			?>

			<table width="1000" border="2" align="center" class="table-style-two">
				<thead>
					<th>Fach</th>

					<?php foreach ($dates as $date): ?>
						<th width="100px">
							<?= $date ?>
						</th>
					<?php endforeach; ?>
				</thead>
				<tbody>

					<?php foreach ($data as $course => $entries): ?>
						<tr>
							<td>
								<?= $course ?>
							</td>

							<?php foreach ($dates as $date): ?>
								<td>
									<?= (isset($data[$course][$date]) ? $data[$course][$date] : '') ?>
								</td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
			<br>
			<center><input name="b4" type="submit" class="btn btn-success" value="Hinzufügen" id="b4">&nbsp;&nbsp;&nbsp;<input
					name="b2" type="submit" class="btn btn-success" value=" Zurück" id="b2"></center>
			<?php
		}
	}
	?>
	</section>


	<?php
	include 'menubottom.php';
	?>
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
	<h2>Hausaufgabe hinzufügen</h2>
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
			<td><input name="b2" type="submit" class="btn btn-success" value="Bestätigen" id="b2"></td>
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
			<td>Hausaufgabe zurückgeben zum</td>
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
			<td>Aufgabe</td>
			<td><textarea name="message1" id="message1" cols="45"
					rows="7"><?php if (isset($_POST['message1'])) {
						echo $_POST['message1'];
					} ?></textarea></td>
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

	<br>
	<?php
	if (isset($_POST['b2'])) {
		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '' or $_POST['id3'] == '' or $_POST['message1'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {
			$requete = "SELECT * FROM `homework` 
where date='" . $_POST['id3'] . "' AND
year='" . $_POST['c1'] . "' AND
semester='" . $_POST['c2'] . "' AND
course='" . $_POST['c4'] . "' AND 
classe='" . $_POST['c3'] . "'";
			$result = mysqli_query($cn, $requete);
			$ligne = mysqli_fetch_array($result);

			if (empty($ligne)) {
				$requete = "INSERT INTO homework VALUES ('" . addslashes($_POST['c1']) . "','" . addslashes($_POST['c2']) . "','" . addslashes($_POST['c3']) . "','" . addslashes($_POST['c4']) . "','" . addslashes($_POST['id3']) . "','" . addslashes($_POST['message1']) . "','')";
				$result = mysqli_query($cn, $requete);
				print "<script>window.location='homeprof.php';</script>";
			} else {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Es darf nicht mehr als eine Hausaufgabe pro Tag eingegeben werden.</center></b></font><br>";
			}
		}
	}
	?>
	</section>



	<?php
	include 'menubottom.php';
	?>
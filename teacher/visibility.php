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
	<h2>Prüfungsansicht</h2>
	<I>Die Prüfungen für Eltern sichtbar machen</I>
</div>
<form id="form1" name="form1" method="post">

	<table width="300" border="0" align="center">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
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
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td>Fach</td>
			<td><select name="c4" style="width:170px;">
					<option value="">Wählen Sie aus</option>
					<?php
					$requete = 'SELECT * FROM `course`';
					$result = mysqli_query($cn, $requete);
					while ($ligne = mysqli_fetch_array($result)) {
						$selectionnee = ($ligne[0] == $_POST["c4"]) ? " SELECTED " : "";
						echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", addslashes($ligne['name']), '</option>';
					}
					?>
				</select>
			<td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Suchen"></td>
			<td></td>
		</tr>
	</table>
	<br>

	<?php
	if (isset($_POST['b2']) or isset($_POST['b3']) or isset($_POST['b4'])) {

		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {

			?>
			<table width="700" border="2" align="center" class="table-style-two">
				<tbody>
					<tr>
						<th><b>Code</b></th>
						<th><b>Prüfungsdatum</b></th>
						<th><b>Prüfungstyp</b></th>
						<th width="130"><b>Sichtbar machen</b></th>

					</tr>

					<?php
		}

		if (isset($_POST['b4'])) {

			if (isset($_POST['chck'])) {
				foreach ($_POST['chck'] as $value) {
					$dr = mysqli_query($cn, "UPDATE test 
			SET 
			visibility = '1'
			WHERE 
			code = '" . addslashes($value) . "';");


					//envoi de Email - Debut
	
					$dr = mysqli_query($cn, "SELECT t.code, s.name, s.firstname, s.email, l.niveau, w.name, c.name

				FROM test t, testline l, student s, worktype w, course c

				WHERE
				t.code=l.test
				AND s.code=l.student
				AND t.worktype=w.code
				AND t.course=c.code
				AND t.code='" . addslashes($value) . "'");

					while ($ligne = mysqli_fetch_array($dr)) {
						$_SESSION['destination'] = addslashes($ligne[3]);
						$_SESSION['note'] = "Ihre Noten";
						$_SESSION['messageemail'] = "<html><head>
                    <br>
					Sehr geehrte Damen und Herren,<br><br>
					" . addslashes($ligne[2]) . " " . addslashes($ligne[1]) . " hat eine " . addslashes($ligne[4]) . " f&uuml;r eine(n) " . addslashes($ligne[5]) . " 
					im Kurs '" . addslashes($ligne[6]) . "'<br><br>
					Mit freundlichen Gr&uuml;&szlig;en,<br>
					Die/Der Lehrer(in)<br><br><br><br><br>
					<small><i>Diese E-mail wurde mit School Management Software von Valéry-Jérôme Michaux automatisch geschickt.</i></small><br>
					___
					</head></html>
					";

						$destinataire = $_SESSION['destination'];
						$expediteur = $_SESSION['email'];
						$reponse = $expediteur;
						$headers = "From: $expediteur\r\nReply-To: $reponse";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=utf-8";

						mail(
							$destinataire,
							$_SESSION['note'],
							$_SESSION['messageemail'],
							$headers
						);
					}
					//envoi de Email - Fin
				}
			}

		}

		if (isset($_POST['b3'])) {
			if (isset($_POST['chck'])) {
				foreach ($_POST['chck'] as $value) {
					$dr = mysqli_query($cn, "UPDATE test 
			SET 
			visibility = '1'
			WHERE 
			code = '" . addslashes($value) . "';");
				}
			}

		}

		if (isset($_POST['b2']) or isset($_POST['b3']) or isset($_POST['b4'])) {
			$dr = mysqli_query($cn, "SELECT t.code, t.date, w.name,t.visibility FROM test t, worktype w WHERE t.worktype=w.code and t.semester='" . addslashes($_POST['c2']) . "' and t.classe='" . addslashes($_POST['c3']) . "' and t.course='" . addslashes($_POST['c4']) . "' and t.year='" . addslashes($_POST['c1']) . "' AND t.visibility='0'");
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
							<td> &nbsp; &nbsp; <input type="checkbox" name="chck[]" value="<?php echo $ligne[0]; ?>" <?php if ($ligne[3] == true)
								   echo ' checked="checked"'; ?>></td>
						</tr>

						<?php
			}
			echo '</tbody>';
			echo '</table>';
		}
		?>
				<br>
				<center><input name="b3" type="submit" id="b3" class="btn btn-success"
						value="Bestätigen ohne Email">&nbsp;&nbsp;&nbsp;<input name="b4" type="submit" id="b4"
						class="btn btn-danger" value="Bestätigen mit Email"></center>
			<?php } ?>
</form>
</section>


<?php
include 'menubottom.php';
?>
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
	<h2>Anwesenheitskontrolle</h2>
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
			<td>Anwesenheitsdatum</td>
			<td><input type="date" name='id3' id="id3" value="<?php if (isset($_POST['id3'])) {
				echo $_POST['id3'];
			} else {
				echo date("Y-m-d");
			} ?>" style="width:170px;"></td><br>
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




	if (isset($_POST['b2']) or isset($_POST['b4'])) {

		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '' or $_POST['id3'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {

			$dr = mysqli_query($cn, "SELECT * from presence 
	WHERE year='" . addslashes($_POST['c1']) . "' AND 
	date='" . addslashes($_POST['id3']) . "' AND 
	classe='" . addslashes($_POST['c3']) . "' AND 
	course='" . addslashes($_POST['c4']) . "' AND 
	semester='" . addslashes($_POST['c2']) . "'");

			$ligne = mysqli_fetch_array($dr);

			if (empty($ligne)) {

				?>
				<img src:'../img/email.png' />
				<table width="80%" border="2" align="center" class="table-style-two">
					<tbody>
						<tr>
							<th><b>Code</b></th>
							<th><b>Name</b></th>
							<th><b>Vorname</b></th>
							<th><b>Anwesenheit</b></th>
							<th><b>Zusatzinformation</b></th>
							<th width=50><b>&nbsp;<img src='../img/email.png' /></b></th>
						</tr>

						<?php

						$dr = mysqli_query($cn, "SELECT s.code, s.name, s.firstname from registration r, student s, entry e 
WHERE s.code=r.student AND
r.code=e.registration AND
r.year='" . addslashes($_POST['c1']) . "' AND
r.semester='" . addslashes($_POST['c2']) . "' AND
e.course='" . addslashes($_POST['c4']) . "' AND
r.classe='" . addslashes($_POST['c3']) . "'");


						while ($ligne = mysqli_fetch_array($dr)) {
							?>
							<tr>
								<td>
									<?php echo addslashes($ligne[0]); ?>
									<?php echo '<input type="hidden" name="code[]" value="', addslashes($ligne[0]), '" >'; ?>
								</td>
								<td>
									<?php echo addslashes($ligne[1]); ?>
									<?php echo '<input type="hidden" name="name[]" value="', addslashes($ligne[1]), '" >'; ?>
								</td>
								<td>
									<?php echo addslashes($ligne[2]); ?>
									<?php echo '<input type="hidden" name="firstname[]" value="', addslashes($ligne[2]), '" >'; ?>
								</td>
								<td width=120><select name="presence[]" style="width:100px;">
										<option selected value="anwesend">anwesend</option>
										<option value="abwesend">abwesend</option>
										<option value="verspätet">verspätet</option>
									</select></td>
								<td width=100><input type="text" name="comment[]" value="" maxlength="50"></td>
								<td width=50> &nbsp;&nbsp;&nbsp;<input type='checkbox' name='chck[]' value='1'></td>
							</tr>

							<?php
						}

						?>
			</form>
			</tbody>
			</table>
			<br>

			<center><input name="b5" type="submit" class="btn btn-success" value="zurück" id="b5">&nbsp;&nbsp;&nbsp;
				<input name="b4" type="submit" class="btn btn-success" value="Bestätigen" id="b4">
			</center>

			<?php
			} else {
				echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Die Anwesenheit ist bereits gespeichert. </center></b></font><br>";
			}

		}


	}

	if (isset($_POST['b5'])) {
		print "<script>window.location='homeprof.php';</script>";
	}

	if (isset($_POST['b4'])) {

		$dr = mysqli_query($cn, "SELECT * from presence 
	WHERE year='" . addslashes($_POST['c1']) . "' AND 
	date='" . addslashes($_POST['id3']) . "' AND 
	classe='" . addslashes($_POST['c3']) . "' AND 
	course='" . addslashes($_POST['c4']) . "' AND 
	semester='" . addslashes($_POST['c2']) . "'");

		$ligne = mysqli_fetch_array($dr);

		if (empty($ligne)) {

			foreach ($_POST['code'] as $key => $value) {
				if ($_POST['chck'][$key] == '1') {

					$dr = mysqli_query($cn, "INSERT INTO presence (date, student, classe, course, year, semester, presence, comment, email) VALUES ('" . addslashes($_POST['id3']) . "', '" . addslashes($_POST['code'][$key]) . "', '" . addslashes($_POST['c3']) . "', '" . addslashes($_POST['c4']) . "', '" . addslashes($_POST['c1']) . "', '" . addslashes($_POST['c2']) . "', '" . addslashes($_POST['presence'][$key]) . "', '" . addslashes($_POST['comment'][$key]) . "', '1')");

					//envoi de Email - Debut
	
					$dr = mysqli_query($cn, "select s.code, s.email from student s 
				WHERE s.code= '" . $_POST['code'][$key] . "'");

					while ($ligne = mysqli_fetch_array($dr)) {
						$_SESSION['destination'] = addslashes($ligne[1]);
						$_SESSION['messageemail'] = "<html><head>
                    <br>
					Sehr geehrte Damen und Herren,<br><br>
					Am " . addslashes($_POST['id3']) . " war " . addslashes($_POST['name'][$key]) . " " . addslashes($_POST['firstname'][$key]) . " " . addslashes($_POST['presence'][$key]) .
							" im Kurs " . addslashes($_POST['c4']) . ".<br> Zusatzinformation: " . addslashes($_POST['comment'][$key]) . "<br><br>
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
							"Anwesenheitskontrolle",
							$_SESSION['messageemail'],
							$headers
						);

					}
					//envoi de Email - Fin
	
				}

				if ($_POST['chck'][$key] == '') {

					$dr = mysqli_query($cn, "INSERT INTO presence (date, student, classe, course, year, semester, presence, comment, email) VALUES ('" . addslashes($_POST['id3']) . "', '" . addslashes($_POST['code'][$key]) . "', '" . addslashes($_POST['c3']) . "', '" . addslashes($_POST['c4']) . "', '" . addslashes($_POST['c1']) . "', '" . addslashes($_POST['c2']) . "', '" . addslashes($_POST['presence'][$key]) . "', '" . addslashes($_POST['comment'][$key]) . "', '0')");

				}
				print "<script>window.location='homeprof.php';</script>";

			}
		} else {
			echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Die Anwesenheit ist bereits gespeichert. </center></b></font><br>";
		}

	}


	?>
</form>
</section>


<?php
include 'menubottom.php';

?>
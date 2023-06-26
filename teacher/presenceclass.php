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
	<h2>Anwesenheitskontrolle pro Klass</h2>
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
			<td>Anwesenheit</td>
			<td><select name="presenceask" style="width:170px;">
					<option <?php if (isset($_POST['presenceask'])) {
						if ($_POST['presenceask'] == 'anwesend')
							echo 'selected';
					} ?> value="anwesend">anwesend</option>
					<option <?php if (isset($_POST['presenceask'])) {
						if ($_POST['presenceask'] == 'abwesend')
							echo 'selected';
					} ?> value="abwesend">abwesend</option>
					<option <?php if (isset($_POST['presenceask'])) {
						if ($_POST['presenceask'] == 'verspätet')
							echo 'selected';
					} ?> value="verspätet">verspätet</option>
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
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><b>von</b>&nbsp;&nbsp;&nbsp;<input type="date" name='id4' id="id4" value="<?php if (isset($_POST['id4'])) {
				echo $_POST['id4'];
			} else {
				echo date("Y-m-d");
			} ?>" style="width:170px;"><br></td>
			<td><b>bis</b>&nbsp;&nbsp;&nbsp;<input type="date" name='id3' id="id3" value="<?php if (isset($_POST['id3'])) {
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

		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['id3'] == '' or $_POST['id4'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {


			?>
			<img src:'../img/email.png' />
			<table width="80%" border="2" align="center" class="table-style-two">
				<tbody>
					<tr>
						<th><b>Code</b></th>
						<th><b>Datum</b></th>
						<th><b>Fach</b></th>
						<th><b>Name</b></th>
						<th><b>Vorname</b></th>
						<th><b>Anwesenheit</b></th>
						<th><b>Zusatzinformation</b></th>
						<th width=50><b>&nbsp;<img src='../img/email.png' /></b></th>
						<th><b>Auf dem Zeugnis</b></th>
					</tr>

					<?php

					$linepropage = 20;

					$retour_page = mysqli_query($cn, "SELECT count(p.code) as countcode
FROM presence p, student s
WHERE s.code=p.student AND
p.year='" . addslashes($_POST['c1']) . "' AND
p.semester='" . addslashes($_POST['c2']) . "' AND
p.date >= '" . addslashes($_POST['id4']) . "' AND
p.date <= '" . addslashes($_POST['id3']) . "' AND
p.presence='" . addslashes($_POST['presenceask']) . "' AND
p.classe='" . addslashes($_POST['c3']) . "'");


					$data_page = mysqli_fetch_assoc($retour_page);
					$total = $data_page['countcode'];

					$numberofpages = ceil($total / $linepropage);

					if (isset($_GET['countcode'])) {
						$Actuelpage = intval($_GET['countcode']);

						if ($Actuelpage > $numberofpages) {
							$Actuelpage = $numberofpages;
						}
					} else {
						$Actuelpage = 1;
					}

					$Firstentree = ($Actuelpage - 1) * $linepropage;



					$dr = mysqli_query($cn, "SELECT p.code, p.date, s.name, s.firstname, p.presence, p.comment, p.email, p.course, p.zeugnis
FROM presence p, student s
WHERE s.code=p.student AND
p.year='" . addslashes($_POST['c1']) . "' AND
p.semester='" . addslashes($_POST['c2']) . "' AND
p.date >= '" . addslashes($_POST['id4']) . "' AND
p.date <= '" . addslashes($_POST['id3']) . "' AND
p.presence='" . addslashes($_POST['presenceask']) . "' AND
p.classe='" . addslashes($_POST['c3']) . "'
LIMIT " . $Firstentree . ", " . $linepropage . "");


					while ($ligne = mysqli_fetch_array($dr)) {
						?>
						<tr>
							<td>
								<?php echo addslashes($ligne[0]); ?>
								<?php echo '<input type="hidden" name="code[]" value="', addslashes($ligne[0]), '" >'; ?>
							</td>
							<td>
								<?php echo addslashes($ligne[1]); ?>
								<?php echo '<input type="hidden" name="date[]" value="', addslashes($ligne[1]), '" >'; ?>
							</td>
							<td>
								<?php echo addslashes($ligne[7]); ?>
								<?php echo '<input type="hidden" name="course[]" value="', addslashes($ligne[7]), '" >'; ?>
							</td>
							<td>
								<?php echo addslashes($ligne[2]); ?>
								<?php echo '<input type="hidden" name="name[]" value="', addslashes($ligne[2]), '" >'; ?>
							</td>
							<td>
								<?php echo addslashes($ligne[3]); ?>
								<?php echo '<input type="hidden" name="firstname[]" value="', addslashes($ligne[3]), '" >'; ?>
							</td>
							<td width=120><select name="presence[]" style="width:100px;">
									<option <?php if (addslashes($ligne[4]) == "anwesend")
										echo 'selected'; ?> value="anwesend">
										anwesend</option>
									<option <?php if (addslashes($ligne[4]) == "abwesend")
										echo 'selected'; ?> value="abwesend">
										abwesend</option>
									<option <?php if (addslashes($ligne[4]) == "verspätet")
										echo 'selected'; ?> value="verspätet">
										verspätet</option>
									<?php echo '<input type="hidden" name="presencebefor[]" value="', addslashes($ligne[4]), '" >'; ?>
							</td>

							<td width=100><input type="text" name="comment[]" value="<?php echo addslashes($ligne[5]); ?>"
									maxlength="50">
								<?php echo '<input type="hidden" name="commentbefor[]" value="', addslashes($ligne[5]), '" >'; ?>
							<td width=50> &nbsp;&nbsp;&nbsp;<?php if (addslashes($ligne[6]) == "1") {
								echo "<img src='../img/s_success.png'/>";
							} ?></td>

							<td width=50> &nbsp;&nbsp;&nbsp;<input name="chck[]" type="checkbox" value="1" <?php if ($ligne[8] == 1) {
								echo "checked='checked'";
							} ?>></td>
							<?php echo '<input type="hidden" name="chckbefor[]" value="' . addslashes($ligne[8]) . '" >'; ?>
						</tr>

						<?php
					}

					?>
		</form>
		</tbody>
		</table>

		<?php
		// Pied de page


		echo '<BR><font size=2><p align="center">Seite : ';
		for ($i = 1; $i <= $numberofpages; $i++) {

			if ($i == $Actuelpage) {
				echo ' [ ' . $i . ' ] ';
			} else {
				echo ' <a href="presenceclass.php?page=' . $i . '">' . $i . '</a> ';
			}
		}
		echo '</p></font>';
		?>
		<br>

		<center><input name="b4" type="submit" class="btn btn-success" value="Bestätigen" id="b4"></center>

		<?php

		}
	}


	if (isset($_POST['b4'])) {


		foreach ($_POST['code'] as $key => $value) {
			if (isset($_POST['chck'][$key])) {
				$_POST['chck'][$key] = 1;
			} else {
				$_POST['chck'][$key] = 0;
			}

			if ($_POST['presencebefor'][$key] !== $_POST['presence'][$key] or $_POST['commentbefor'][$key] !== $_POST['comment'][$key] or $_POST['chckbefor'][$key] !== $_POST['chck'][$key]) {
				$dr = mysqli_query($cn, " UPDATE presence SET presence = '" . addslashes($_POST['presence'][$key]) . "', comment = '" . addslashes($_POST['comment'][$key]) . "', zeugnis = '" . $_POST['chck'][$key] . "' WHERE code = '" . addslashes($value) . "'");
			}
		}

		print "<script>window.location='presenceclass.php';</script>";
	}


	?>
</form>
</section>


<?php
include 'menubottom.php';

?>
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
	<h2>Fach einem Lehrer zuordnen</h2>
</div>

<div>
	<form id="form1" name="form1" method="post">
		<table width="300" align="center">

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
					</select> &nbsp;
				</td>
				<td>Klasse</td>
				<td><select name="c3" style="width:170px;">
						<option value="">Wählen Sie aus</option>
						<?php
						$requete = 'SELECT classe FROM `classe` ORDER BY id ASC';
						$result = mysqli_query($cn, $requete);
						while ($ligne = mysqli_fetch_array($result)) {
							echo '<option>', addslashes($ligne['classe']), '</option>';
						}
						?>
					</select> &nbsp;</td>
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
					</select></td>
				<td>Fach</td>
				<td><select name="c4" style="width:170px;">
						<option value="">Wählen Sie aus</option>
						<?php
						$requete = 'SELECT code, name FROM `course`';
						$result = mysqli_query($cn, $requete);
						while ($ligne = mysqli_fetch_array($result)) {
							echo '<option value=', addslashes($ligne['code']), '>', addslashes($ligne['name']), '</option>';
						}
						?>
					</select> &nbsp;</td>
				<td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Hinzufügen"></td>
			</tr>
		</table>
		<br>
</div>
<table width="80%" border="2" align="center" class="table-style-two">
	<tbody>
		<tr>
			<th><b>Code</b></th>
			<th><b>Jahr</b></th>
			<th><b>Semester</b></th>
			<th><b>Klasse</b></th>
			<th><b>Fach</b></th>
			<th width="100"><b></b></th>
		</tr>

		<?php


		$dr = mysqli_query($cn, "SELECT code, year, semester, classe, course from profcourse WHERE prof ='" . $_SESSION['login'] . "'");


		if (isset($_POST['submit'])) {
			$dr = mysqli_query($cn, "DELETE FROM profcourse WHERE code ='" . addslashes($_POST['submit']) . "'");
			$dr = mysqli_query($cn, "SELECT code, year, semester, classe, course from profcourse WHERE prof ='" . addslashes($_SESSION['login']) . "'");
		}

		if (isset($_POST['b2'])) {
			if (addslashes($_POST['c1']) == '' or addslashes($_POST['c2']) == '' or addslashes($_POST['c3']) == '' or addslashes($_POST['c4']) == '') {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			} else {
				;

				$requete = mysqli_query($cn, "SELECT * FROM profcourse where year='" . addslashes($_POST['c1']) . "' AND semester='" . addslashes($_POST['c2']) . "' AND prof='" . addslashes($_SESSION['login']) . "' AND course='" . addslashes($_POST['c4']) . "' AND classe='" . addslashes($_POST['c3']) . "'");
				$requeteVerif = mysqli_fetch_array($requete);

				if (empty($requeteVerif)) {
					$dr = mysqli_query($cn, "INSERT INTO profcourse values ('" . addslashes($_POST['c1']) . "', '" . addslashes($_POST['c2']) . "', '" . addslashes($_SESSION['login']) . "', '" . addslashes($_POST['c4']) . "', '" . addslashes($_POST['c3']) . "', '')");
				}


				$dr = mysqli_query($cn, "SELECT code, year, semester, classe, course from profcourse WHERE prof ='" . addslashes($_SESSION['login']) . "'");
			}
		}

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
					<center><button type="submit" name="submit" value="<?php echo $ligne[0]; ?>" class="btImg"><img
								src="../img/b_drop.png" /></button></center>
				</td>
			</tr>
			<?php
		}

		?>
	</tbody>
</table>
</form>

</section>



<?php
include 'menubottom.php';
?>
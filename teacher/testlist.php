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
	<h2>Prüfungsliste</h2> <I>Suchfenster</I>
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
					$requete = 'SELECT * FROM `classe` ORDER BY id ASC';
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
			<td>&nbsp;</td>
		</tr>
	</table>
	<br>


	<?php

	if (isset($_POST['submit'])) {
		$_SESSION['test'] = $_POST['submit'];
		print "<script>window.location='testlist2.php';</script>";
	}

	if (isset($_POST['submit2'])) {


		$dr = mysqli_query($cn, "SELECT * from test 
		WHERE prof='" . addslashes($_SESSION['login']) . "' AND
		code='" . addslashes($_POST['submit2']) . "'");


		$ligne = mysqli_fetch_array($dr);

		if (!empty($ligne)) {

			$dr = mysqli_query($cn, "DELETE FROM test WHERE code='" . addslashes($_POST['submit2']) . "'");
			$dr = mysqli_query($cn, "DELETE FROM testline WHERE test='" . addslashes($_POST['submit2']) . "'");

		} else {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Kann nicht gelöscht werden: Sie müssen der oder die Lehrer(in) für diese Prüfung sein. </center></b></font><br>";
		}



	}

	if (isset($_POST['b2']) or isset($_POST['submit2'])) {
		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {

			?>
			<table width="700" border="2" align="center" class="table-style-two">
				<tbody>
					<tr>
						<th><b>Datum</b></th>
						<th><b>Prüfungscode</b></th>
						<th><b>Prüfungstyp</b></th>
						<th width=50></th>
						<th width=50></th>
					</tr>

					<?php

					$dr = mysqli_query($cn, "SELECT t.date, t.code, w.name 
 FROM test t, worktype w  
 WHERE t.worktype = w.code 
 and t.semester='" . addslashes($_POST['c2']) . "' 
 and t.classe='" . addslashes($_POST['c3']) . "' 
 and t.course='" . addslashes($_POST['c4']) . "' 
 and t.year='" . addslashes($_POST['c1']) . "' 
 ORDER BY t.date DESC");
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
							<td width=50> &nbsp;&nbsp;<button type="submit" name="submit" value="<?php echo $ligne[1]; ?>"
									class="btImg"><img src="../img/b_search.png" /></button></td>
							<td width=50> &nbsp;&nbsp;<button type="submit" name="submit2" value="<?php echo $ligne[1]; ?>"
									class="btImg"><img src="../img/b_drop.png" /></button></td>
						</tr>

						<?php
					}
					echo '</tbody>';
					echo '</table>';
		}
	}
	?>
</form>
</section>


<?php
include 'menubottom.php';
?>
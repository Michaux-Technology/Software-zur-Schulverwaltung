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
	<h2>Ihre Noten pro Schüler</h2> <I>Suchfenster</I>
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
			<td>&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td>Schülername:</td>

			<td><input type="text" name="t1" id="t1" value="<?php if (isset($_POST['t1'])) {
				echo $_POST['t1'];
			} ?>"
					size="19" style="width:170px;"></td>
			<td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Suchen"></td>
		</tr>
	</table>
	<br>
	<?php
	if (isset($_POST['submit'])) {
		$_SESSION['year'] = $_POST['c1'];
		$_SESSION['semester'] = $_POST['c2'];
		$_SESSION['classe'] = $_POST['c3'];
		$_SESSION['course'] = $_POST['c4'];
		$_SESSION['student'] = $_POST['submit'];

		print "<script>window.location='studentgrade2.php';</script>";
	}

	if (isset($_POST['b2'])) {
		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {


			?>
			<table width="700" border="2" align="center" class="table-style-two">
				<tbody>
					<tr>
						<th><b>Code</b></th>
						<th><b>Nachname</b></th>
						<th><b>Vorname</b></th>
						<th width=50></th>
					</tr>

					<?php


					$dr = mysqli_query($cn, "SELECT s.code, s.name, s.firstname 
 
 FROM registration r, student s, entry e 
 
 WHERE s.code = r.student 
 AND r.code=e.registration and r.semester='" . addslashes($_POST['c2']) . "' 
 AND r.classe='" . addslashes($_POST['c3']) . "' 
 AND e.course='" . addslashes($_POST['c4']) . "' 
 AND r.year='" . addslashes($_POST['c1']) . "' 
 AND concat(s.name, ' ', s.firstname) like '%" . addslashes($_POST['t1']) . "%'");

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
							<td width=50> &nbsp;&nbsp;<button type="submit" name="submit" value="<?php echo $ligne[0]; ?>"
									class="btImg"> <img src="../img/b_search.png"> </button></td>
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
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
	<h2>Zeugnisansicht </h2> <I>Suchfenster</I>
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
			<td></td>
			<td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Suchen"></td>
		</tr>

	</table>
	<br>
	<?php
	if (isset($_POST['b2'])) {

		if ($_POST['c1'] == '' or $_POST['c2'] == '') {
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


					$dr = mysqli_query($cn, "SELECT s.code, s.name, s.firstname, r.classe 
 
 FROM registration r, student s
 
 WHERE s.code = r.student

 AND r.semester='" . addslashes($_POST['c2']) . "' 
 AND r.year='" . addslashes($_POST['c1']) . "'
 AND s.user='" . addslashes($_SESSION['login']) . "'");

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
									class="btImg"> <img src="../img/b_search.png" /></button></td>
						</tr>


						<?php
					}
					echo '</tbody>';
					echo '</table>';
		}

	}

	if (isset($_POST['submit'])) {
		$_SESSION['year'] = $_POST['c1'];
		$_SESSION['semester'] = $_POST['c2'];
		$_SESSION['student'] = $_POST['submit'];


		$dr = mysqli_query($cn, "SELECT s.code, s.name, s.firstname, r.classe 
 FROM registration r, student s
 WHERE s.code = r.student
 AND r.semester='" . addslashes($_SESSION['semester']) . "' 
 AND r.year='" . addslashes($_SESSION['year']) . "'
 AND s.user='" . addslashes($_SESSION['login']) . "'");

		$ligne = mysqli_fetch_array($dr);
		$_SESSION['classe'] = addslashes($ligne[3]);

		$dr = mysqli_query($cn, "select * from generation 
	where year = '" . $_POST['c1'] . "' AND semester = '" . $_POST['c2'] . "' AND classe='" . $_SESSION['classe'] . "'");
		$resultat = mysqli_fetch_array($dr);

		if ($resultat[4] == 0) {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Die Zeugnisse sind noch nicht jetzt bereit. </center></b></font><br>";
		} else {

			print "<script>window.location='studentaverage2.php';</script>";

		}

	}

	if (isset($_POST['b2'])) {
	}
	?>
</form>
</section>


<?php
include 'menubottom.php';
?>
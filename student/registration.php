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

<section>
	<div class="col-lg-12 text-center">
		<h2>Anmeldungsliste</h2>
	</div>

	<form id="form1" name="form1" method="post">

		<table width="300%" border="0" align="center">
			<tr>
				<td>Schüler</td>
				<td>
					<select name="c5" style="width:170px;">
						<option value="">Wählen Sie aus</option>

						<?php
						$requete = "SELECT * FROM `student` where user='" . $_SESSION['login'] . "'";
						$result = mysqli_query($cn, $requete);
						while ($ligne = mysqli_fetch_array($result)) {
							$selectionnee = ($ligne[0] == $_POST["c5"]) ? " SELECTED " : "";
							echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", addslashes($ligne['firstname']), '</option>';

						}
						?>
					</select>
				</td>
				<td><input name="b3" type="submit" class="btn btn-success" value="Suchen" id="b3"></td>
			</tr>
		</table>


		<?php
		if (isset($_POST['b2'])) {
			if (addslashes($_POST['c1']) == '' or addslashes($_POST['c2']) == '' or addslashes($_POST['c3']) == '') {
			} else {

				$dr2 = mysqli_query($cn, "SELECT * 
FROM registration
WHERE semester='" . addslashes($_POST['c2']) . "' 
AND year='" . addslashes($_POST['c1']) . "' 
AND student='" . addslashes($_SESSION['codestudent']) . "'");
				$ligne2 = mysqli_fetch_array($dr2);

				if (empty($ligne2)) {

					$requete = "INSERT INTO registration VALUES ('','" . addslashes($_POST['c1']) . "','" . addslashes($_POST['c2']) . "','','" . addslashes($_POST['c5']) . "','" . addslashes($_POST['c3']) . "')";
					$result = mysqli_query($cn, $requete);
				} else {
					$requete = "UPDATE registration SET classerequired='" . addslashes($_POST['c3']) . "'
WHERE semester='" . addslashes($_POST['c2']) . "' 
AND year='" . addslashes($_POST['c1']) . "' 
AND student='" . addslashes($_SESSION['codestudent']) . "'";
					$result = mysqli_query($cn, $requete);
				}



			}
		}
		if (isset($_POST['submit'])) {

			$requete = "SELECT classe FROM `registration` WHERE code='" . addslashes($_POST['submit']) . "'";
			$result = mysqli_query($cn, $requete);
			$ligne = mysqli_fetch_array($result);

			if (addslashes($ligne[0]) == '') {

				$requete = "DELETE FROM `registration` WHERE code='" . $_POST['submit'] . "'";
				$dr = mysqli_query($cn, $requete);
			} else {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Eine bereits bestätigte Anmeldung kann nicht gelöscht werden.</center></b></font><br>";
			}

		}
		if (isset($_POST['b3']) or isset($_POST['b2']) or isset($_POST['submit'])) {
			if ($_POST['c5'] == '') {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			} else {

				$requete = "SELECT * FROM `registration` WHERE student='" . addslashes($_POST['c5']) . "'";
				$dr = mysqli_query($cn, $requete);

				?>
				<br>
				<center><b>Ihre Anmeldungsliste</b></center>
				<table width="50%" border="2" align="center" class="table-style-two">
					<tr>
						<th>Jahr</th>
						<th>Schulhalbjahr</th>
						<th>Klasse gefragt</th>
						<th>akzeptiert in Klasse</th>
						<th width='50'></th>
					</tr>
					<?php
					while ($ligne = mysqli_fetch_array($dr)) {
						?>
						<tr>
							<td>
								<?php echo addslashes($ligne[1]); ?>
							</td>
							<td>
								<?php echo addslashes($ligne[2]); ?>
							</td>
							<td>
								<?php echo addslashes($ligne[5]); ?>
							</td>
							<td>
								<?php echo addslashes($ligne[3]); ?>
							</td>
							<td> &nbsp;&nbsp;<button type="submit" name="submit" value="<?php echo $ligne[0]; ?>" class="btImg">
									<img src="../img/b_drop.png" /></button></td>
						</tr>

						<?php
					}
					?>
				</table>
				<br>

				<center><b>Eine Anmeldung hinzufügen</b></center>
				<table width="50%" border="2" align="center" class="table-style-two">
					<tr>
						<th>Jahr</th>
						<th>Schulhalbjahr</th>
						<th>Klasse gefragt</th>
						<th></th>
					</tr>
					<tr>
						<td> <select name="c1" style="width:170px;">

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
							</select></td>
						<td> <select name="c2" style="width:170px;">


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
						<td> <select name="c3" style="width:170px;">
								<option value="">Wählen Sie aus</option>

								<?php
								$requete = 'SELECT code FROM classerequired';
								$result = mysqli_query($cn, $requete);
								while ($ligne = mysqli_fetch_array($result)) {
									$selectionnee = ($ligne[0] == $_POST["c3"]) ? " SELECTED " : "";
									echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", addslashes($ligne['code']), '</option>';
								}
								?>
							</select></td>
						<td><input name="b2" type="submit" class="btn btn-success" value="hinzufügen" id="b2"></td>
					</tr>
				</table>
				<?php
			}
		}

		?>
	</form>
</section>


<?php
include 'menubottom.php';
?>
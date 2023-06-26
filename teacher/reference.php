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
	<form action="" method="post">
		<div class="col-lg-12 text-center">
			<center>
				<h2>
					<center>Aktuelles Jahr und Semester</center>
				</h2>
				<br>

				<table>
					<tr>
						<td>
							Jahr</td>
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
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td></td>
					</tr>

					<tr>
						<td>Schulhalbjahr</td>
						<td>
							<select name="c2" style="width:170px;">

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
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td><input name="b1" type="submit" class="btn btn-success" value="bestätigen" id="b1"></td>
					</tr>

				</table>


				<?php
				if (isset($_POST['b1'])) {
					$requete = "UPDATE reference SET year='" . addslashes($_POST['c1']) . "', semester='" . addslashes($_POST['c2']) . "' where code='1';";
					$result = mysqli_query($cn, $requete);

				}
				?>

			</center>

	</form>
	</div>
	<div>&nbsp;</div>

	<?php
	include 'menubottom.php';
	?>
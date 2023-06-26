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
		<h2>Kontrolle der Planung</h2>
	</div>
	<form id="form1" name="form1" method="post">

		<table width="300" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<th><b>Code</b></th>
					<th><b>Stunde</b></th>
					<th><b>Montag</b></th>
					<th><b>Dienstag</b></th>
					<th><b>Mittwoch</b></th>
					<th><b>Donnerstag</b></th>
					<th><b>Freitag</b></th>
					<th><b>Samstag</b></th>
					<th width="100"><b></b></th>
				</tr>

				<?php

				// insert a course SQL code
				if (isset($_POST['b3'])) {

					if (addslashes($_POST['id1']) == '') {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein </center></b></font><br>";
					} else {
						$dr = mysqli_query($cn, "INSERT INTO planning (name) VALUES ('" . addslashes($_POST['id1']) . "')");
					}
				}

				// Delete a course
				if (isset($_POST['submit'])) {
					$requete = "SELECT worktype FROM `test` WHERE worktype='" . addslashes($_POST['submit']) . "'";
					$result = mysqli_query($cn, $requete);
					$ligne = mysqli_fetch_array($result);

					if (!empty($ligne)) {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Dieser Prüfungstyp wird für die Prüfungen benutzt. Er kann nicht gelöscht werden. </center></b></font><br>";
					} else {
						$requete = "SELECT * FROM `coefwork` WHERE worktype='" . addslashes($_POST['submit']) . "'";
						$result = mysqli_query($cn, $requete);
						$ligne = mysqli_fetch_array($result);

						if (!empty($ligne)) {
							echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Dieser Prüfungstyp ist für ein Fach gewählt. Er kann nicht gelöscht werden. </center></b></font><br>";
						} else {
							$dr = mysqli_query($cn, "DELETE FROM worktype where code='" . addslashes($_POST['submit']) . "'");
						}

					}
				}

				$dr = mysqli_query($cn, "SELECT * from planning");
				while ($ligne = mysqli_fetch_array($dr)) {
					?>

					<tr>
						<td>
							<?php echo addslashes($ligne[0]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[6]); ?>
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
							<?php echo addslashes($ligne[5]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[6]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[7]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[8]); ?>
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
		<br><br>

		<table width="300" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<center><strong>Stunde hinzufügen</strong></center><br>
				</tr>
				<tr>
					<th>
						<center><b>Stunde</b></center>
					</th>
					<th>
						<center><b>Montag</b></center>
					</th>
					<th>
						<center><b>Dienstag</b></center>
					</th>
					<th>
						<center><b>Mittwoch</b></center>
					</th>
					<th>
						<center><b>Donnerstag</b></center>
					</th>
					<th>
						<center><b>Freitag</b></center>
					</th>
					<th>
						<center><b>Samstag</b></center>
					</th>
				</tr>
				<tr>
					<td><select name="stunde" style="width:60px;">
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '1.')
									echo 'selected';
							} ?> value="anwesend">1.</option>
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '2.')
									echo 'selected';
							} ?> value="abwesend">2.</option>
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '3.')
									echo 'selected';
							} ?> value="verspätet">3.</option>
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '4.')
									echo 'selected';
							} ?> value="verspätet">4.</option>
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '5.')
									echo 'selected';
							} ?> value="verspätet">5.</option>
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '6.')
									echo 'selected';
							} ?> value="verspätet">6.</option>
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '7.')
									echo 'selected';
							} ?> value="verspätet">7.</option>
							<option <?php if (isset($_POST['stunde'])) {
								if ($_POST['stunde'] == '8.')
									echo 'selected';
							} ?> value="verspätet">8.</option>
						</select>
					</td>
					<td><select name="montag" style="width:120px;">
							<?php
							$requete = 'SELECT code, name FROM `course`';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["montag"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
							}
							?>
						</select></td>
					<td><select name="dienstag" style="width:120px;">
							<?php
							$requete = 'SELECT code, name FROM `course`';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["c2"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['dienstag']), "' $selectionnee >", $ligne['name'], '</option>';
							}
							?>
						</select></td>
					<td><select name="mittwoch" style="width:120px;">
							<?php
							$requete = 'SELECT code, name FROM `course`';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["mittwoch"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
							}
							?>
						</select></td>
					<td><select name="donnerstag" style="width:120px;">
							<?php
							$requete = 'SELECT code, name FROM `course`';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["donnerstag"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
							}
							?>
						</select></td>
					<td><select name="freitag" style="width:120px;">
							<?php
							$requete = 'SELECT code, name FROM `course`';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["freitag"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
							}
							?>
						</select></td>
					<td><select name="samstag" style="width:120px;">
							<?php
							$requete = 'SELECT code, name FROM `course`';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["samstag"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
							}
							?>
						</select></td>

				</tr>
				<tr>
					<td colspan="9">
						<center><input name="b3" type="submit" class="btn btn-success" value="Hinzufügen" id="b3">
						</center>
					</td>
				</tr>

			</tbody>
		</table>
	</form>
</section>


<?php
include 'menubottom.php';
?>
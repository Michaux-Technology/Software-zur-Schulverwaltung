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
		<h2>Prüfungstyp</h2>
	</div>
	<form id="form1" name="form1" method="post">

		<table width="300" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<th><b>Code</b></th>
					<th><b>Name</b></th>
					<th width="100"><b></b></th>
				</tr>

				<?php

				if (isset($_POST['b3'])) {

					if (addslashes($_POST['id1']) == '') {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein </center></b></font><br>";
					} else {
						$dr = mysqli_query($cn, "INSERT INTO worktype (name) VALUES ('" . addslashes($_POST['id1']) . "')");
					}

				}

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

				$dr = mysqli_query($cn, "SELECT * from worktype");
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
					<center><strong>Prüfungstyp hinzufügen</strong></center>
				</tr>
				<tr>
					<th>
						<center><b>Name</b></center>
					</th>
				</tr>

				</tr>
				<tr>
					<td>
						<center><input type="text" name="id1" id="id1"></center>
					</td>
					<td><input name="b3" type="submit" class="btn btn-success" value="Hinzufügen" id="b3"></td>
				</tr>
			</tbody>
		</table>
	</form>
</section>


<?php
include 'menubottom.php';
?>
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
	<h2>Umrechnungstabelle nach Fach</h2>
</div>

<form id="form1" name="form1" method="post">

	<table width="300" border="0" align="center">

		<tr>
			<td>Fach</td>
			<td><select name="c3" style="width:170px;">
					<option value="">Wählen Sie aus</option>

					<?php

					$requete = 'SELECT code, name FROM course';
					$result = mysqli_query($cn, $requete);
					while ($ligne = mysqli_fetch_array($result)) {
						$selectionnee = ($ligne[0] == $_POST["c3"]) ? " SELECTED " : "";
						echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
					}

					?>
				</select>
				&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Prüfungstyp</td>
			<td><select name="c4" style="width:170px;">
					<option value="">Wählen Sie aus</option>
					<?php
					$requete = 'SELECT code, name FROM worktype';
					$result = mysqli_query($cn, $requete);
					while ($ligne = mysqli_fetch_array($result)) {
						$selectionnee = ($ligne[0] == $_POST["c4"]) ? " SELECTED " : "";
						echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
					}
					?>
				</select>

				&nbsp;</td>
			<td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Suchen"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<?php
	if (isset($_POST['b2']) or isset($_POST['submit']) or isset($_POST['b3'])) {
		$dr10 = mysqli_query($cn, "SELECT glevel,elevel from level");
		$ligne10 = mysqli_fetch_array($dr10);
		?>


		<table width="60%" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<th><b>Code</b></th>
					<th><b>Punkte</b></th>
					<th><b>Prozent von</b></th>
					<th><b>Prozent bis</b></th>
					<th><b>
							<?php echo addslashes($ligne10[1]); ?> Niveau
						</b></th>
					<th><b>
							<?php echo addslashes($ligne10[0]); ?> Niveau
						</b></th>
					<th width="100"><b></b></th>
				</tr>

				<?php
	}
	if (isset($_POST['b2'])) {
		$dr = mysqli_query($cn, "SELECT * FROM worktypescale WHERE worktype ='" . addslashes($_POST['c4']) . "' and course='" . addslashes($_POST['c3']) . "' ORDER BY point DESC");

	}

	if (isset($_POST['submit'])) {
		$dr = mysqli_query($cn, "DELETE FROM worktypescale where code='" . addslashes($_POST['submit']) . "'");
		$dr = mysqli_query($cn, "SELECT * FROM worktypescale WHERE worktype ='" . addslashes($_POST['c4']) . "' and course='" . addslashes($_POST['c3']) . "' ORDER BY point DESC");

	}

	if (isset($_POST['b3'])) {
		if (addslashes($_POST['id1']) == '' or addslashes($_POST['id2']) == '' or addslashes($_POST['id3']) == '' or addslashes($_POST['id4']) == '' or addslashes($_POST['id5']) == '' or addslashes($_POST['c4']) == '' or addslashes($_POST['c3']) == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {

			$dr = mysqli_query($cn, "SELECT * from worktypescale WHERE worktype ='" . addslashes($_POST['c4']) . "' AND course='" . addslashes($_POST['c3']) . "' AND point='" . addslashes($_POST['id1']) . "'");
			$ligne = mysqli_fetch_array($dr);

			if (!empty($ligne)) {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Dieser Punkt ist bereits gespeichert </center></b></font><br>";
			} else {

				$dr = mysqli_query($cn, "INSERT INTO worktypescale (point, percentagefrom, percentagebis, niveauE, niveauG, worktype, course) VALUES ('" . addslashes($_POST['id1']) . "', '" . addslashes($_POST['id2']) . "', '" . addslashes($_POST['id3']) . "', '" . addslashes($_POST['id4']) . "', '" . addslashes($_POST['id5']) . "', '" . addslashes($_POST["c4"]) . "','" . addslashes($_POST["c3"]) . "')");

			}
			$dr = mysqli_query($cn, "SELECT * FROM worktypescale WHERE worktype ='" . addslashes($_POST['c4']) . "' and course='" . addslashes($_POST['c3']) . "' ORDER BY point DESC");
		}

	}


	if (isset($_POST['b2']) or isset($_POST['submit']) or isset($_POST['b3']) or isset($_POST['b3'])) {
		$dr = mysqli_query($cn, "SELECT * FROM worktypescale WHERE worktype ='" . addslashes($_POST['c4']) . "' and course='" . addslashes($_POST['c3']) . "' ORDER BY point DESC");
		while ($ligne = mysqli_fetch_array($dr)) {
			?>
					<tr>
						<td>
							<?php echo addslashes($ligne[7]); ?>
						</td>
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
							<center><button type="submit" name="submit" value="<?php echo $ligne[7]; ?>" class="btImg"><img
										src="../img/b_drop.png" /></button></center>
						</td>
					</tr>

					<?php
		}
	}

	?>
		</tbody>
	</table>
	<br><br>

	<?php
	if (isset($_POST['b2']) or isset($_POST['submit']) or isset($_POST['b3'])) {
		$dr10 = mysqli_query($cn, "SELECT glevel,elevel from level");
		$ligne10 = mysqli_fetch_array($dr10);
		?>

		<table width="50%" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<center><strong>Eine Note hinzufügen</strong></center>
				</tr>
				<tr>
					<th>
						<center><b>Punkte</b></center>
					</th>
					<th>
						<center><b>Prozent von</b></center>
					</th>
					<th>
						<center><b>Prozent bis</b></center>
					</th>
					<th><b>
							<?php echo addslashes($ligne10[1]); ?> Niveau
						</b></th>
					<th><b>
							<?php echo addslashes($ligne10[0]); ?> Niveau
						</b></th>


				</tr>

				</tr>
				<tr>
					<td>
						<center><input type="text" name="id1" id="id1"></center>
					</td>
					<td>
						<center><input type="text" name="id2" id="id2"></center>
					</td>
					<td>
						<center><input type="text" name="id3" id="id3"></center>
					</td>
					<td>
						<center><input type="text" name="id4" id="id4"></center>
					</td>
					<td>
						<center><input type="text" name="id5" id="id5"></center>
					</td>
					<td><input name="b3" type="submit" class="btn btn-success" value="Hinzufügen" id="b3"></td>
				</tr>
			</tbody>
		</table>
		<br>
	<?php
	}

	?>
</form>
</section>


<?php
include 'menubottom.php';
?>
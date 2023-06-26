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
	<h2>Fächergruppe</h2>
</div>
<form id="form1" name="form1" method="post">
	<?php
	if (isset($_POST['b3'])) {
		if ($_POST['t1'] == '' or $_POST['t2'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {
			$sql = "INSERT INTO coursegroup (code, name) VALUES ('" . addslashes($_POST['t2']) . "', '" . addslashes($_POST['t1']) . "')";
			$result = mysqli_query($cn, $sql);
		}
	}
	if (isset($_POST['b5'])) {
		$sql = "DELETE FROM coursegroup WHERE code='" . addslashes($_POST['c1']) . "'";
		$result = mysqli_query($cn, $sql);
	}
	?>
	<table width="300" border="0" align="center">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Fächergruppe</td>
			<td><select name="c1" style="width:170px;">
					<option value="">Wählen Sie aus</option>


					<?php
					$requete = 'SELECT code, name FROM `coursegroup`';
					$result = mysqli_query($cn, $requete);
					while ($ligne = mysqli_fetch_array($result)) {
						$selectionnee = ($ligne[0] == $_POST["c1"]) ? " SELECTED " : "";
						echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
					}
					?>
				</select>

				&nbsp;</td>
			<td><input name="b2" type="submit" class="btn btn-success" value="Suchen" id="b2">&nbsp;&nbsp;&nbsp;<input
					name="b5" type="submit" class="btn btn-success" value="Löschen" id="b5"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Neue Gruppe</td>
			<td>Code <input name="t2" style="width:70px;"></td>
			<td>Name <input name="t1" style="width:170px;"></td>
			<td><input name="b3" type="submit" class="btn btn-success" value="Hinzufügen" id="b3"></td>
		</tr>
	</table>
	<br>

	<?php

	if (isset($_POST['submit2'])) {
		$dr = mysqli_query($cn, "UPDATE course SET coursegroup='' WHERE code='" . addslashes($_POST['submit2']) . "'");
	}

	if (isset($_POST['b4'])) {
		$sql = "UPDATE course SET coursegroup ='" . addslashes($_POST['c1']) . "' 
	 WHERE code='" . addslashes($_POST['c2']) . "'";
		$result = mysqli_query($cn, $sql);
	}

	if (isset($_POST['b2']) or isset($_POST['b4']) or isset($_POST['submit2'])) {
		$sql = "SELECT code, name 
FROM course 
WHERE coursegroup='" . addslashes($_POST['c1']) . "'";
		$result = mysqli_query($cn, $sql);

		?>

		<table width="80%" border="2" align="center" class="table-style-two">
			<thead>
				<th width="200px">Code</th>
				<th>Name</th>
				<th width=50></th>

				<?php
				while ($ligne = mysqli_fetch_array($result)) {
					?>

					<tr>
						<td>
							<?php echo addslashes($ligne[0]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[1]); ?>
						</td>
						<td width=50> &nbsp;&nbsp;<button type="submit" name="submit2" value="<?php echo $ligne[0]; ?>"
								class="btImg"><img src="../img/b_drop.png" /></button></td>
					</tr>
				<?php } ?>
		</table>
		<br>

		<table width="300" border="0" align="center">
			<tr>
				<td><b>Ein Fach hinzufügen</b></td>
			</tr>
		</table>

		<table width="80%" border="2" align="center" class="table-style-two">
			<thead>
				<th width="200px">Fach</th>
				<th width="200px"></th>

				<tr>
					<td><select name="c2" style="width:170px;">
							<?php
							$requete = 'SELECT code, name FROM `course`';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["c2"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
							}
							?>
						</select></td>

					<td><input name="b4" type="submit" class="btn btn-success" value="Hinzufügen" id="b4"></td>
				</tr>

		</table>
		</tbody>






	<?php } ?>
</form>

</section>

<?php
include 'menubottom.php';
?>
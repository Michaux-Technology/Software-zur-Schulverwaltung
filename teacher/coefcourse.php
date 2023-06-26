<?php

//========================================================================
// Author:  Valéry Jérôme Michaux
// Resume:  http://michaux.link
//
// Copyright (c) 2017 Valéry Jérôme Michaux
//
// Published under the OpenSource license with restiction : 
https://github.com/michaux4/SchoolManagementSoftware
//          Consider it as a proof of concept!
//          No warranty of any kind.
//          Use and abuse at your own risks.
//========================================================================

include 'menuhead.php';
?>


</form>
<section>
	<div class="col-lg-12 text-center">
		<h3>Fächer</h3>
	</div>
	<form id="form1" name="form1" method="post">

		<table width="300" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<th><b>Code</b></th>
					<th><b>Fach</b></th>
					<th><b>Koeffizient</b></th>
					<th width="100"><b></b></th>
				</tr>

				<?php
				if (isset($_POST['submit'])) {
					$requete = "SELECT course FROM `test` WHERE course='" . addslashes($_POST['submit']) . "'";
					$result = mysqli_query($cn, $requete);
					$ligne = mysqli_fetch_array($result);

					if (!empty($ligne)) {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Dieses Fach ist benutzt. Es kann nicht gelöscht. </center></b></font><br>";
					} else {
						$dr = mysqli_query($cn, "DELETE FROM course WHERE code ='" . addslashes($_POST['submit']) . "'");
						$dr = mysqli_query($cn, "SELECT * from course");
					}
				}


				if (isset($_POST['b1'])) {
					if (addslashes($_POST['t1']) == '' or addslashes($_POST['t2']) == '' or addslashes($_POST['t3']) == '') {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'>Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
					} else {
						$dr = mysqli_query($cn, "INSERT INTO course VALUES ('" . addslashes($_POST['t1']) . "', '" . addslashes($_POST['t2']) . "', '" . addslashes($_POST['t3']) . "','')");
					}
				}
				$dr = mysqli_query($cn, "SELECT * from course");
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
							<center><button type="submit" name="submit" value="<?php echo $ligne[0]; ?>" class="btImg"><img
										src="../img/b_drop.png" /></button></center>
						</td>
					</tr>

					<?php

				}


				?>
			</tbody>
		</table>


		<BR><BR>
		<center><b>Ein Fach hinzufügen</b></center>
		<table width="40%" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>

					<th><b>Code</b></th>
					<th><b>Fach</b></th>
					<th><b>Koeffizient</b></th>

				</tr>
				<tr>

					<td><input name="t1" type="texte" id="t1" size="10"></td>
					<td><input name="t2" type="texte" id="t1" size="30"></td>
					<td><input name="t3" type="texte" id="t1" size="3"></td>
					<td><input name="b1" type="submit" id="b1" class="btn btn-success" value="Hinzufügen"></td>
				</tr>
			</tbody>
		</table>
	</form>
</section>



<?php
include 'menubottom.php';
?>
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
$dr10 = mysqli_query($cn, "SELECT glevel,elevel from level");
$ligne10 = mysqli_fetch_array($dr10);
?>


<div class="col-lg-12 text-center">
	<h2>Umrechnungstabelle allegemein</h2>
</div>

<form id="form1" name="form1" method="post">

	<table width="60%" border="2" align="center" class="table-style-two">
		<tbody>
			<tr>
				<th><b>Code</b></th>
				<th><b>Punkte</b></th>
				<th><b>
						<?php echo addslashes($ligne10[1]); ?> Niveau
					</b></th>
				<th><b>
						<?php echo addslashes($ligne10[0]); ?> Niveau
					</b></th>
				<th width="100"><b></b></th>
			</tr>

			<?php


			if (isset($_POST['submit'])) {
				$dr = mysqli_query($cn, "DELETE FROM averagescale where code='" . addslashes($_POST['submit']) . "'");
			}

			if (isset($_POST['b3'])) {
				if (addslashes($_POST['id1']) == '' or addslashes($_POST['id2']) == '' or addslashes($_POST['id3']) == '') {
					echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
				} else {

					$dr = mysqli_query($cn, "SELECT * from averagescale WHERE point='" . addslashes($_POST['id1']) . "'");
					$ligne = mysqli_fetch_array($dr);

					if (!empty($ligne)) {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Dieser Punkt ist bereits gespeichert </center></b></font><br>";
					} else {
						$dr = mysqli_query($cn, "INSERT INTO averagescale (point, niveauE, niveauG) VALUES ('" . addslashes($_POST['id1']) . "', '" . addslashes($_POST['id2']) . "', '" . addslashes($_POST['id3']) . "')");

					}
				}
			}

			$dr = mysqli_query($cn, "SELECT * FROM averagescale ORDER BY point DESC");
			while ($ligne = mysqli_fetch_array($dr)) {
				?>
				<tr>
					<td>
						<?php echo addslashes($ligne[0]); ?>
					</td>
					<td>
						<?php echo addslashes($ligne[3]); ?>
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
			$dr10 = mysqli_query($cn, "SELECT glevel,elevel from level");
			$ligne10 = mysqli_fetch_array($dr10);
			?>
		</tbody>
	</table>
	<br><br>

	<table width="50%" border="2" align="center" class="table-style-two">
		<tbody>
			<tr>
				<center><strong>Eine Note hinzufügen</strong></center>
			</tr>
			<tr>
				<th>
					<center><b>Punkte</b></center>
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
				<td><input name="b3" type="submit" class="btn btn-success" value="Hinzufügen" id="b3"></td>
			</tr>
		</tbody>
	</table>
	<br>
</form>
</section>


<?php
include 'menubottom.php';
?>
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

		<?php
		$requete = 'SELECT * FROM `level`';
		$result = mysqli_query($cn, $requete);
		$ligne = mysqli_fetch_array($result);
		?>

		<div class="col-lg-12 text-center">
			<h2>Niveaus</h2>
		</div>
		<br><br><br><br><br>
		<table width="300" border="0" align="center">

			<td>Normales Niveau</td>
			<td>
				<input type="text" name="message1" id="message1" value="<?php echo addslashes($ligne[1]); ?>"
					style="width:170px;">
			</td>
			<td>Unterniveau</td>
			<td>
				<input type="text" name="message2" id="message2" value="<?php echo addslashes($ligne[2]); ?>"
					style="width:170px;">
			</td>
		</table>
		<br>

		<center><input name="b3" type="submit" class="btn btn-success" value="Abbrechen " id="b3">&nbsp;&nbsp;<input
				name="b2" type="submit" class="btn btn-success" value="Bestätigen" id="b2"></center>


		<?php


		if (isset($_POST['b2'])) {
			$requete = "UPDATE level
	SET Elevel='" . addslashes($_POST['message1']) . "', Glevel='" . addslashes($_POST['message2']) . "' WHERE code ='1'";
			$result = mysqli_query($cn, $requete);
			print "<script>window.location='homeprof.php';</script>";
		}

		if (isset($_POST['b3'])) {

			print "<script>window.location='homeprof.php';</script>";
		}

		$requete = 'SELECT * FROM `school`';
		$result = mysqli_query($cn, $requete);
		$ecole = mysqli_fetch_array($result);
		?>
	</form>
</section>



<?php
include 'menubottom.php';
?>
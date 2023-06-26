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

		<h2>
			<center>Nachrichten für Lehrer</center>
		</h2>
		<br>

		<?php

		$requete = 'SELECT * FROM `message`';
		$result = mysqli_query($cn, $requete);
		$ligne = mysqli_fetch_array($result);
		?>

		<center><textarea name="message1" id="message1" cols="90"
				rows="15"><?php echo addslashes($ligne[1]); ?></textarea></center>
		<br>
		<h2>
			<center>Nachrichten für Eltern</center>
		</h2>
		<br>
		<center><textarea name="message2" id="message2" cols="90"
				rows="15"><?php echo addslashes($ligne[2]); ?></textarea></center>
		<br>
		<center><input name="b3" type="submit" class="btn btn-success" value="Abbrechen " id="b3">&nbsp;&nbsp;<input
				name="b2" type="submit" class="btn btn-success" value="Bestätigen" id="b2"></center>


		<?php


		if (isset($_POST['b2'])) {
			$text = $_POST['message1'];
			$healthy = array("'");
			$yummy = array("&apos;");
			$text = str_replace($healthy, $yummy, $text);

			$text2 = $_POST['message2'];
			$healthy = array("'");
			$yummy = array("&apos;");
			$text2 = str_replace($healthy, $yummy, $text2);

			$requete = "UPDATE message
	SET message='" . addslashes($text) . "', message2='" . addslashes($text2) . "' WHERE code ='1'";
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
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
			<center>Benutzeroberfläche </center>
		</h2>
		<br>

		<?php

		$requete = 'SELECT * FROM `interface`';
		$result = mysqli_query($cn, $requete);
		$interf = mysqli_fetch_array($result);
		?>
		<center><b>
				<center>Titel</center>
			</b></center>
		<center><input type="text" name="t1" id="t1" value="<?php echo addslashes($interf[1]); ?>" style="width:300px;">
		</center>
		<br>

		<center><b>
				<center>Nachricht</center>
			</b></center>
		<center><textarea name="message1" id="message1" cols="90"
				rows="8"><?php echo addslashes($interf[2]); ?></textarea></center>
		<br>

		<table width="300" border="0" align="center">
			<tr>
				<td><b>Titel 1</b></td>
				<td>&nbsp;</td>
				<td><b>Titel 2</b></td>
			</tr>
			<tr>
				<td><input type="text" name="t2" id="t2" value="<?php echo addslashes($interf[3]); ?>"
						style="width:300px;"></td>
				<td>&nbsp;</td>
				<td><input type="text" name="t3" id="t3" value="<?php echo addslashes($interf[4]); ?>"
						style="width:300px;"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><b>Nachricht</b></td>
				<td>&nbsp;</td>
				<td><b>Nachricht<b></td>
			</tr>
			<tr>
				<td><textarea name="message2" id="message2" cols="50"
						rows="8"><?php echo addslashes($interf[5]); ?></textarea></td>
				<td>&nbsp;</td>
				<td><textarea name="message3" id="message3" cols="50"
						rows="8"><?php echo addslashes($interf[6]); ?></textarea></td>
			</tr>
		</table>

		<br>
		<center><input name="b3" type="submit" class="btn btn-success" value="Abbrechen" id="b3">&nbsp;&nbsp;<input
				name="b2" type="submit" class="btn btn-success" value="Bestätigen" id="b2"></center>

		<?php
		if (isset($_POST['b2'])) {
			$requete = "UPDATE interface
	SET titre='" . addslashes($_POST['t1']) . "', message1='" . addslashes($_POST['message1']) . "', titre2='" . addslashes($_POST['t2']) . "', titre3='" . addslashes($_POST['t3']) . "', message2='" . addslashes($_POST['message2']) . "', message3='" . addslashes($_POST['message3']) . "' WHERE code ='1'";
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
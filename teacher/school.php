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
		<h2>Schule</h2>
	</div>
	<form action="" method="post">
		<br><br><br>
		<?php

		$requete = 'SELECT * FROM `school`';
		$result = mysqli_query($cn, $requete);
		$ecole = mysqli_fetch_array($result);
		?>

		<h2><b>
				<center>SCHULE</center>
			</b></h2>
		<table width="600" border="0" align="center">

			<tr>
				<td width="150"><b>Name</b></td>
				<td><input type="text" name="t1" id="t1" value="<?php echo addslashes($ecole[0]); ?>"
						style="width:300px;"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="text" name="t3" id="t3" value="<?php echo addslashes($ecole[1]); ?>"
						style="width:300px;"></td>
			</tr>
			<tr>
				<td width="150"><b>Adresse</b></td>
				<td><input type="text" name="t5" id="t5" value="<?php echo addslashes($ecole[3]); ?> "
						style="width:300px;"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="text" name="t7" id="t7" value="<?php echo addslashes($ecole[2]); ?> "
						style="width:50px;">
					<input type="text" name="t8" id="t8" value="<?php echo addslashes($ecole[8]); ?> "
						style="width:245px;">
				</td>
				<td></td>
			</tr>

		</table>

		<table width="600" border="0" align="center">
			<h2><b>
					<center>GRUPPE</center>
				</b></h2>
			<tr>
				<td width="150"><b>Name</b></td>
				<td><input type="text" name="t2" id="t2" value="<?php echo addslashes($ecole[4]); ?>"
						style="width:300px;"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="text" name="t4" id="t4" value="<?php echo addslashes($ecole[5]); ?> "
						style="width:300px;"></td>
			</tr>
			<tr>
				<td width="150"><b>Adresse</b></td>
				<td><input type="text" name="t6" id="t6" value="<?php echo addslashes($ecole[6]); ?>"
						style="width:300px;"></td>

			</tr>
			<tr>
				<td></td>
				<td><input type="text" name="t9" id="t9" value="<?php echo addslashes($ecole[7]); ?>"
						style="width:50px;">
					<input type="text" name="t10" id="t10" value="<?php echo addslashes($ecole[9]); ?>"
						style="width:245px;">
				</td>
			</tr>
		</table>

		<br>
		<center><input name="b3" type="submit" class="btn btn-success" value="Abbrechen" id="b3">&nbsp;&nbsp;<input
				name="b2" type="submit" class="btn btn-success" value="Bestätigen" id="b2"></center>
		<br>

		<?php
		if (isset($_POST['b2'])) {
			$requete = "UPDATE school
	SET schoolname1='" . $_POST['t1'] . "', schoolname2='" . $_POST['t3'] . "', schoolzip='" . $_POST['t7'] . "', schooladdress='" . $_POST['t5'] . "', groupname='" . $_POST['t2'] . "', 
	groupname2='" . $_POST['t4'] . "', groupaddress='" . $_POST['t6'] . "', groupzip='" . $_POST['t9'] . "', schoolcity='" . $_POST['t8'] . "', Groupcity='" . $_POST['t10'] . "'
	WHERE code ='1'";
			$result = mysqli_query($cn, $requete);
			print "<script>window.location='homeprof.php';</script>";
		}
		if (isset($_POST['b3'])) {
			print "<script>window.location='homeprof.php';</script>";
		}
		?>
	</form>
</section>


<?php
include 'menubottom.php';
?>
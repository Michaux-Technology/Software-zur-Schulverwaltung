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
	<h2>Noten der Prüfung</h2>
</div>

<form id="form1" name="form1" method="post">

	<table width="80%" border="2" align="center" class="table-style-two">
		<tbody>
			<tr>
				<th><b>Code</b></th>
				<th><b>Nachname</b></th>
				<th><b>Vorname</b></th>
				<th><b>Note</b></th>
				<th><b>Prozentsatz</b></th>
				<th><b>Punkte</b></th>
				<th><b>Niveau</b></th>
			</tr>

			<?php

			if (isset($_POST['b1'])) {
				$dr = mysqli_query($cn, "DELETE FROM test where code='" . addslashes($_SESSION['numtest']) . "'");
				$dr = mysqli_query($cn, "DELETE FROM testline where test='" . addslashes($_SESSION['numtest']) . "'");
				print "<script>window.location='testad.php';</script>";
			}

			if (isset($_POST['b2'])) {
				foreach ($_POST['code'] as $key => $value) {
					$pourcentage = $_POST['note'][$key] / $_SESSION['notemax'] * 100;
					$dr = mysqli_query($cn, "UPDATE testline SET note='" . $_POST['note'][$key] . "', grade='" . $pourcentage . "' WHERE code ='" . $value . "'");
					echo $_POST['code'][$key] . "<br>";
				}
			}

			if (isset($_POST['b3'])) {

				print "<script>window.location='testad.php';</script>";
			}

			$dr = mysqli_query($cn, "SELECT s.code, t.code, s.name, s.firstname, l.grade, w.percentagefrom, w.percentagebis, 
w.point, w.niveauE, w.niveauG, l.note, e.niveauG,
CASE WHEN e.niveauG = '1' THEN w.niveauG ELSE w.niveauE end as niveau, l.code  

FROM testline l, student s, test t, worktypescale w , entry e, registration r

WHERE l.student=s.code AND t.code=l.test AND w.worktype=t.worktype AND w.course=t.course

AND s.code = r.student AND r.code = e.registration and e.course=t.course
AND t.code='" . $_SESSION['numtest'] . "'

AND l.grade>=w.percentagefrom AND l.grade<=w.percentagebis 
ORDER BY s.name");

			while ($ligne = mysqli_fetch_array($dr)) {
				?>
				<tr>
					<td>
						<?php echo addslashes($ligne[0]); ?>
					</td>
					<td>
						<?php echo addslashes($ligne[2]); ?>
					</td>
					<td>
						<?php echo addslashes($ligne[3]); ?>
					</td>
					<TD width=120><input type="text" name="note[]" size="3" value="<?php echo addslashes($ligne[10]); ?>"
							style="width:100px;"></td>
					<TD width=60><?php echo addslashes($ligne[4]); ?></td>
					<TD width=90><?php echo addslashes($ligne[7]); ?></td>

					<input type="hidden" name="pourcentage[]" size="3" value="<?php echo addslashes($ligne[4]); ?>">
					<input type="hidden" name="point[]" size="3" value="<?php echo addslashes($ligne[7]); ?>">
					<input type="hidden" name="niveauE[]" size="3" value="<?php echo addslashes($ligne[8]); ?>">
					<input type="hidden" name="niveauG[]" size="3" value="<?php echo addslashes($ligne[9]); ?>">
					<input type="hidden" name="code[]" size="3" value="<?php echo addslashes($ligne[13]); ?>">
					<input type="hidden" name="niveau[]" size="3" value="<?php echo addslashes($ligne[12]); ?>"></td>
					<TD width=90><?php echo addslashes($ligne[12]); ?></td>
				</tr>

				<?php
				$pourcentage = addslashes($ligne[10]) / $_SESSION['notemax'] * 100;
				$dr2 = mysqli_query($cn, "UPDATE testline SET note='" . addslashes($ligne[10]) . "', grade='" . $pourcentage . "', point='" . addslashes($ligne[7]) . "', niveauE='" . addslashes($ligne[8]) . "', niveauG='" . addslashes($ligne[9]) . "', niveau='" . addslashes($ligne[12]) . "' WHERE code ='" . addslashes($ligne[13]) . "'");
			}
			?>
</form>
</tbody>
</table>
<?php

?>
<table width="300" border="0" align="center">
	<tbody>
		<tr>
			<td>&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td>
				<center><input name="b1" type="submit" id="b1" class="btn btn-success" value="Abbrechen "></center>
			</td>
			<td>
				<center><input name="b2" type="submit" id="b2" class="btn btn-success" value="Aktualisieren"></center>
			</td>
			<td>
				<center><input name="b3" type="submit" id="b3" class="btn btn-success" value="Bestätigen"></center>
			</td>
		</tr>
	</tbody>
</table>

</section>

<?php
include 'menubottom.php';
?>
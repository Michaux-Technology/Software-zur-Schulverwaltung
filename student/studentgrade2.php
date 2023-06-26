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


<form action="" method="post">

	<?php
	$dr = mysqli_query($cn, "SELECT name, firstname FROM student WHERE code='" . addslashes($_SESSION['student']) . "'");
	$ligne = mysqli_fetch_array($dr);
	$student = addslashes($ligne[0]) . " " . addslashes($ligne[1]);
	?>
	<center> Noten für <b>
			<?php echo $student; ?>
		</b></center>
	<center> im <b>
			<?php echo $_SESSION['semester']; ?>
		</b> <b>
			<?php echo $_SESSION['year']; ?>
		</b></center>
	<BR>
	<table width="700" border="2" align="center" class="table-style-two">
		<tbody>
			<tr>
				<th><b>Datum</b></th>
				<th><b>Kurs</b></th>
				<th><b>Fach</b></th>
				<th><b>Note</b></th>
			</tr>

			<?php

			if (isset($_POST['b3'])) {
				print "<script>window.location='studentgrade.php';</script>";
			}

			$dr = mysqli_query($cn, "SELECT t.date, c.name ,w.name, 
CASE WHEN e.niveauG = '1' THEN l.niveauG ELSE l.niveauE end as niveau
FROM testline l, test t, registration r, entry e, student s, worktype w, course c
WHERE t.code=l.test AND
t.year=r.year AND
t.semester=r.semester AND
t.classe=r.classe AND
l.student=r.student AND
e.registration=r.code AND
t.course=e.course AND
t.course=c.code AND
s.code=l.student AND
t.worktype=w.code AND
t.year='" . $_SESSION['year'] . "' AND
t.semester='" . $_SESSION['semester'] . "' AND
l.student='" . $_SESSION['student'] . "' AND 
t.visibility='1' 
ORDER BY t.date DESC
");
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
						<?php echo addslashes($ligne[3]); ?>
					</td>
				</tr>


				<?php
			}
			echo '</tbody>';
			echo '</table>';

			?>
			<br>
			<center><input name="b3" type="submit" class="btn btn-success" value="Zurück" id="b3"></center>
			<br>


			<?php

			$requete = 'SELECT * FROM `school`';
			$result = mysqli_query($cn, $requete);
			$ecole = mysqli_fetch_array($result);
			?>

</form>
</section>


<?php
include 'menubottom.php';
?>
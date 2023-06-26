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


<form id="form1" name="form1" method="post">
	<?php
	$dr = mysqli_query($cn, "SELECT concat(s.name, ' ', s.firstname) as student, l.niveauE, l.niveauG  
FROM testline l, student s
WHERE s.code=l.student AND
l.test='" . $_SESSION['test'] . "'
");
	$ligne = mysqli_fetch_array($dr);
	?>
	<BR>
	<table width="700" border="2" align="center" class="table-style-two">
		<tbody>
			<tr>
				<th><b>Schülername</b></th>
				<th><b>Punkte</b></th>
				<th><b>Niveau</b></th>
			</tr>

			<?php

			$dr = mysqli_query($cn, "SELECT concat(s.name, ' ', s.firstname) as student, l.point, l.niveau  
FROM testline l, student s
WHERE s.code=l.student AND
l.test='" . $_SESSION['test'] . "'
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
				</tr>
				<?php
			}
			echo '</tbody>';
			echo '</table>';

			?>
			<br>
			<center><input type="submit" id="b1" name="b1" value="Zurück" /></center>
			<?php
			if (isset($_POST['b1'])) {
				print "<script>window.location='testlist.php';</script>";
			}
			?>

</form>
</section>


<?php
include 'menubottom.php';
?>
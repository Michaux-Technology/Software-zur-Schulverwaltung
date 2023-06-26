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
	$dr = mysqli_query($cn, "SELECT name, firstname, birthdate FROM student WHERE code='" . addslashes($_SESSION['student']) . "'");
	$ligne = mysqli_fetch_array($dr);
	$student = addslashes($ligne[0]) . " " . addslashes($ligne[1]);

	$level = mysqli_query($cn, "SELECT glevel from level");
	$lignelevel = mysqli_fetch_array($level);


	?>


	<div id="global2">
		<center><b>
				<h2>Zeugnis</h2>
			</b></center><br>
	</div>
	<div id="global"> <br>

		<div class="container">
			für <b>
				<?php echo $student; ?>
			</b><br>
			geboren am <b>
				<?php echo addslashes($ligne[2]) ?>
			</b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
			Klasse&nbsp; &nbsp;&nbsp;
			<?php echo $_SESSION['classe']; ?>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
			<?php echo $_SESSION['semester']; ?>&nbsp;Jahr&nbsp;
			<?php echo $_SESSION['year']; ?>
		</div>
	</div>
	<br>
	<br>
	<br>
	<br>
	<?php

	if (isset($_POST['b3'])) {
		print "<script>window.location='studentaverage.php';</script>";
	}

	// requete sql
	$query = "SELECT coursename, average, niveau, niveauG, course 
FROM averagetotal 

WHERE student ='" . addslashes($_SESSION['student']) . "'
AND semester='" . addslashes($_SESSION['semester']) . "' AND year='" . addslashes($_SESSION['year']) . "' AND classe='" . addslashes($_SESSION['classe']) . "'
ORDER BY course ASC";
	$result = mysqli_query($cn, $query);

	$level = mysqli_query($cn, "SELECT glevel from level");
	$lignelevel = mysqli_fetch_array($level);


	echo '<div class="container">';
	echo '<table width="80%" border="2" align="center" class="table-style-two"><thead>';
	echo '<th><b> Fach </b></th>';
	echo '<th><b> Punkt </b></th>';
	echo '<th><b> Note </b></th>';
	echo '<th><b> Zusatzinformation </b></th>';
	echo '</thead>';


	while ($row = mysqli_fetch_array($result)) {
		echo '<tr>';
		echo '<td>';
		echo addslashes($row[0]);
		echo '</td>';
		echo '<td>';
		echo addslashes($row[1]);
		echo '</td>';
		echo '<td>';
		echo addslashes($row[2]);
		echo '</td>';
		echo '<td>';
		if ($row[3] == 0) {
			echo '';
		} else {
			echo addslashes($lignelevel[0]) . '-Note';
		}
		echo '</td>';
		echo '</tr>';

	}
	echo '</table>';
	echo '</div>';

	?>


	<br><br><br><br><br>
	<div id="global2">
		<center><input name="b3" type="submit" class="btn btn-success" value="Zurück" id="b3"></center>
	</div>
	<br>
	<div class="container">
	<a href="../tcpdf/zeugnisstudent.php?student=<?php echo $_SESSION['student'] ?>&semester=<?php echo $_SESSION['student'] ?>&year=<?php echo $_SESSION['year'] ?>&semester=<?php echo $_SESSION['semester'] ?>&classe=<?php echo $_SESSION['classe'] ?>"
				target="_blank"><img src='../img/pdf2.png' alt='pdf' WIDTH=35 HEIGHT=40 /></a>&nbsp;&nbsp;&nbsp; Zeugnis mit
			Acrobat Reader drucken.
		<br><br>
	</div>

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
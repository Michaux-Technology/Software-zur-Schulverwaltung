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
$_SESSION['i'] = 0;
?>



<section>
	<div class="col-lg-12 text-center">
		<h2>Ihre Schülerliste</h2>
	</div>

	<form id="form1" name="form1" method="post">


		<table width="80%" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<th><b>Code</b></th>
					<th><b>Nachname</b></th>
					<th><b>Vorname</b></th>
					<th width="50"></th>
					<th width="50"></th>
					<th width="50"></th>
				</tr>

				<?php

				if (isset($_POST['submit'])) {

					$dr = mysqli_query($cn, "SELECT * from registration where student='" . addslashes($_POST['submit']) . "'");
					$ligne = mysqli_fetch_array($dr);

					if (!empty($ligne)) {
						echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Kann nicht gelöscht werden: Es sind Registrierung(en) für diesen Schüler gespeichert. </center></b></font><br>";
					} else {
						$dr = mysqli_query($cn, "DELETE FROM student where code='" . addslashes($_POST['submit']) . "'");
					}

				}



				$dr = mysqli_query($cn, "SELECT * FROM student WHERE user ='" . addslashes($_SESSION['login']) . "'");

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
						<td> &nbsp;&nbsp;<button type="submit" name="submit2" value="<?php echo $ligne[0]; ?>"
								class="btImg"><img src="../img/b_search.png" /></button></td>
						<td> &nbsp;&nbsp;<button type="submit" name="submit3" value="<?php echo $ligne[0]; ?>"
								class="btImg"><img src="../img/b_edit.png" /></button></td>
						<td> &nbsp;&nbsp;<button type="submit" name="submit" value="<?php echo $ligne[0]; ?>"
								class="btImg"><img src="../img/b_drop.png" /></button></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php

		if (isset($_POST['submit2'])) {
			$_SESSION['i'] = 2;
			$_SESSION['codestudent'] = addslashes($_POST['submit2']);
			print "<script>window.location='student.php';</script>";
		}

		if (isset($_POST['submit3'])) {
			$_SESSION['i'] = 3;
			$_SESSION['codestudent'] = addslashes($_POST['submit3']);
			print "<script>window.location='student.php';</script>";
		}

		?>
	</form>
</section>



<?php
include 'menubottom.php';
?>
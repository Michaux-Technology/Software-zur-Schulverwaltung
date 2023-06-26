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
	<h2>Nutzer</h2>
</div>

<form id="form1" name="form1" method="post">

	<table width="300" border="0" align="center">

		<td>Nachname oder Vorname des Nutzers:</td>

		<td><input type="text" name="t1" id="t1" size="19"
				value="<?php if (isset($_POST['t1'])) {
					echo $_POST['t1'];
				} ?>" style="width:170px;"></td>
		<td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Suchen">&nbsp;&nbsp;&nbsp;&nbsp;<input
				name="b3" type="submit" id="b3" class="btn btn-success" value="Neu"></td>
		</tr>
	</table>
	<br>
	<?php
	if (isset($_POST['b2']) or isset($_POST['submit']) or isset($_POST['submit3'])) {

		?>
		<table width="700" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<th><b>Nutzer</b></th>
					<th><b>Nachname</b></th>
					<th><b>Vorname</b></th>
					<th><b>Profil</b></th>
					<th width=50></th>
					<th width=50></th>
					<th width=50></th>
				</tr>

				<?php
	}

	if (isset($_POST['submit'])) {

		if ($_SESSION['Prof'] == '1') {
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color = red> Diese Funktion ist nur für Administratoren </font></b>';
		} else {


			$dr = mysqli_query($cn, "SELECT * from test WHERE prof='" . addslashes($_POST['submit']) . "'");
			$ligne = mysqli_fetch_array($dr);

			if (!empty($ligne)) {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Kann nicht gelöscht werden: Es sind Prüfung(en) für diese Lehrer(in) gespeichert. </center></b></font><br>";
			} else {

				$dr = mysqli_query($cn, "SELECT * from student WHERE user='" . addslashes($_POST['submit']) . "'");
				$ligne = mysqli_fetch_array($dr);

				if (!empty($ligne)) {
					echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Kann nicht gelöscht werden: Es sind Schüler(innen) für diese Nutzer(in) gespeichert. </center></b></font><br>";
				} else {

					$dr = mysqli_query($cn, "DELETE FROM users WHERE Login='" . addslashes($_POST['submit']) . "'");
				}
			}

		}
	}
	if (isset($_POST['submit3'])) {

		if ($_SESSION['Prof'] == '1') {
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color = red> Diese Funktion ist nur für Administratoren </font></b>';
		} else {
			$dr = mysqli_query($cn, "select * from users 
	where login='" . addslashes($_POST['submit3']) . "' and open='1'");
			$resultat = mysqli_fetch_array($dr);

			if (!$resultat) {
				$dr = mysqli_query($cn, "UPDATE users SET open='1' WHERE login='" . addslashes($_POST['submit3']) . "'");

			} else {
				$dr = mysqli_query($cn, "UPDATE users SET open='0' WHERE login='" . addslashes($_POST['submit3']) . "'");
			}

		}
	}

	if (isset($_POST['submit2'])) {

		if ($_SESSION['Prof'] == '1') {
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color = red> Diese Funktion ist nur für Administratoren </font></b>';
		} else {
			$_SESSION['i'] = "0"; // if modification
			$_SESSION['submit2'] = addslashes($_POST['submit2']);
			print "<script>window.location='user2.php';</script>";
		}

	}

	if (isset($_POST['b3'])) {

		if ($_SESSION['Prof'] == '1') {
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color = red> Diese Funktion ist nur für Administratoren </font></b>';
		} else {
			$_SESSION['submit2'] = '';
			$_SESSION['i'] = "1"; // if new user
			print "<script>window.location='user2.php';</script>";
		}

	}

	if (isset($_POST['b2']) or isset($_POST['submit']) or isset($_POST['submit3'])) {

		$linepropage = 20;

		$retour_page = mysqli_query($cn, "SELECT count(u.login) as loginuser FROM users u, usertype t 
 WHERE u.Prof=t.code AND 
 
 concat(nom, ' ', prenom) like '%" . addslashes($_POST['t1']) . "%'");


		$data_page = mysqli_fetch_assoc($retour_page);
		$total = $data_page['loginuser'];

		$numberofpages = ceil($total / $linepropage);

		if (isset($_GET['loginuser'])) {
			$Actuelpage = intval($_GET['loginuser']);

			if ($Actuelpage > $numberofpages) {
				$Actuelpage = $numberofpages;
			}
		} else {
			$Actuelpage = 1;
		}

		$Firstentree = ($Actuelpage - 1) * $linepropage;




		$dr = mysqli_query($cn, "SELECT u.login, u.nom, u.prenom, t.name, u.open  
 FROM users u, usertype t 
 WHERE u.Prof=t.code AND 
 concat(nom, ' ', prenom) like '%" . addslashes($_POST['t1']) . "%' 
 LIMIT " . $Firstentree . ", " . $linepropage . "");

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
						<td width=50> &nbsp;&nbsp;<button type="Submit" name="submit3" value="<?php echo $ligne[0]; ?>"
								class="btImg"> <?php if ($ligne[4] == 1) {
									echo "<img src='../img/gut.png' />";
								} else {
									echo "<img src='../img/nichtgut.png' />";
								} ?> </button></td>
						<td width=50> &nbsp;&nbsp;<button type="Submit" name="submit2" value="<?php echo $ligne[0]; ?>"
								class="btImg"><img src="../img/b_search.png" /></button></td>
						<td width=50> &nbsp;&nbsp;<button type="Submit" name="submit" value="<?php echo $ligne[0]; ?>"
								class="btImg"><img src="../img/b_drop.png" /></button></td>
					</tr>

					<?php
		}
		echo '</tbody>';
		echo '</table>';

		// Pied de page
	

		echo '<BR><font size=2><p align="center">Seite : ';
		for ($i = 1; $i <= $numberofpages; $i++) {

			if ($i == $Actuelpage) {
				echo ' [ ' . $i . ' ] ';
			} else {
				echo ' <a href="user.php?page=' . $i . '">' . $i . '</a> ';
			}
		}
		echo '</p></font>';
	}
	?>
</form>



<?php
include 'menubottom.php';
?>
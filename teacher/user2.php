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

include '../log.php';
$log = mysqli_query($cn, "INSERT INTO security (date, hour, ip, computer, col1, success, page) values ('" . $date . "','" . $hour . "','" . $ip_address . "', '" . $os . "','" . addslashes($_SESSION['login']) . "','1','.../teacher/user2.php')");

if ($_SESSION['Prof'] == '1') {
	print "<script>window.location='user.php';</script>";
} else {
	?>

	<script type="text/javascript">
		function showDiv(elem) {
			if (elem.value == 1) {
				document.getElementById('email').style.visibility = "visible";
				document.getElementById('myText').style.visibility = "visible";
			}
			else {
				if (elem.value == 2) {
					document.getElementById('email').style.visibility = "visible";
					document.getElementById('myText').style.visibility = "visible";
				}
				else {
					document.getElementById('email').style.visibility = "hidden";
					document.getElementById('myText').style.visibility = "hidden";
				}
			}
		}

	</script>

	<div class="col-lg-12 text-center">
		<h2>Benutzer</h2>
	</div>
	<br><br><br><br>
	<form id="form1" name="form1" method="post">

		<?php $dr = mysqli_query($cn, "SELECT * FROM users WHERE login='" . addslashes($_SESSION['submit2']) . "'");
		$ligne = mysqli_fetch_array($dr);
		?>

		<table width="700" border="0" align="center">
			<tr>

				<td>Nutzer:</td>

				<?php

				if ($_SESSION['i'] == '0') {
					echo '<td>' . addslashes($ligne[0]) . '</td>';
					$login = addslashes($ligne[0]);
				} else {
					echo '<td><input type="text" name="t1" id="t1" maxlength="15" value="';
					echo '"style="width:200px;"></td>';
				}

				?>

				<td>Name:</td>
				<td><input type="text" name="t2" id="t2" value="<?php if ($_SESSION['i'] == '0') {
					echo addslashes($ligne[2]);
				} else {
					echo ' ';
				} ?>" style="width:200px;">
				</td>
			</tr>
			<tr>
				<td>Passwort:</td>
				<td><input type="password" name="t3" id="t3" maxlength="15" value="" style="width:200px;"></td>
				<td>Vorname:</td>
				<td><input type="text" name="t4" id="t4" value="<?php if ($_SESSION['i'] == '0') {
					echo addslashes($ligne[3]);
				} ?>" style="width:200px;">
				</td>

			</tr>
			<tr>

				<td>Profil:</td>
				<td><select name="c2" id="c2" style="width:170px;" onclick="showDiv(this)">


						<?php

						$requete = 'SELECT * FROM `usertype`';
						$result = mysqli_query($cn, $requete);
						while ($type = mysqli_fetch_array($result)) {
							$selectionnee = ($type[0] == $ligne[4]) ? " SELECTED " : "";
							echo "<option value='", addslashes($type['code']), "' $selectionnee >", addslashes($type['name']), '</option>';
						}
						?>
					</select></td>
				<td>
					<div id='myText' style="visibility:hidden;">E-Mail:</div>
				</td>
				<td><input type="text" value="<?php echo addslashes($ligne[5]); ?>" name="email" id="email"
						style="visibility:hidden; width:200px;" /></td>
			</tr>

		</table>
		<br>
		<center><input name="b3" type="submit" value="Abbrechen" id="b3">&nbsp;&nbsp;<input name="b2" type="submit"
				value="Bestätigen" id="b2"></center>



		<?php

		// New User
		if (isset($_POST['b3'])) {
			print "<script>window.location='user.php';</script>";
		}
		if (isset($_POST['b2'])) {

			if (addslashes($_POST['t2']) == '' or addslashes($_POST['t3']) == '' or addslashes($_POST['t4']) == '') {
				echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			} else {
				if ((addslashes($_POST['c2']) == '1' or addslashes($_POST['c2']) == '2') and addslashes($_POST['email']) == '') {
					echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
				} else {
					$date = date("Y-m-d");
					if ($_SESSION['i'] == '0') {
						$dr = mysqli_query($cn, "UPDATE users SET pwd='" . hash('sha512', addslashes($_POST['t3'])) . "', nom='" . $_POST['t2'] . "', prenom='" . $_POST['t4'] . "', Prof='" . $_POST['c2'] . "', email='" . $_POST['email'] . "', datepwd='" . $date . "'  WHERE login='" . $login . "'");
						print "<script>window.location='user.php';</script>";
					} else {
						$dr = mysqli_query($cn, "select * from users where login='" . $_POST['t1'] . "'");
						$resultat = mysqli_fetch_array($dr);
						if ($resultat != 0) {
							echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Dieses Wunsch-Login ist bereits vergeben. </center></b></font><br>";

						} else {
							$dr = mysqli_query($cn, "INSERT INTO users (login, pwd, nom, prenom, Prof, email, datepwd, open) VALUES ('" . $_POST['t1'] . "', '" . hash('sha512', addslashes($_POST['t3'])) . "', '" . $_POST['t2'] . "', '" . $_POST['t4'] . "', '" . $_POST['c2'] . "', '" . $_POST['email'] . "', '" . $date . "', '1')");
							print "<script>window.location='user.php';</script>";
						}
					}
				}
			}
		}
		?>
		<br>

	</form>
	</section>
	<script type="text/javascript">
		var e = document.getElementById('c2');
		var lehrer = e.options[e.selectedIndex].value;

		if (lehrer == 1) {
			document.getElementById('email').style.visibility = "visible";
			document.getElementById('myText').style.visibility = "visible";
		}
		else {
			if (lehrer == 2) {
				document.getElementById('email').style.visibility = "visible";
				document.getElementById('myText').style.visibility = "visible";
			}
			else {
				document.getElementById('email').style.visibility = "hidden";
				document.getElementById('myText').style.visibility = "hidden";
			}
		}
	</script>

	<?php
}
include 'menubottom.php';
?>
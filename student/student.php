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
		<h2>Schülerbogen</h2>
	</div>

	<form id="form1" name="form1" method="post">

		<?php


		if (isset($_POST['submit'])) {
			$requete = "SELECT classe FROM `registration` WHERE code='" . addslashes($_POST['submit']) . "'";
			$result = mysqli_query($cn, $requete);
			$ligne = mysqli_fetch_array($result);

			if (addslashes($ligne[0]) == '') {
				$requete = "DELETE FROM `registration` WHERE code='" . $_POST['submit'] . "'";
				$dr = mysqli_query($cn, $requete);
			} else {
				echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Eine bereits bestätigte Anmeldung kann nicht gelöscht werden.</center></b></font><br>";
			}
			$_SESSION['i'] = 2;
		}

		if (isset($_POST['b2'])) {
			if (addslashes($_POST['c1']) == '' or addslashes($_POST['c2']) == '' or addslashes($_POST['c3']) == '') {
			} else {

				$dr2 = mysqli_query($cn, "SELECT * 
FROM registration
WHERE semester='" . addslashes($_POST['c2']) . "' 
AND year='" . addslashes($_POST['c1']) . "' 
AND student='" . addslashes($_SESSION['codestudent']) . "'");
				$ligne2 = mysqli_fetch_array($dr2);

				if (empty($ligne2)) {

					$requete = "INSERT INTO registration VALUES ('','" . addslashes($_POST['c1']) . "','" . addslashes($_POST['c2']) . "','','" . addslashes($_SESSION['codestudent']) . "','" . addslashes($_POST['c3']) . "')";
					$result = mysqli_query($cn, $requete);
				} else {

					$requete = "UPDATE registration SET classerequired='" . addslashes($_POST['c3']) . "'
WHERE semester='" . addslashes($_POST['c2']) . "' 
AND year='" . addslashes($_POST['c1']) . "' 
AND student='" . addslashes($_SESSION['codestudent']) . "'";
					$result = mysqli_query($cn, $requete);

				}

			}
			$_SESSION['i'] = 2;



		}

		$requete = "SELECT * FROM `student` WHERE code='" . addslashes($_SESSION['codestudent']) . "'";
		$result = mysqli_query($cn, $requete);
		$ligne = mysqli_fetch_array($result);

		if ($_SESSION['i'] == 0) {
			?>
			<table width="80%" border="0" align="center">
				<tr>
					<td><b>Nachname:</b></td>
					<td><input type="text" name="t1" id="t1"
							value="<?php if (isset($_POST['t1'])) {
								echo $_POST['t1'];
							} else {
								echo 'Name';
							} ?>"
							style="width:200px;"></td>
					<td><b>E-mail :</b></td>
					<td><input type="text" name="t3" id="t3"
							value="<?php if (isset($_POST['t3'])) {
								echo $_POST['t3'];
							} else {
								echo 'E-Mail';
							} ?>"
							style="width:200px;"></td>
				</tr>
				<tr>
					<td><b>Vorname:</b></td>
					<td><input type="text" name="t2" id="t2"
							value="<?php if (isset($_POST['t2'])) {
								echo $_POST['t2'];
							} else {
								echo 'Vorname';
							} ?>"" style="
							width:200px;"></td>

					<td><b>Telefon:</b></td>
					<td><input type="text" name="t4" id="t4"
							value="<?php if (isset($_POST['t4'])) {
								echo $_POST['t4'];
							} else {
								echo 'Telefon';
							} ?>"
							style="width:200px;"></td>
				</tr>
				<tr>
					<td><b>Geburtsdatum:</b></td>
					<td><input type="date" name="t9" id="t9"
							value="<?php if (isset($_POST['t9'])) {
								echo $_POST['t9'];
							} else {
								echo 'jj/mm/aaaa';
							} ?>"
							style="width:200px;"></td>
				</tr>
				<tr>
					<td><b>Adresse:</b></td>
					<td><input type="text" name="t5" id="t5"
							value="<?php if (isset($_POST['t5'])) {
								echo $_POST['t5'];
							} else {
								echo 'Adresse';
							} ?>"
							style="width:200px;"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="text" name="t6" id="t6"
							value="<?php if (isset($_POST['t6'])) {
								echo $_POST['t6'];
							} else {
								echo 'PLZ';
							} ?>"
							style="width:60px;"><input type="text" name="t7" id="t7"
							value="<?php if (isset($_POST['t7'])) {
								echo $_POST['t7'];
							} else {
								echo 'Stadt';
							} ?>"
							style="width:140px;"></td>
					<td></td>
					<td><input name="b3" type="submit" class="btn btn-success" class="btn btn-success" value="Bestätigen"
							id="b3"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="text" name="t8" id="t8"
							value="<?php if (isset($_POST['t8'])) {
								echo $_POST['t8'];
							} else {
								echo 'Land';
							} ?>"
							style="width:200px;"></td>
					<td></td>
					<td></td>
				</tr>
			</table>

		<?php
		}

		if (isset($_POST['b3'])) {

			if ($_POST['t1'] == 'Name' or $_POST['t2'] == 'Vorname' or $_POST['t3'] == 'E-Mail' or $_POST['t4'] == 'Telefon' or $_POST['t5'] == 'Adresse' or $_POST['t6'] == 'Postleitzahl' or $_POST['t7'] == 'Stadt' or $_POST['t8'] == 'Land' or $_POST['t9'] == '') {
				echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
			} else {
				$email = $_POST['t3'];
				$domain = explode('@', $_POST['t3']);

				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					if (checkdnsrr($domain[1])) {

						if ($_SESSION['i'] == 3) {
							$requete = "UPDATE student SET  name='" . addslashes($_POST['t1']) . "', firstname='" . addslashes($_POST['t2']) . "', birthdate='" . addslashes($_POST['t9']) . "', adresse='" . addslashes($_POST['t5']) . "', cp='" . addslashes($_POST['t6']) . "', city='" . addslashes($_POST['t7']) . "', state='" . addslashes($_POST['t8']) . "', email='" . addslashes($_POST['t3']) . "', telephone='" . addslashes($_POST['t4']) . "' WHERE code='" . addslashes($_SESSION['codestudent']) . "'";
							$result = mysqli_query($cn, $requete);
						}

						if ($_SESSION['i'] == 0 or $_SESSION['i'] == '') {
							$requete = "INSERT INTO student VALUES ('', '" . addslashes($_POST['t1']) . "', '" . addslashes($_POST['t2']) . "', '" . addslashes($_POST['t5']) . "', '" . addslashes($_POST['t6']) . "', '" . addslashes($_POST['t7']) . "', '" . addslashes($_POST['t8']) . "', '" . addslashes($_POST['t3']) . "', '" . addslashes($_POST['t4']) . "', '" . addslashes($_SESSION['login']) . "', '" . addslashes($_POST['t9']) . "')";
							$result = mysqli_query($cn, $requete);
						}
						$_SESSION['i'] = 0;
						print "<script>window.location='studentlist.php';</script>";

					} else {
						echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> falsch E-mail. </center></b></font><br>";
					}
				} else {
					echo "<br><center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> falsch E-mail. </center></b></font><br>";
				}
			}
		}

		if ($_SESSION['i'] == 3) {
			?>

			<table width="80%" border="0" align="center">
				<tr>
					<td><b>Nachname:</b></td>
					<td><input type="text" name="t1" id="t1" value="<?php echo addslashes($ligne[1]); ?>"
							style="width:200px;"></td>
					<td><b>E-mail :</b></td>
					<td><input type="text" name="t3" id="t3" value="<?php echo addslashes($ligne[7]); ?>"
							style="width:200px;"></td>
				</tr>
				<tr>
					<td><b>Vorname:</b></td>
					<td><input type="text" name="t2" id="t2" value="<?php echo addslashes($ligne[2]); ?>"
							style="width:200px;"></td>

					<td><b>Telefon:</b></td>
					<td><input type="text" name="t4" id="t4" value="<?php echo addslashes($ligne[8]); ?>"
							style="width:200px;"></td>
				</tr>
				<tr>
					<td><b>Geburtsdatum:</b></td>
					<td><input type="date" name="t9" id="t9" value="<?php echo addslashes($ligne[10]); ?>"
							style="width:200px;"></td>
				</tr>
				<tr>
					<td><b>Adresse:</b></td>
					<td><input type="text" name="t5" id="t5" value="<?php echo addslashes($ligne[3]); ?>"
							style="width:200px;"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="text" name="t6" id="t6" value="<?php echo addslashes($ligne[4]); ?>"
							style="width:60px;"><input type="text" name="t7" id="t7"
							value="<?php echo addslashes($ligne[5]); ?>" style="width:140px;"></td>
					<td></td>
					<td><input name="b3" type="submit" class="btn btn-success" value="Bestätigen" id="b3"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="text" name="t8" id="t8" value="<?php echo addslashes($ligne[6]); ?>"
							style="width:200px;"></td>
					<td></td>
					<td></td>
				</tr>
			</table>


			<?php
		}

		if ($_SESSION['i'] == 2) {
			?>
			<table width="80%" border="0" align="center">
				<tr>
					<td><b>Nachname:</b></td>
					<td>
						<?php echo addslashes($ligne[1]); ?>
					</td>
					<td><b>E-mail :</b></td>
					<td>
						<?php echo addslashes($ligne[7]); ?>
					</td>
				</tr>
				<tr>
					<td><b>Vorname:</b></td>
					<td>
						<?php echo addslashes($ligne[2]); ?>
					</td>

					<td><b>Telefon:</b></td>
					<td>
						<?php echo addslashes($ligne[8]); ?>
					</td>
				</tr>
				<tr>
					<td><b>Geburtsdatum:</b></td>
					<td>
						<?php echo addslashes($ligne[10]); ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><b>Adresse:</b></td>
					<td>
						<?php echo addslashes($ligne[3]); ?>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php echo addslashes($ligne[4]); ?>
						<?php echo addslashes($ligne[5]); ?>
					</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php echo addslashes($ligne[6]); ?>
					</td>
					<td></td>
					<td></td>
				</tr>
			</table>

			<?php
		}

		$requete = "SELECT * FROM registration WHERE student='" . addslashes($_SESSION['codestudent']) . "'";
		$dr = mysqli_query($cn, $requete);

		if ($_SESSION['i'] == 3 or $_SESSION['i'] == 2) {
			?>
			<br>
			<center><b>Anmeldungsliste</b></center>
			<table width="50%" border="2" align="center" class="table-style-two">
				<tr>
					<th>Jahr</th>
					<th>Schulhalbjahr</th>
					<th>gewünschte Klasse</th>
					<th>akzeptiert in Klasse</th>
					<th width='50'></th>
				</tr>
				<?php

				while ($ligne = mysqli_fetch_array($dr)) {
					?>
					<tr>
						<td>
							<?php echo addslashes($ligne[1]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[2]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[5]); ?>
						</td>
						<td>
							<?php echo addslashes($ligne[3]); ?>
						</td>
						<td> &nbsp;&nbsp;<button type="submit" name="submit" value="<?php echo $ligne[0]; ?>" class="btImg"><img
									src="../img/b_drop.png" /></button></td>
					</tr>
					<?php
				}
				?>

			</table>
			<br>
			<?php
		}

		if ($_SESSION['i'] == 3 or $_SESSION['i'] == 2) {
			?>

			<center><b>Eine Anmeldung hinzufügen</b></center>
			<table width="50%" border="2" align="center" class="table-style-two">
				<tr>
					<th>Jahr</th>
					<th>Schulhalbjahr</th>
					<th>gewünschte Klasse</th>
					<th></th>
				</tr>
				<tr>
					<td> <select name="c1" style="width:170px;">

							<?php

							$requete = 'SELECT years FROM `years` order by years desc';
							$result = mysqli_query($cn, $requete);

							$requeteActuelle = 'SELECT year FROM `reference`';
							$resultAct = mysqli_query($cn, $requeteActuelle);
							$selecAct = mysqli_fetch_array($resultAct);



							while ($ligne = mysqli_fetch_array($result)) {
								if (!empty($_POST["c1"])) {
									$selectionnee = ($ligne[0] == $_POST["c1"]) ? " SELECTED " : "";
								} else {
									$selectionnee = ($ligne[0] == $selecAct[0]) ? " SELECTED " : "";
								}

								echo "<option value='", addslashes($ligne['years']), "' $selectionnee >", addslashes($ligne['years']), '</option>';

							}

							?>
						</select></td>
					<td> <select name="c2" style="width:170px;">


							<?php

							$requete = 'SELECT semester FROM `semester`';
							$result = mysqli_query($cn, $requete);

							$requeteActuelle = 'SELECT semester FROM `reference`';
							$resultAct = mysqli_query($cn, $requeteActuelle);
							$selecAct = mysqli_fetch_array($resultAct);


							while ($ligne = mysqli_fetch_array($result)) {

								if (!empty($_POST["c2"])) {
									$selectionnee = ($ligne[0] == $_POST["c2"]) ? " SELECTED " : "";
								} else {
									$selectionnee = ($ligne[0] == $selecAct[0]) ? " SELECTED " : "";
								}

								echo "<option value='", addslashes($ligne['semester']), "' $selectionnee >", addslashes($ligne['semester']), '</option>';
							}

							?>
						</select></td>
					<td> <select name="c3" style="width:170px;">
							<option value="">Wählen Sie aus</option>

							<?php
							$requete = 'SELECT code FROM classerequired';
							$result = mysqli_query($cn, $requete);
							while ($ligne = mysqli_fetch_array($result)) {
								$selectionnee = ($ligne[0] == $_POST["c3"]) ? " SELECTED " : "";
								echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", addslashes($ligne['code']), '</option>';
							}
							?>
						</select></td>
					<td><input name="b2" type="submit" class="btn btn-success" value="Hinzufügen" id="b2"></td>
				</tr>
			</table>
			<?php
			//$_SESSION['i']=0;
		}

		?>
	</form>
</section>



<?php
include 'menubottom.php';
?>
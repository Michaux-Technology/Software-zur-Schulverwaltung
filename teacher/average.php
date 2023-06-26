<?php

//========================================================================
// Author:  Valéry Jérôme Michaux
// Resume:  http://michaux.link
//
// Copyright (c) 2017 Valéry Jérôme Michaux
//
// Published under the OpenSource license with restiction : 
https://github.com/michaux4/SchoolManagementSoftware
//          Consider it as a proof of concept!
//          No warranty of any kind.
//          Use and abuse at your own risks.
//========================================================================

include 'menuhead.php';
?>


<section>
	<div class="col-lg-12 text-center">
		<h2>Zeugnis erstellen</h2>
	</div>
	<form id="form1" name="form1" method="post">
		<br>
		<table width="300" border="0" align="center">

			<td>Jahr</td>
			<td>
				<select name="c1" style="width:170px;">

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
				</select>


				&nbsp;
			</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Schulhalbjahr</td>
				<td><select name="c2" style="width:170px;">


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
					</select>
				<td>&nbsp;</td>
			</tr>

			<tr>
				<td>Klasse</td>
				<td><select name="c3" style="width:170px;">
						<option value="">Wählen Sie aus</option>
						<?php
						$requete = 'SELECT classe FROM `classe` ORDER BY id ASC';
						$result = mysqli_query($cn, $requete);
						while ($ligne = mysqli_fetch_array($result)) {
							$selectionnee = ($ligne[0] == $_POST["c3"]) ? " SELECTED " : "";
							echo "<option value='", addslashes($ligne['classe']), "' $selectionnee >", addslashes($ligne['classe']), '</option>';
						}
						?>
					</select>
					&nbsp;</td>
				<td><input name="b2" type="submit" class="btn btn-success" value="Bestätigen" id="b2"></td>
			</tr>
		</table>
		<br>
		<?php

		// DEBUT - PREMIER LANCEMENT ///////////////////////////////////////////////////////////////////////////////////////////////
		
		if (isset($_POST['b2'])) {
			if (addslashes($_POST['c1']) == '' or addslashes($_POST['c2']) == '' or addslashes($_POST['c3']) == '') {
				?>
				<center><img src="../img/error.png" alt="reussi" WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b>
						<font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>
				<BR>
				<?php
			} else {
				$requete = mysqli_query($cn, "SELECT * FROM generation WHERE year='" . addslashes($_POST['c1']) . "' AND semester='" . addslashes($_POST['c2']) . "' AND classe='" . addslashes($_POST['c3']) . "'");
				$test = mysqli_fetch_array($requete);
				if (!$test) {

					//	 insertion dans average
		
					$dr = mysqli_query($cn, "SELECT t.year, t.semester, t.classe, t.course, l.student, t.worktype, ROUND(AVG(l.point)) as moyenne, c.coef
 
 FROM test t, testline l, coefwork c 
 
 WHERE t.code=l.test 
 AND c.course=t.course
 AND c.worktype=t.worktype
 AND t.semester='" . addslashes($_POST['c2']) . "' 
 AND t.year='" . addslashes($_POST['c1']) . "' 
 AND t.classe='" . addslashes($_POST['c3']) . "'
 GROUP BY l.student, t.course, t.worktype
 ");

					echo '<center><b><font color="green">1. Berechnung des Durchschnitts pro Prüfungstyp</font></b></center>';
					echo '<center><font color="green">Warten Sie das ende der Bearbeitung</font></center>';


					// Inserer dans la table AVERAGE les notes
					while ($ligne = mysqli_fetch_array($dr)) {
						$dr2 = mysqli_query($cn, "INSERT INTO average (year, semester, classe, course, student, worktype, average, coef) VALUES('" . addslashes($ligne[0]) . "', '" . addslashes($ligne[1]) . "', '" . addslashes($ligne[2]) . "', '" . addslashes($ligne[3]) . "', '" . addslashes($ligne[4]) . "', '" . addslashes($ligne[5]) . "', '" . addslashes($ligne[6]) . "', '" . addslashes($ligne[7]) . "')");
					}

					// Trouver le coefficient total par eleve et par matiere
					$requete = mysqli_query($cn, "SELECT course , sum(coef) as sumcoef, student FROM average GROUP BY student, course");

					while ($ligneCoef = mysqli_fetch_array($requete)) {
						$dr2 = mysqli_query($cn, "UPDATE average SET totalaverage='" . $ligneCoef[1] . "' WHERE student='" . $ligneCoef[2] . "' AND course='" . $ligneCoef[0] . "'");
					}


					// Trouver la note coefficienté 
					$dr2 = mysqli_query($cn, "UPDATE average SET averagecoef=average*coef/totalaverage");


					echo '<br><center><img src="../img/check.png" alt="reussi" WIDTH=25 HEIGHT=25 /></center>';
					echo '<br><center><b><font color="green">2. Berechnung des Durchschnitts pro Fach</font></b></center>';
					echo '<center><font color="green">Warten Sie das ende der Bearbeitung</font></center>';

					//// insertion de lignes dans averagetotal
		
					$dr3 = mysqli_query($cn, "SELECT a.year, a.semester, a.classe, a.course, a.student, ROUND(SUM(a.averagecoef)) as moyenne, c.coef, c.name
FROM average a, course c
 
WHERE 
a.course=c.code
AND semester='" . addslashes($_POST['c2']) . "' 
AND year='" . addslashes($_POST['c1']) . "' 
AND classe='" . addslashes($_POST['c3']) . "'
GROUP BY student, course");

					while ($ligne = mysqli_fetch_array($dr3)) {
						$dr4 = mysqli_query($cn, "INSERT INTO averagetotal (year, semester, classe, course, student, average, coef, coursename) VALUES('" . addslashes($ligne[0]) . "', '" . addslashes($ligne[1]) . "', '" . addslashes($ligne[2]) . "', '" . addslashes($ligne[3]) . "', '" . addslashes($ligne[4]) . "', '" . addslashes($ligne[5]) . "', '" . addslashes($ligne[6]) . "', '" . addslashes($ligne[7]) . "')");
					}

					//insertion d'un niveau G
		
					$niveauG = mysqli_query($cn, "select a.code, a.student, a.course, e.niveauG
FROM averagetotal a, registration r, entry e

WHERE
r.code = e.registration
AND e.course=a.course 
AND r.student = a.student
AND r.year = a.year
AND r.semester = a.semester
AND r.classe = a.classe 
AND e.niveauG = '1'
AND a.semester='" . addslashes($_POST['c2']) . "' 
AND a.year='" . addslashes($_POST['c1']) . "' 
AND a.classe='" . addslashes($_POST['c3']) . "'");

					while ($ligne = mysqli_fetch_array($niveauG)) {
						$dr4 = mysqli_query($cn, "UPDATE averagetotal SET niveauG = '1' WHERE code = '" . addslashes($ligne[0]) . "'");
					}



					// insertion d'une Note
		
					$niveau = mysqli_query($cn, "SELECT a.code, a.course, a.niveauG, a.average, 
CASE WHEN a.niveauG = '1' THEN s.niveauG ELSE s.niveauE end as niveau

FROM averagetotal a, averagescale s

WHERE a.average=s.point
AND a.semester='" . addslashes($_POST['c2']) . "' 
AND a.year='" . addslashes($_POST['c1']) . "' 
AND a.classe='" . addslashes($_POST['c3']) . "'");

					while ($ligne = mysqli_fetch_array($niveau)) {
						$dr4 = mysqli_query($cn, "UPDATE averagetotal SET niveau = '" . addslashes($ligne[4]) . "' WHERE code = '" . addslashes($ligne[0]) . "'");
					}


					$niveau = mysqli_query($cn, "SELECT code, average, coef FROM averagetotal");

					while ($ligne = mysqli_fetch_array($niveau)) {
						$averagecoef = addslashes($ligne[1]) * addslashes($ligne[2]);
						$dr4 = mysqli_query($cn, "UPDATE averagetotal SET averagecoef = '" . $averagecoef . "' WHERE code='" . addslashes($ligne[0]) . "'");
					}



					// insertion des sous-totaux
		
					$totaux = mysqli_query($cn, "SELECT a.year, a.semester, a.classe, a.student, g.code, g.name, SUM(a.coef),  SUM(a.averagecoef), ROUND(SUM(a.averagecoef)/SUM(a.coef))

FROM averagetotal a, course c, coursegroup g

WHERE a.course=c.code
AND c.coursegroup=g.code

GROUP BY a.student");

					while ($ligne = mysqli_fetch_array($totaux)) {
						$dr4 = mysqli_query($cn, "INSERT INTO averagetotal (year, semester, classe, student, course, coursename, average) VALUES ('" . addslashes($ligne[0]) . "', '" . addslashes($ligne[1]) . "', '" . addslashes($ligne[2]) . "', '" . addslashes($ligne[3]) . "', '" . addslashes($ligne[4]) . "', '" . addslashes($ligne[5]) . "', '" . addslashes($ligne[8]) . "')");
					}

					// insertion d'une Note pour les sous-totaux
		
					$niveau = mysqli_query($cn, "SELECT a.code, a.course, a.niveauG, a.average, 
CASE WHEN a.niveauG = '1' THEN s.niveauG ELSE s.niveauE end as niveau, a.niveau

FROM averagetotal a, averagescale s

WHERE a.average=s.point
AND a.semester='" . addslashes($_POST['c2']) . "' 
AND a.year='" . addslashes($_POST['c1']) . "' 
AND a.classe='" . addslashes($_POST['c3']) . "' 
AND a.niveau=''
");

					while ($ligne = mysqli_fetch_array($niveau)) {
						$dr4 = mysqli_query($cn, "UPDATE averagetotal SET niveau = '" . addslashes($ligne[4]) . "' WHERE code = '" . addslashes($ligne[0]) . "'");
					}


					//Fin de traitement
		
					echo '<br><center><img src="../img/check.png" alt="reussi" WIDTH=25 HEIGHT=25 /></center>';
					$dr5 = mysqli_query($cn, "DELETE FROM average");
					$dr6 = mysqli_query($cn, "INSERT INTO generation (year, semester, classe) VALUES ('" . addslashes($_POST['c1']) . "', '" . addslashes($_POST['c2']) . "', '" . addslashes($_POST['c3']) . "')");




				} else {
					echo '<br><center><img src="../img/error.png" alt="reussi" WIDTH=25 HEIGHT=25 /><b><font color="red">&nbsp;&nbsp;Die Zeugnisse für diesen Zeitraum und diese Klasse sind schon erstellt.<br> Wollen Sie den Vorgang wiederholen?</font></b></center>';
					echo '<br><center><input name="b3" type="submit" value="Ja" id="b3">&nbsp;&nbsp;&nbsp;<input name="b4" type="submit" value="Nein" id="b4"></center>';
				}
			}
		}
		// FIN - PREMIER LANCEMENT /////////////////////////////////////////////////////////////////////////////////////////////// 
		
		// reponse au "NON"
		
		if (isset($_POST['b4'])) {
			print "<script>window.location='average.php';</script>";
		}

		// reponse au OUI"
		

		//CALCUL DEBUT///////////////////////////////////////////////////////////////////////////////////////
		if (isset($_POST['b3'])) {

			// reinitialisation
		
			$dr7 = mysqli_query($cn, "DELETE FROM generation WHERE year='" . addslashes($_POST['c1']) . "' AND semester='" . addslashes($_POST['c2']) . "' AND classe='" . addslashes($_POST['c3']) . "'");
			$dr8 = mysqli_query($cn, "DELETE FROM averagetotal WHERE year='" . addslashes($_POST['c1']) . "' AND semester='" . addslashes($_POST['c2']) . "' AND classe='" . addslashes($_POST['c3']) . "'");


			//	 insertion dans average
		
			$dr = mysqli_query($cn, "SELECT t.year, t.semester, t.classe, t.course, l.student, t.worktype, ROUND(AVG(l.point)) as moyenne, c.coef
 
 FROM test t, testline l, coefwork c 
 
 WHERE t.code=l.test 
 AND c.course=t.course
 AND c.worktype=t.worktype
 AND t.semester='" . addslashes($_POST['c2']) . "' 
 AND t.year='" . addslashes($_POST['c1']) . "' 
 AND t.classe='" . addslashes($_POST['c3']) . "'
 GROUP BY l.student, t.course, t.worktype
 ");

			echo '<center><b><font color="green">1. Berechnung des Durchschnitts pro Prüfungstyp</font></b></center>';
			echo '<center><font color="green">Warten Sie das ende der Bearbeitung</font></center>';


			// Inserer dans la table AVERAGE les notes
			while ($ligne = mysqli_fetch_array($dr)) {
				$dr2 = mysqli_query($cn, "INSERT INTO average (year, semester, classe, course, student, worktype, average, coef) VALUES('" . addslashes($ligne[0]) . "', '" . addslashes($ligne[1]) . "', '" . addslashes($ligne[2]) . "', '" . addslashes($ligne[3]) . "', '" . addslashes($ligne[4]) . "', '" . addslashes($ligne[5]) . "', '" . addslashes($ligne[6]) . "', '" . addslashes($ligne[7]) . "')");
			}

			// Trouver le coefficient total par eleve et par matiere
			$requete = mysqli_query($cn, "SELECT course , sum(coef) as sumcoef, student FROM average GROUP BY student, course");

			while ($ligneCoef = mysqli_fetch_array($requete)) {
				$dr2 = mysqli_query($cn, "UPDATE average SET totalaverage='" . $ligneCoef[1] . "' WHERE student='" . $ligneCoef[2] . "' AND course='" . $ligneCoef[0] . "'");
			}


			// Trouver la note coefficienté 
			$dr2 = mysqli_query($cn, "UPDATE average SET averagecoef=average*coef/totalaverage");


			echo '<br><center><img src="../img/check.png" alt="reussi" WIDTH=25 HEIGHT=25 /></center>';
			echo '<br><center><b><font color="green">2. Berechnung des Durchschnitts pro Fach</font></b></center>';
			echo '<center><font color="green">Warten Sie das ende der Bearbeitung</font></center>';

			//// insertion de lignes dans averagetotal
		
			$dr3 = mysqli_query($cn, "SELECT a.year, a.semester, a.classe, a.course, a.student, ROUND(SUM(a.averagecoef)) as moyenne, c.coef, c.name
FROM average a, course c
 
WHERE 
a.course=c.code
AND semester='" . addslashes($_POST['c2']) . "' 
AND year='" . addslashes($_POST['c1']) . "' 
AND classe='" . addslashes($_POST['c3']) . "'
GROUP BY student, course");

			while ($ligne = mysqli_fetch_array($dr3)) {
				$dr4 = mysqli_query($cn, "INSERT INTO averagetotal (year, semester, classe, course, student, average, coef, coursename) VALUES('" . addslashes($ligne[0]) . "', '" . addslashes($ligne[1]) . "', '" . addslashes($ligne[2]) . "', '" . addslashes($ligne[3]) . "', '" . addslashes($ligne[4]) . "', '" . addslashes($ligne[5]) . "', '" . addslashes($ligne[6]) . "', '" . addslashes($ligne[7]) . "')");
			}

			//insertion d'un niveau G
		
			$niveauG = mysqli_query($cn, "select a.code, a.student, a.course, e.niveauG
FROM averagetotal a, registration r, entry e

WHERE
r.code = e.registration
AND e.course=a.course 
AND r.student = a.student
AND r.year = a.year
AND r.semester = a.semester
AND r.classe = a.classe 
AND e.niveauG = '1'
AND a.semester='" . addslashes($_POST['c2']) . "' 
AND a.year='" . addslashes($_POST['c1']) . "' 
AND a.classe='" . addslashes($_POST['c3']) . "'");

			while ($ligne = mysqli_fetch_array($niveauG)) {
				$dr4 = mysqli_query($cn, "UPDATE averagetotal SET niveauG = '1' WHERE code = '" . addslashes($ligne[0]) . "'");
			}



			// insertion d'une Note
		
			$niveau = mysqli_query($cn, "SELECT a.code, a.course, a.niveauG, a.average, 
CASE WHEN a.niveauG = '1' THEN s.niveauG ELSE s.niveauE end as niveau

FROM averagetotal a, averagescale s

WHERE a.average=s.point
AND a.semester='" . addslashes($_POST['c2']) . "' 
AND a.year='" . addslashes($_POST['c1']) . "' 
AND a.classe='" . addslashes($_POST['c3']) . "'");

			while ($ligne = mysqli_fetch_array($niveau)) {
				$dr4 = mysqli_query($cn, "UPDATE averagetotal SET niveau = '" . addslashes($ligne[4]) . "' WHERE code = '" . addslashes($ligne[0]) . "'");
			}


			$niveau = mysqli_query($cn, "SELECT code, average, coef FROM averagetotal");

			while ($ligne = mysqli_fetch_array($niveau)) {
				$averagecoef = addslashes($ligne[1]) * addslashes($ligne[2]);
				$dr4 = mysqli_query($cn, "UPDATE averagetotal SET averagecoef = '" . $averagecoef . "' WHERE code='" . addslashes($ligne[0]) . "'");
			}



			// insertion des sous-totaux
		
			$totaux = mysqli_query($cn, "SELECT a.year, a.semester, a.classe, a.student, g.code, g.name, SUM(a.coef),  SUM(a.averagecoef), ROUND(SUM(a.averagecoef)/SUM(a.coef))

FROM averagetotal a, course c, coursegroup g

WHERE a.course=c.code
AND c.coursegroup=g.code

GROUP BY a.student");

			while ($ligne = mysqli_fetch_array($totaux)) {
				$dr4 = mysqli_query($cn, "INSERT INTO averagetotal (year, semester, classe, student, course, coursename, average) VALUES ('" . addslashes($ligne[0]) . "', '" . addslashes($ligne[1]) . "', '" . addslashes($ligne[2]) . "', '" . addslashes($ligne[3]) . "', '" . addslashes($ligne[4]) . "', '" . addslashes($ligne[5]) . "', '" . addslashes($ligne[8]) . "')");
			}

			// insertion d'une Note pour les sous-totaux
		
			$niveau = mysqli_query($cn, "SELECT a.code, a.course, a.niveauG, a.average, 
CASE WHEN a.niveauG = '1' THEN s.niveauG ELSE s.niveauE end as niveau, a.niveau

FROM averagetotal a, averagescale s

WHERE a.average=s.point
AND a.semester='" . addslashes($_POST['c2']) . "' 
AND a.year='" . addslashes($_POST['c1']) . "' 
AND a.classe='" . addslashes($_POST['c3']) . "' 
AND a.niveau=''
");

			while ($ligne = mysqli_fetch_array($niveau)) {
				$dr4 = mysqli_query($cn, "UPDATE averagetotal SET niveau = '" . addslashes($ligne[4]) . "' WHERE code = '" . addslashes($ligne[0]) . "'");
			}


			//Fin de traitement
		
			echo '<br><center><img src="../img/check.png" alt="reussi" WIDTH=25 HEIGHT=25 /></center>';
			$dr5 = mysqli_query($cn, "DELETE FROM average");
			$dr6 = mysqli_query($cn, "INSERT INTO generation (year, semester, classe) VALUES ('" . addslashes($_POST['c1']) . "', '" . addslashes($_POST['c2']) . "', '" . addslashes($_POST['c3']) . "')");
		}
		//CALCUL FIN///////////////////////////////////////////////////////////////////////////////////////
		
		?>
		</tbody>
		</table>
	</form>
</section>


<?php
include 'menubottom.php';
?>
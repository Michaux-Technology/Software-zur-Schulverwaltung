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
	<h2>Ihre Noten pro Fach</h2>
</div>
<form id="form1" name="form1" method="post">

	<table width="300" border="0" align="center">
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
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
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Fach</td>
			<td><select name="c4" style="width:170px;">
					<option value="">Wählen Sie aus</option>

					<?php
					$requete = 'SELECT code, name FROM `course`';
					$result = mysqli_query($cn, $requete);
					while ($ligne = mysqli_fetch_array($result)) {
						$selectionnee = ($ligne[0] == $_POST["c4"]) ? " SELECTED " : "";
						echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
					}
					?>
				</select>

				&nbsp;</td>
			<td><input name="b2" type="submit" class="btn btn-success" value="Suchen" id="b2"></td>
		</tr>
	</table>
	<br>

	<?php

	if (isset($_POST['b2'])) {

		if ($_POST['c1'] == '' or $_POST['c2'] == '' or $_POST['c3'] == '' or $_POST['c4'] == '') {
			echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
		} else {


			$sql = "SELECT CONCAT(t.date,'<br>', w.name,'<br> <FONT color=#B2CFD8> id:',t.code, '</FONT>') as datecode, CONCAT(s.firstname,' ', s.name) as student, l.niveau, t.code as code 
FROM testline l, test t, registration r, entry e, student s, worktype w 
WHERE t.code=l.test AND
w.code = t.worktype AND
t.year=r.year AND
t.semester=r.semester AND
t.classe=r.classe AND
l.student=r.student AND
e.registration=r.code AND
t.course=e.course AND 
s.code=l.student AND 
t.year='" . addslashes($_POST['c1']) . "' AND 
t.semester='" . addslashes($_POST['c2']) . "' AND 
t.classe = '" . addslashes($_POST['c3']) . "' AND 
t.course= '" . addslashes($_POST['c4']) . "'
order by t.code";
			$result = mysqli_query($cn, $sql);
			$dates = array();
			$niveauEs = array();

			$result = mysqli_query($cn, $sql);
			$result2 = mysqli_query($cn, $sql);

			$data = array();
			$dates = array();

			while ($row = mysqli_fetch_array($result)) { // fetching result
				if (!isset($data[$row['student']])) {
					$data[$row['student']] = array();
				}

				if (!isset($data[$row['student']][$row['datecode']])) {
					$data[$row['student']][$row['datecode']] = array();
				}

				if (!in_array($row['datecode'], $dates)) {
					$dates[] = $row['datecode'];
				}

				$data[$row['student']][$row['datecode']] = $row['niveau'];
			}
			// var_dump($row);
			?>
			<?php
			while ($row = mysqli_fetch_array($result2)) {
				// echo "<tr>Ligne </tr>";
//foreach (array_keys($row) as $key){
// 		echo "<tr><td>&nbsp;KEY&nbsp;</td>";
// 		if(empty($key)){
// 			echo "<td>&nbsp;VIDE&nbsp;</td>";
// 		}else{
// 			echo "<td>&nbsp;".$key."&nbsp;</td>";
// 		}
// 	echo "</tr>";}
// foreach (array_values($row) as $val){
// 		echo "<tr><td>&nbsp;VAL&nbsp;</td>";
// 		if(empty($val)){
// 			echo "<td>&nbsp;VIDE&nbsp;</td>";
// 		}else{
// 			echo "<td>&nbsp;".$val."&nbsp;</td>";
// 		}
// 	echo "</tr>";}
			}
			?>
			<table width="80%" border="2" align="center" class="table-style-two">
				<thead>
					<th width="380px">
						Schüler&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</th>

					<?php foreach ($dates as $date): ?>
						<th width="50px">
							<?= $date ?>
						</th>
					<?php endforeach; ?>
				</thead>
				<tbody>

					<?php foreach ($data as $student => $entries): ?>
						<tr>
							<td>
								<?= $student ?>
							</td>

							<?php foreach ($dates as $date): ?>
								<td>
									<?= (isset($data[$student][$date]) ? $data[$student][$date] : '') ?>
								</td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
		<?php }
	} ?>
</form>

</section>



<?php
include 'menubottom.php';
?>
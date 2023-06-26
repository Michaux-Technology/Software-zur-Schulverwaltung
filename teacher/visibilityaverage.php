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


</form>
<section>
	<div class="col-lg-12 text-center">
		<h2>Zeugnisansicht</h2>
		(Zeugnisse sichtbar machen)
	</div><br><br><br><br><br>
	<form id="form1" name="form1" method="post">

		<table width="300" border="2" align="center" class="table-style-two">
			<tbody>
				<tr>
					<th><b>Code</b></th>
					<th><b>Jahr</b></th>
					<th><b>Schulhalbjahr</b></th>
					<th><b>Klasse</b></th>
					<th width="130"><b>Sichtbar machen</b></th>
				</tr>

				<?php
				if (isset($_POST['submit'])) {

					$dr = mysqli_query($cn, "select * from generation 
	where code = '" . $_POST['submit'] . "'");
					$resultat = mysqli_fetch_array($dr);

					if ($resultat[4] == 0) {
						$dr = mysqli_query($cn, "UPDATE generation SET visibility='1' WHERE code ='" . addslashes($_POST['submit']) . "'");
					} else {
						$dr = mysqli_query($cn, "UPDATE generation SET visibility='0' WHERE code ='" . addslashes($_POST['submit']) . "'");
					}


					$dr = mysqli_query($cn, "SELECT * from generation");
				}

				$dr = mysqli_query($cn, "SELECT * from generation");
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
						<td> &nbsp;&nbsp;<button type="submit" name="submit" value="<?php echo $ligne[0]; ?>"
								class="btImg"><img src=<?php if (addslashes($ligne[4]) == '0') {
									echo "../img/b_drop.png";
								} else {
									echo "../img/s_success.png";
								} ?> /></button></td>
					</tr>

					<?php

				}


				?>
			</tbody>
		</table>

	</form>
</section>



<?php
include 'menubottom.php';
?>
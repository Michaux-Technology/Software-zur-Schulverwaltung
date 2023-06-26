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
		<h2>Ihre Nachrichten</h2>
	</div>

	<div class="container well">
		<br><br><br>

		<?php

		$requete = 'SELECT * FROM `message`';
		$result = mysqli_query($cn, $requete);
		$ligne = mysqli_fetch_array($result);

		$text = $ligne[1];
		$healthy = array("'");
		$yummy = array("&apos;");
		$text = str_replace($healthy, $yummy, $text);


		?>

		<h4>
			<font>
				<?php echo addslashes($text); ?>
			</font>
			<h4>

	</div>
	</form>
</section>


<?php
include 'menubottom.php';
?>
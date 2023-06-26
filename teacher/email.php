<?php

//========================================================================
// Author:  Val�ry J�r�me Michaux
// Resume:  http://cafe-lingua.org
//
// Copyright (c) 2017 Val�ry J�r�me Michaux
//
// Published under the OpenSource license with restiction : https://github.com/michaux4/SchoolManagementSoftware
//          Consider it as a proof of concept!
//          No warranty of any kind.
//          Use and abuse at your own risks.
//========================================================================


include 'menuhead.php';
?>
<div class="col-lg-12 text-center">
	<h2>E-Mail</h2>
</div>
<br><br><br><br>
<form id="form1" name="form1" method="post">
	<?php
	$destinataire = $_SESSION['destination'];
	$expediteur = $_SESSION['email'];
	$reponse = $expediteur;
	echo '<center><b><font color="green">E-mail(s) envoy�(s)</font></b></center>';
	mail(
		$destinataire,
		$_SESSION['note'],
		$_SESSION['messageemail'],
		"From: $expediteur\r\nReply-To: $reponse"
	);
	?>
</form>
<?php
include 'menubottom.php';
?>
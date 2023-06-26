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


$_SESSION["login"] = NULL;
$_SESSION["nomlogin"] = NULL;
$_SESSION["prenomlogin"] = NULL;
session_destroy();
print "<script>window.location='index.php';</script>";
//include('index.php');
?>
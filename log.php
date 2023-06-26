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

//date heure Log
$date = date("Y-m-d");
$hour = date("H:i:s");

//IP log
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
  $ip_address = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ip_address = $_SERVER['REMOTE_ADDR'];
}


// OS log
$user_agent = getenv("HTTP_USER_AGENT");

if (strpos($user_agent, "Win") !== FALSE)
  $os = "Windows";
elseif ((strpos($user_agent, "Mac") !== FALSE) || (strpos($user_agent, "PPC") !== FALSE))
  $os = "Mac";
elseif (strpos($user_agent, "Linux") !== FALSE)
  $os = "Linux";
elseif (strpos($user_agent, "FreeBSD") !== FALSE)
  $os = "FreeBSD";
elseif (strpos($user_agent, "SunOS") !== FALSE)
  $os = "SunOS";
elseif (strpos($user_agent, "IRIX") !== FALSE)
  $os = "IRIX";
elseif (strpos($user_agent, "BeOS") !== FALSE)
  $os = "BeOS";
elseif (strpos($user_agent, "OS/2") !== FALSE)
  $os = "OS/2";
elseif (strpos($user_agent, "AIX") !== FALSE)
  $os = "AIX";
else
  $os = "sonstig";


?>
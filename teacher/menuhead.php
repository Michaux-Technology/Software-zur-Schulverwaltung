<?php
session_start();
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

include '../connexion.php';
if (isset($_SESSION['login'])) {
  if ($_SESSION['Prof'] == '0') {
    print "<script>window.location='homestudent.php';</script>";
    include('homestudent.php');
  }
} else {
  print "<script>window.location='/index.php';</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>School Management</title>


  <link rel="stylesheet" href="../css/bootstrap.css">

</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myDefaultNavbar1">
          <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
          <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="homeprof.php">School Management Software</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="myDefaultNavbar1">
        <ul class="nav navbar-nav">
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Schüler<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="studentlist.php">Schülerliste pro Fach</a></li>
              <li><a href="studentlist2.php">Schülerliste pro Klasse</a></li>
              <li class="divider"></li>
              <li><a href="studentadclasse.php">Schüler einer Klasse zuordnen</a></li>
              <li><a href="studentadcourse.php">Schüler einem Fach zuordnen</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Anmeldungen<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="registrationexpectation.php">Anmeldungen pro Warteliste</a></li>
              <li><a href="registrationclasse.php">Anmeldungen pro Klasse</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Hausaufgabe<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="homeworkad.php">Hausaufgabe hinzufügen</a></li>
              <li><a href="homeworklist.php">Hausaufgabenliste pro Klasse</a></li>
              <li><a href="homeworklistcourse.php">Hausaufgabenliste pro Fach</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Noten<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="gradecourse.php">Ihre Noten pro Fach</a></li>
              <li><a href="studentgrade.php">Ihre Noten pro Schüler</a></li>
              <li class="divider"></li>
              <li><a href="testad.php">Prüfung hinzufügen</a></li>
              <li><a href="testlist.php">Prüfungsliste</a></li>
              <li><a href="visibility.php">Prüfungsansicht</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Zeugnisse<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="average.php">Zeugnis erstellen</a></li>
              <li><a href="visibilityaverage.php">Zeugnisansicht</a></li>
              <li><a href="studentaverage.php">Zeugnisliste</a></li>
            </ul>
          </li>

          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Anwesenheit<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <!-- <li><a href="planning.php">Kontrolle der Planung</a></li> -->
              <li><a href="presencecontrol.php">Anwesenheitskontrolle</a></li>
              <li><a href="presenceclass.php">Anwesenheits pro Klass</a></li>
              <li><a href="presencestudent.php">Anwesenheits pro Schuler</a></li>
            </ul>
          </li>


          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Parameterdarstellungen<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="profcourse.php">Fach einem Lehrer zuordnen</a></li>
              <li class="divider"></li>
              <li><a href="worktype.php">Prüfungstyp</a></li>
              <li><a href="coefwork.php">Gewichtung der Noten nach Prüfungstyp</a></li>
              <li class="divider"></li>
              <li><a href="worktypescale.php">Umrechnungstabelle nach Fach</a></li>
              <li><a href="averagescale.php">Umrechnungstabelle allegemein</a></li>
              <li><a href="level.php">Niveaus</a></li>
              <li class="divider"></li>
              <li><a href="Coefcourse.php">Fächer</a></li>
              <li><a href="coursegroup.php">Fächergruppe</a></li>
              <li class="divider"></li>
              <li><a href="school.php">Schule</a></li>
              <li><a href="user.php">Nutzer</a></li>
              <li><a href="reference.php">Aktuelles Jahr und Semester</a></li>
              <li class="divider"></li>
              <li><a href="interface.php">Benutzeroberfläche</a></li>
              <li><a href="message.php">Nachricht</a></li>
              <li class="divider"></li>
              <li><a href="security.php">Sicherheitslog</a></li>
              <li><a href="backup.php">Backup</a></li>
            </ul>
          </li>
          <li class="active"><a href="logout.php">Abmeldung<span class="sr-only">(current)</span></a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <section>
    <?php
    $requete = 'SELECT * FROM `interface`';
    $result = mysqli_query($cn, $requete);
    $interf = mysqli_fetch_array($result);
    ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h1>
            <?php echo addslashes($interf[1]); ?>
          </h1>
          <p>
            <?php echo addslashes($interf[2]); ?>
          </p>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container well">

      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="media">
            <div class="media-body">

              <h2 class="media-heading">Willkommen<br>
                <tr>
                  <?php echo $_SESSION['prenomlogin'] . '&nbsp;' . $_SESSION['nomlogin']; ?>
              </h2>

              <table width="300" border="0">
                <tbody>
                  <tr>
                    <th scope="row">&nbsp;</th>
                    <td><br></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>


                </tbody>
              </table>



              .
            </div>

          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="media">
            <div class="media-body">
              <h2 class="media-heading">✅
                <?php echo addslashes($interf[3]); ?>
              </h2>
              <?php echo addslashes($interf[5]); ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="media">
            <div class="media-body">
              <h2 class="media-heading">✅
                <?php echo addslashes($interf[4]); ?>
              </h2>
              <?php echo addslashes($interf[5]); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
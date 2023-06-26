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

  <!-- Bootstrap -->
  <link rel="stylesheet" href="../css/bootstrap.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myDefaultNavbar1">
          <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
          <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="homestudent.php">School Management Software</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="myDefaultNavbar1">
        <ul class="nav navbar-nav">
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Anmeldungen<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="studentlist.php">Ihre Schülerliste</a></li>
              <li><a href="student.php">Schüler hinzufügen</a></li>
              <li><a href="registration.php">Anmeldungsliste</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Hausaufgabe<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="homeworklist.php">Hausaufgabenliste pro Klasse</a></li>
              <li><a href="homeworklistcourse.php">Hausaufgabenliste pro Fach</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Noten<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="studentgrade.php">Notenliste</a></li>
            </ul>
          </li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" aria-expanded="false" role="button"
              data-toggle="dropdown">Zeugnisse<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="studentaverage.php">Zeugnisliste</a></li>
            </ul>
          </li>

          <li class="active"><a href="logout.php">Anmeldung<span class="sr-only">(current)</span></a></li>
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
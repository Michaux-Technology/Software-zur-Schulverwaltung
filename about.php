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

include 'connexion.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>School Management</title>


  <link rel="stylesheet" href="css/bootstrap.css">

</head>

<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myDefaultNavbar1">
          <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
          <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="index.php">School Management Software</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="myDefaultNavbar1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Schüler <span class="sr-only">(current)</span></a></li>
          <li class="active"><a href="#">Lehrer <span class="sr-only">(current)</span></a></li>
          <li class="active"><a href="about.php">Über uns<span class="sr-only">(current)</span></a></li>
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
              <h2 class="media-heading">✅ Login</h2>
              <form action="" method="post">
                <table width="300" border="0">
                  <tbody>
                    <tr>
                      <th scope="row"><label for="textfield5">Nutzer </label></th>
                      <td><input type="text" name="t1" id="t1"><br></td>
                    </tr>
                    <tr>
                      <th scope="row"><label for="textfield7">Passwort </label></th>
                      <td><input type="password" name="t2" id="t2"><br></td>
                    </tr>


                  </tbody>
                </table>
                <input type="submit" name="b1" id="b1" class="btn btn-success" value="Einloggen">
                <?php if (isset($_POST['b1'])) {
                  $dr = mysqli_query($cn, "select * from users where login='" . addslashes($_POST['t1']) . "' and pwd='" . hash('sha512', addslashes($_POST['t2'])) . "'");
                  $resultat = mysqli_fetch_array($dr);


                  include 'log.php';

                  if ($resultat != 0) {
                    $log = mysqli_query($cn, "INSERT INTO security (date, hour, ip, computer, col1, success, page) values ('" . $date . "','" . $hour . "','" . $ip_address . "', '" . $os . "','" . addslashes($_POST['t1']) . "','1','.../index.php')");
                    $_SESSION['login'] = addslashes($_POST['t1']);

                    $_SESSION['nomlogin'] = addslashes($resultat['nom']);
                    $_SESSION['prenomlogin'] = addslashes($resultat['prenom']);
                    $_SESSION['Prof'] = addslashes($resultat['Prof']);
                    $_SESSION['email'] = addslashes($resultat['email']);

                    if (addslashes($resultat['open']) == '1') {

                      if ($_SESSION['Prof'] == '1' or $_SESSION['Prof'] == '2') {
                        print "<script>window.location='./teacher/homeprof.php';</script>";
                      }
                      if ($_SESSION['Prof'] == '0') {
                        print "<script>window.location='./student/homestudent.php';</script>";
                      }

                      print "<script>window.location='homestudent.php';</script>";
                    } else {
                      echo '<b><font color = red> &nbsp;&nbsp;&nbsp;Ihr Login ist leider nicht <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;mehr nutzbar </font></b>';
                    }
                  } else {

                    $log = mysqli_query($cn, "INSERT INTO security (date, hour, ip, computer, col1, success, page) values ('" . $date . "','" . $hour . "','" . $ip_address . "', '" . $os . "','" . addslashes($_POST['t1']) . "','0','.../index.php')");
                    echo '<b><font color = red> &nbsp;&nbsp;&nbsp;Login leider nicht <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;erfolgreich </font></b>';
                  }
                }
                ?>
              </form>

              <?php
              $requete = 'SELECT * FROM `interface`';
              $result = mysqli_query($cn, $requete);
              $interf = mysqli_fetch_array($result);
              ?>

            </div>

          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="media">
            <div class="media-body">
              <h2 class="media-heading">
                ✅
                <?php echo addslashes($interf[3]); ?>
              </h2>
              <?php echo addslashes($interf[5]); ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="media">
            <div class="media-body">
              <h2 class="media-heading">
                ✅
                <?php echo addslashes($interf[4]); ?>
              </h2>
              <?php echo addslashes($interf[5]); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br><br>
  <div class="container well">
    <section>

<p>School Management Software wurde von Valery-Jerome Michaux entwickelt, einem Dozenten und Lehrer für Französisch als Fremdsprache und Softwareexperten.</p>

<p>Diese Software steht unter einer Open-Source-Lizenz mit Einschränkungen zur Verfügung:
<br>
- Die Software ist für Schulen mit voller Finanzierung durch die Region oder/und den Staat kostenlos. Für andere Schulen fragen Sie bitte nach dem Preis.<br>
- Jede Verbesserung des Quellcodes muss uns mitgeteilt werden, damit wir die Verbesserungen an die Gemeinschaft weitergeben können. <br>
- Die Software darf nur durch Herunterladen aus unserem Downloadbereich zugänglich gemacht werden.<br>
- Der Name der Software und des Erstellers dürfen nicht verändert oder gelöscht werden und müssen daher für die Nutzer immer sichtbar bleiben.<br> 
- Die Installation muss entweder von der Schule selbst für den Eigenbedarf oder von einer von Valery-Jérôme Michaux autorisierten Person durchgeführt werden. Alle diesbezüglichen Anfragen können an folgende Adresse gesendet werden: michaux [at] free.fr.<br>
- Pro Schule ist nur ein Exemplar zulässig.</p>

<p>Valery-Jerome Michaux haftet nicht für eventuelle Datenverluste, Programmierfehler oder Sicherheitsprobleme.</p>
<br><br>
      installiert Version: 2.4.0<br>
      Made in Germany<br>
      <b>Valery-Jerome Michaux</b>
  </div>
  <br><br><br>

  </section>

  <?php

  $requete = 'SELECT * FROM `school`';
  $result = mysqli_query($cn, $requete);
  $ecole = mysqli_fetch_array($result);
  ?>
  <div class="section well2">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <h3 class="text-center">
            <?php echo addslashes($ecole[4]); ?>
          </h3>
          <address class="text-center">
            <strong>
              <?php echo addslashes($ecole[5]); ?>
            </strong><br>
            <?php echo addslashes($ecole[6]); ?><br>
            <?php echo addslashes($ecole[7]); ?>
            <?php echo addslashes($ecole[9]); ?><br>
          </address>
        </div>
        <div class="col-lg-4 col-md-4">
          <h3 class="text-center">
            <?php echo addslashes($ecole[0]); ?>
          </h3>
          <address class="text-center">
            <strong>
              <?php echo addslashes($ecole[1]); ?>
            </strong><br>
            <?php echo addslashes($ecole[3]); ?><br>
            <?php echo addslashes($ecole[2]); ?>
            <?php echo addslashes($ecole[8]); ?><br>
          </address>
        </div>
        <div class="col-lg-4 col-md-4">
          <h3 class="text-center">NEWSLETTER</h3>
          <form>
            <div class="form-group col-lg-9 col-md-8 col-sm-10 col-xs-10">
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <button type="submit" class="btn btn-default">Subscribe<br>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <p>Copyright © 2017 Valéry-Jérôme Michaux. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
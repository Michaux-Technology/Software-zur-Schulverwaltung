<?php

//========================================================================
// Author:  Valéry Jérôme Michaux
// Resume:  http://michaux.link
//
// Copyright (c) 2017 Valéry Jérôme Michaux
//
// Published under the OpenSource license with restiction : https://github.com/michaux4/SchoolManagementSoftware
//          Consider it as a proof of concept!
//          No warranty of any kind.
//          Use and abuse at your own risks.
//========================================================================

include 'menuhead.php';
$proz = 0;
?>

<form action="" method="post">
  <div class="col-lg-12 text-center">
    <h2>Gewichtung der Noten nach Prüfungstyp</h2>
  </div>
  <table width="300" border="0" align="center">
    <tbody>
      <tr>
        <td>Fach</td>
        <td>&nbsp;</td>
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
        </td>
        <td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Suchen"></td>
      </tr>

    </tbody>
  </table>

</form>
<section>
  <br>
  <table width="300" border="2" align="center">
    <tbody>
      <tr> </tr>
    </tbody>
  </table>
  <form id="form1" name="form1" method="post">
    <?php
    if (isset($_POST['b1']) or isset($_POST['b2']) or isset($_POST['submit'])) {

      ?>

      <table width="50%" border="2" align="center" class="table-style-two">
        <tbody>
          <tr>
            <th><b>Code</b></th>
            <th><b>Name</b></th>
            <th><b>Prozent</b></th>
            <th width="100"><b></b></th>
          </tr>

          <?php
    }
    if (isset($_POST['b1'])) {
      if (addslashes($_POST['c5']) == '' or addslashes($_POST['c4']) == '' or addslashes($_POST['t1']) == '') {
        echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Alle Felder müssen ausgefüllt sein. </center></b></font><br>";
      } else {


        if ($proz < 100) {
          echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Die Summe kann nicht über 100% sein. </center></b></font><br>";
        } else {

          $dr = mysqli_query($cn, "SELECT * from coefwork WHERE worktype='" . addslashes($_POST['c5']) . "' AND course='" . addslashes($_POST['c4']) . "'");
          $ligne = mysqli_fetch_array($dr);
          if (empty($ligne)) {

            $dr = mysqli_query($cn, "INSERT INTO coefwork (worktype, course, coef) VALUES ('" . $_POST['c5'] . "', '" . $_POST['c4'] . "', '" . $_POST['t1'] . "')");
          }
        }
      }
    }

    if (isset($_POST['b2'])) {
      $dr = mysqli_query($cn, "SELECT c.code, w.name, c.coef from coefwork c, worktype w where c.worktype=w.code AND course='" . $_POST['c4'] . "'");
    }
    if (isset($_POST['submit'])) {

      $requete = "SELECT t.code, c.worktype  FROM test t, coefwork c WHERE c.worktype=t.worktype AND c.code='" . addslashes($_POST['submit']) . "'";
      $result = mysqli_query($cn, $requete);
      $ligne = mysqli_fetch_array($result);

      if (!empty($ligne)) {
        echo "<center><img src='../img/error.png' alt='reussi' WIDTH=25 HEIGHT=25 />&nbsp;&nbsp;<b><font color='red'> Dieser Prüfungstyp wird für die Prüfungen benutzt. Er kann nicht gelöscht werden. </center></b></font><br>";
      } else {
        $dr = mysqli_query($cn, "DELETE FROM coefwork WHERE code ='" . addslashes($_POST['submit']) . "'");
      }

    }

    if (isset($_POST['b1']) or isset($_POST['b2']) or isset($_POST['submit'])) {
      $dr = mysqli_query($cn, "SELECT c.code, w.name, c.coef from coefwork c, worktype w where c.worktype=w.code AND course='" . $_POST['c4'] . "'");
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
              <?php $proz = $proz + $ligne[2]; ?>
              <td>
                <center><button type="submit" name="submit" value="<?php echo $ligne[0]; ?>" class="btImg"> <img
                      src="../img/b_drop.png" /></button></center>
              </td>
            </tr>

            <?php
      }
    }
    ?>
      </tbody>
    </table>

    <br><br>
    <?php
    //echo $proz;
    if (isset($_POST['b1']) or isset($_POST['b2']) or isset($_POST['submit'])) {
      ?>
      <center><b>Prüfungstyp Hinzufügen</b></center>
      <table width="40%" border="2" align="center" class="table-style-two">
        <tbody>
          <tr>

            <th><b>Fach</b></th>
            <th><b>Prüfungstyp</b></th>
            <th><b>Prozent</b></th>

          </tr>
          <tr>

            <td><select name="c4">
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

            <td><select name="c5">
                <option value="">Wählen Sie aus</option>
                <?php
                $requete = 'SELECT code, name FROM `worktype`';
                $result = mysqli_query($cn, $requete);
                while ($ligne = mysqli_fetch_array($result)) {
                  $selectionnee = ($ligne[0] == $_POST["c5"]) ? " SELECTED " : "";
                  echo "<option value='", addslashes($ligne['code']), "' $selectionnee >", $ligne['name'], '</option>';
                }
                ?>
              </select>
            </td>
            <td><input name="t1" type="texte" id="t1" size="3"></td>
            <td><input name="b1" type="submit" id="b1" class="btn btn-success" value="Hinzufügen"></td>
          </tr>
        </tbody>
      </table>
      <?php
    }
    ?>

  </form>
</section>


<?php
include 'menubottom.php';
?>
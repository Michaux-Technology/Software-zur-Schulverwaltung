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
     <h2>Sicherheitslog</h2><br> <br>
</div>

<form id="form1" name="form1" method="post">

     <table width="300" border="0" align="center">
          <tr>
               <td><select name="c1" style="width:170px;">
                         <option <?php if (isset($_POST['c1'])) {
                              if ($_POST['c1'] == ".../index.php")
                                   echo 'selected';
                         } ?> value=".../index.php">Login</option>
                         <option <?php if (isset($_POST['c1'])) {
                              if ($_POST['c1'] == ".../teacher/testad.php")
                                   echo 'selected';
                         } ?> value=".../teacher/testad.php">Prüfung hinzufügen</option>
                         <option <?php if (isset($_POST['c1'])) {
                              if ($_POST['c1'] == ".../teacher/user2.php")
                                   echo 'selected';
                         } ?> value=".../teacher/user2.php">Nutzer hinzufügen</option>
                    </select></td>
               <td><input name="b1" type="submit" id="b1" class="btn btn-success" value="Suchen"></td>
               <td><input name="b2" type="submit" id="b2" class="btn btn-success" value="Löschen (mehr als 30 Tage)">
               </td>
          </tr>
     </table>
     <br>
     <?php

     if (isset($_POST['b2'])) {
          $date = date("Y-m-d"); //
          $date = strtotime(date("Y-m-d", strtotime($date)) . " - 30 day");


          $dr = mysqli_query($cn, "DELETE FROM security WHERE date < '" . date("Y-m-d", $date) . "'");

     }

     if (isset($_POST['b2']) or isset($_POST['b1'])) {
          $selected_val = $_POST['c1'];


          ?>
          <table width="700" border="2" align="center" class="table-style-two">
               <tbody>
                    <tr>
                         <th><b>Datum</b></th>
                         <th><b>Uhr</b></th>
                         <th><b>IP</b></th>
                         <th><b>Computer</b></th>
                         <th><b>Login</b></th>
                         <th><b>Seite</b></th>
                         <th width=50><b>Erfolg</b></th>
                    </tr>

                    <?php


                    // pagination
               
                    $linepropage = 50;

                    $retour_page = mysqli_query($cn, "SELECT COUNT(*) AS code FROM security WHERE page='" . $selected_val . "'");
                    $data_page = mysqli_fetch_assoc($retour_page);
                    $total = $data_page['code'];

                    $numberofpages = ceil($total / $linepropage);

                    if (isset($_GET['page'])) {
                         $Actuelpage = intval($_GET['page']);

                         if ($Actuelpage > $numberofpages) {
                              $Actuelpage = $numberofpages;
                         }
                    } else {
                         $Actuelpage = 1;
                    }

                    $Firstentree = ($Actuelpage - 1) * $linepropage;


                    //Requete
                    $dr = mysqli_query($cn, "SELECT * FROM security WHERE page='" . $selected_val . "' ORDER BY DATE DESC, HOUR DESC LIMIT " . $Firstentree . ", " . $linepropage . "");

                    while ($ligne = mysqli_fetch_array($dr)) {
                         ?>
                         <tr>
                              <td>
                                   <?php echo addslashes($ligne[1]); ?>
                              </td>
                              <td>
                                   <?php echo addslashes($ligne[2]); ?>
                              </td>
                              <td>
                                   <?php echo addslashes($ligne[3]); ?>
                              </td>
                              <td>
                                   <?php echo addslashes($ligne[4]); ?>
                              </td>
                              <td>
                                   <?php echo addslashes($ligne[5]); ?>
                              </td>
                              <td>
                                   <?php echo addslashes($ligne[7]); ?>
                              </td>
                              <td width=50> &nbsp;&nbsp; <?php if ($ligne[6] == 0) {
                                   echo "<img src='../img/b_drop.png' />";
                              } else {
                                   echo "<img src='../img/s_success.png' />";
                              } ?></button></td>
                         </tr>

                         <?php
                    }

                    echo '</tbody>';
                    echo '</table>';

                    // Pied de page
               

                    echo '<BR><font size=2><p align="center">Seite : ';
                    for ($i = 1; $i <= $numberofpages; $i++) {

                         if ($i == $Actuelpage) {
                              echo ' [ ' . $i . ' ] ';
                         } else //Sinon...
                         {
                              echo ' <a href="security.php?page=' . $i . '">' . $i . '</a> ';
                         }
                    }
                    echo '</p></font>';

     }






     ?>
</form>



<?php
include 'menubottom.php';
?>
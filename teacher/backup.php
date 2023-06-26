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

include 'menuhead.php';

?>


<section>
    <div class="col-lg-12 text-center">
        <h2>
            <center>Backup - Wiederherstellen</center>
        </h2>
    </div>

    <?php
    if ($_SESSION['Prof'] == '1') {
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font color = red> Diese Funktion ist nur für Administratoren </font></b><br><br><br>';
    } else {
        ?>



        <div>
            <form action="" method="post">
                <br><br><br>

                <center>
                    <table width="200">
                        <tr>
                            <td><b> Datenbank Backup </b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input name="b1" type="submit" id="b1" class="btn btn-success" value="speichern"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input name="b2" type="submit" id="b2" class="btn btn-danger"
                                    value="Backup Dateien  im Server löschen"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td><b> Datenbank Wiederherstellen </b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input type="file" name="backup_file" /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="restore" class="btn btn-success" value="Wiederherstellen" /></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </center>

        </div>

        <?php
        if (isset($_POST['b1'])) {


            // Get connection object and set the charset
    
            $cn->set_charset("utf8");


            // Get All Table Names From the Database
            $tables = array();
            $sql = "SHOW TABLES";
            $result = mysqli_query($cn, $sql);

            while ($row = mysqli_fetch_row($result)) {
                $tables[] = $row[0];
            }



            $sqlScript = "";
            foreach ($tables as $table) {

                // Prepare SQLscript for creating table structure
                $query = "SHOW CREATE TABLE $table";
                $result = mysqli_query($cn, $query);
                $row = mysqli_fetch_row($result);

                $sqlScript .= "\n\n" . $row[1] . ";\n\n";


                $query = "SELECT * FROM $table";
                $result = mysqli_query($cn, $query);

                $columnCount = mysqli_num_fields($result);

                // Prepare SQLscript for dumping data for each table
                for ($i = 0; $i < $columnCount; $i++) {
                    while ($row = mysqli_fetch_row($result)) {
                        $sqlScript .= "INSERT INTO $table VALUES(";
                        for ($j = 0; $j < $columnCount; $j++) {
                            $row[$j] = $row[$j];

                            if (isset($row[$j])) {
                                $sqlScript .= '"' . $row[$j] . '"';
                            } else {
                                $sqlScript .= '""';
                            }
                            if ($j < ($columnCount - 1)) {
                                $sqlScript .= ',';
                            }
                        }
                        $sqlScript .= ");\n";
                    }
                }

                $sqlScript .= "\n";
            }

            if (!empty($sqlScript)) {
                // Save the SQL script to a backup file
                $backup_file_name = '../download/SMS_backup_' . date('Y-m-d') . '_' . time() . '.sql';
                $fileHandler = fopen($backup_file_name, 'w+');
                $number_of_lines = fwrite($fileHandler, $sqlScript);
                fclose($fileHandler);

                // Download the SQL backup file to the browser
    
                print "<script>window.location='" . $backup_file_name . "';</script>";

            }
        }

        if (isset($_POST['b2'])) {

            $dossier = "../download/";
            $ouverture = opendir($dossier);
            $fichier = readdir($ouverture);
            $fichier = readdir($ouverture);
            while ($fichier = readdir($ouverture)) {
                unlink("$dossier/$fichier");
            }
            closedir($ouverture);

        }


        if (!empty($_FILES)) {
            // Validating SQL file type by extensions
            if (
                !in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
                    "sql"
                )
                )
            ) {
                $response = array(
                    "type" => "error",
                    "message" => "Invalid File Type"
                );
            } else {
                if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
                    move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
                    $response = restoreMysqlDB($_FILES["backup_file"]["name"], $cn);
                }
            }
        }

        function restoreMysqlDB($filePath, $cn)
        {
            $sql = '';
            $error = '';

            if (file_exists($filePath)) {
                $lines = file($filePath);

                foreach ($lines as $line) {

                    // Ignoring comments from the SQL script
                    if (substr($line, 0, 2) == '--' || $line == '') {
                        continue;
                    }

                    $sql .= $line;

                    if (substr(trim($line), -1, 1) == ';') {
                        $result = mysqli_query($cn, $sql);
                        if (!$result) {
                            $error .= mysqli_error($cn) . "\n";
                        }
                        $sql = '';
                    }
                } // end foreach
    
                if ($error) {
                    $response = array(
                        "type" => "error",
                        "message" => $error
                    );
                } else {
                    $response = array(
                        "type" => "success",
                        "message" => "Database Restore Completed Successfully."
                    );
                }
                exec('rm ' . $filePath);
            } // end if file exists
    
            return $response;

        }
    }
    ?>

    <br>

    </form>
</section>


<?php

include 'menubottom.php';
?>
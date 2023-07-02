<?php

class Planning
{
    public function viewPlanning($classe, $year, $semester)
    {

        $sql = "SELECT h.hour,
			GROUP_CONCAT(CASE WHEN p.day = 'Montag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select c.name from course c where c.code =p.course ) ELSE NULL END) AS Montag,
			GROUP_CONCAT(CASE WHEN p.day = 'Montag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.code ELSE NULL END) AS MontagCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Dienstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select c.name from course c where c.code =p.course )  ELSE NULL END) AS Dienstag,
			GROUP_CONCAT(CASE WHEN p.day = 'Dienstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.code ELSE NULL END) AS DienstagCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Mittwoch' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select c.name from course c where c.code =p.course )  ELSE NULL END) AS Mittwoch,
			GROUP_CONCAT(CASE WHEN p.day = 'Mittwoch' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.code ELSE NULL END) AS MittwochCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Donnerstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select c.name from course c where c.code =p.course )  ELSE NULL END) AS Donnerstag,
			GROUP_CONCAT(CASE WHEN p.day = 'Donnerstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.code ELSE NULL END) AS DonnerstagCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Freitag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select c.name from course c where c.code =p.course )  ELSE NULL END) AS Freitag,
			GROUP_CONCAT(CASE WHEN p.day = 'Freitag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.code ELSE NULL END) AS FreitagCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Samstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select c.name from course c where c.code =p.course )  ELSE NULL END) AS Samstag,
			GROUP_CONCAT(CASE WHEN p.day = 'Samstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.code ELSE NULL END) AS SamstagCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Montag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.room ELSE NULL END) AS MontagRoom,
			GROUP_CONCAT(CASE WHEN p.day = 'Dienstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.room ELSE NULL END) AS DienstagRoom,
			GROUP_CONCAT(CASE WHEN p.day = 'Mittwoch' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.room ELSE NULL END) AS MittwochRoom,
			GROUP_CONCAT(CASE WHEN p.day = 'Donnerstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.room ELSE NULL END) AS DonnerstagRoom,
			GROUP_CONCAT(CASE WHEN p.day = 'Freitag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.room ELSE NULL END) AS FreitagRoom,
			GROUP_CONCAT(CASE WHEN p.day = 'Samstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.room ELSE NULL END) AS SamstagRoom,
			GROUP_CONCAT(CASE WHEN p.day = 'Montag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select u.nom from users u where u.login=p.prof ) ELSE NULL END) AS MontagLehrer,
			GROUP_CONCAT(CASE WHEN p.day = 'Dienstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select u.nom from users u where u.login=p.prof ) ELSE NULL END) AS DienstagLehrer,
			GROUP_CONCAT(CASE WHEN p.day = 'Mittwoch' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select u.nom from users u where u.login=p.prof ) ELSE NULL END) AS MittwochLehrer,
			GROUP_CONCAT(CASE WHEN p.day = 'Donnerstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select u.nom from users u where u.login=p.prof ) ELSE NULL END) AS DonnerstagLehrer,
			GROUP_CONCAT(CASE WHEN p.day = 'Freitag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select u.nom from users u where u.login=p.prof ) ELSE NULL END) AS FreitagLehrer,
			GROUP_CONCAT(CASE WHEN p.day = 'Samstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN (select u.nom from users u where u.login=p.prof ) ELSE NULL END) AS SamstagLehrer,

			GROUP_CONCAT(CASE WHEN p.day = 'Montag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.prof ELSE NULL END) AS MontagLehrerCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Dienstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.prof ELSE NULL END) AS DienstagLehrerCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Mittwoch' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.prof ELSE NULL END) AS MittwochLehrerCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Donnerstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.prof ELSE NULL END) AS DonnerstagLehrerCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Freitag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.prof ELSE NULL END) AS FreitagLehrerCode,
			GROUP_CONCAT(CASE WHEN p.day = 'Samstag' AND p.classe= '" . addslashes($classe) . "'  AND p.year= '" . addslashes($year) . "'  AND p.semester= '" . addslashes($semester) . "' THEN p.prof ELSE NULL END) AS SamstagLehrer
	 
	 
	 FROM hour h
	 LEFT JOIN planning p ON h.hour = p.hour
	 GROUP BY h.hour";

        return $sql;
    }

    public function countCourseRoomfHour($cn, $hour, $day, $year, $semester, $room)
    {
        $requeteControlRoom = "SELECT count(code) FROM `planning` where hour = '" . addslashes($hour) . "' and day ='" . $day . "' and semester ='" . addslashes($semester) . "' and year ='" . addslashes($year) . "' and room= '" . addslashes($room) . "'";
        $resultControlRoom = mysqli_query($cn, $requeteControlRoom);
        $ligneControlRoom = mysqli_fetch_array($resultControlRoom);
        return $ligneControlRoom;
    }
    public function countCourseProffHour($cn, $hour, $day, $year, $semester, $room, $prof)
    {
        $requeteControlProf = "SELECT count(room) FROM `planning` where hour = '" . addslashes($hour) . "' and day ='" . $day . "' and semester ='" . addslashes($semester) . "' and year ='" . addslashes($year) . "' and prof= '" . addslashes($prof) . "' and room != '" . addslashes($room) . "'";
        $resultControlProf = mysqli_query($cn, $requeteControlProf);
        $ligneControlProf = mysqli_fetch_array($resultControlProf);
        return $ligneControlProf;
    }

    public function listRoomsHour($cn, $hour, $day, $year, $semester, $room)
    {
        $requeteListeClasses = "SELECT classe FROM `planning` where hour = '" . addslashes($hour) . "' and day ='" . $day . "' and semester ='" . addslashes($semester) . "' and year ='" . addslashes($year) . "' and room= '" . addslashes($room) . "'";
        $resultListeClasses = mysqli_query($cn, $requeteListeClasses);
        $errormessage = "Raum mit mehreren Klassen: ";
        while ($ligneListeClasses = mysqli_fetch_array($resultListeClasses)) {
            $errormessage = $errormessage . $ligneListeClasses[0] . "-";
        }
        return $errormessage;

    }
    public function listCourseProfHour($cn, $hour, $day, $year, $semester, $room, $prof)
    {
        $requeteListeClassesProf = "SELECT room FROM `planning` where hour = '" . addslashes($hour) . "' and day ='" . $day . "' and semester ='" . addslashes($semester) . "' and year ='" . addslashes($year) . "' and prof= '" . addslashes($prof) . "' and room !='" . addslashes($room) . "'";
        $resultListeClassesProf = mysqli_query($cn, $requeteListeClassesProf);
        $errormessageProf = "Lehrer mit mehreren Räumen: ";
        while ($ligneListeClassesProf = mysqli_fetch_array($resultListeClassesProf)) {
            $errormessageProf = $errormessageProf . $ligneListeClassesProf[0] . "-";
        }
        return $errormessageProf;
    }
}
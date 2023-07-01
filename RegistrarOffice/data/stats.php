<?php
function getAllstats($conn){
    $sql = "SELECT
    (SELECT COUNT(*) FROM teachers) AS total_teachers,
    (SELECT COUNT(*) FROM students) AS total_students,
    (SELECT COUNT(*) FROM registrar_office) AS total_registrars,
    (SELECT COUNT(*) FROM teachers WHERE gender = 'Male') AS male_teachers,
    (SELECT COUNT(*) FROM teachers WHERE gender = 'Female') AS female_teachers,
    (SELECT COUNT(*) FROM students WHERE gender = 'Male') AS male_students,
    (SELECT COUNT(*) FROM students WHERE gender = 'Female') AS female_students,
    (SELECT COUNT(*) FROM registrar_office WHERE gender = 'Male') AS male_registrars,
    (SELECT COUNT(*) FROM registrar_office WHERE gender = 'Female') AS female_registrars;  
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() >= 1) {
      $stats = $stmt->fetchAll();
      return $stats;
    }else {
        return 0;
    }
 }

function getStatsbyYear ($year, $conn){
    $sql = "
    SELECT
    (SELECT COUNT(*) FROM teachers WHERE YEAR(date_of_joined) = $year) AS total_teachers,
    (SELECT COUNT(*) FROM students WHERE YEAR(date_of_joined) = $year) AS total_students,
    (SELECT COUNT(*) FROM registrar_office WHERE YEAR(date_of_joined) = $year) AS total_registrars,
    (SELECT COUNT(*) FROM teachers WHERE gender = 'Male' AND YEAR(date_of_joined) = $year) AS male_teachers,
    (SELECT COUNT(*) FROM teachers WHERE gender = 'Female' AND YEAR(date_of_joined) = $year) AS female_teachers,
    (SELECT COUNT(*) FROM students WHERE gender = 'Male' AND YEAR(date_of_joined) = $year) AS male_students,
    (SELECT COUNT(*) FROM students WHERE gender = 'Female' AND YEAR(date_of_joined) = $year) AS female_students,
    (SELECT COUNT(*) FROM registrar_office WHERE gender = 'Male' AND YEAR(date_of_joined) = $year) AS male_registrars,
    (SELECT COUNT(*) FROM registrar_office WHERE gender = 'Female' AND YEAR(date_of_joined) = $year) AS female_registrars;
  
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() >= 1) {
      $stats = $stmt->fetchAll();
      return $stats;
    }else {
        return 0;
    }
 }

?>
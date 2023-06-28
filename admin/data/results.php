<?php
function getAllresults($conn){
    $sql = "SELECT student_id, fname, adm_number, class_id, year, semester, SUM(total) AS total
    FROM student_results
    GROUP BY student_id, year, semester
    ORDER BY total DESC;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
 
    if ($stmt->rowCount() >= 1) {
      $students = $stmt->fetchAll();
      return $students;
    }else {
        return 0;
    }
 }

 function getAllresultsByYear($year, $conn){
    $sql = "SELECT student_id, fname, adm_number, class_id, year, semester, SUM(total) AS total
    FROM student_results
    WHERE year =?
    GROUP BY student_id, year, semester
    ORDER BY total DESC;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$year]);
 
    if ($stmt->rowCount() >= 1) {
      $students = $stmt->fetchAll();
      return $students;
    }else {
        return 0;
    }
 }

 function getAllresultsByYearandSemester($year, $semeseter, $conn){
    $sql = "SELECT student_id, fname, adm_number, class_id, year, semester, SUM(total) AS total
    FROM student_results
    WHERE year =? AND semester=?
    GROUP BY student_id, year, semester
    ORDER BY total DESC;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$year, $semeseter]);
 
    if ($stmt->rowCount() >= 1) {
      $students = $stmt->fetchAll();
      return $students;
    }else {
        return 0;
    }
 }

 function getAllresultsByClass($class, $conn){
    $sql = "SELECT student_id, fname, adm_number, class_id, year, semester, SUM(total) AS total
    FROM student_results
    WHERE class_id =?
    GROUP BY student_id, year, semester
    ORDER BY total DESC;
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class]);
 
    if ($stmt->rowCount() >= 1) {
      $students = $stmt->fetchAll();
      return $students;
    }else {
        return 0;
    }
 }

 function getPreviousSemester($current_semester) {
    if ($current_semester == "I") {
        return "I";
    } else {
        return substr($current_semester, 0, -1);
    }
}

?>
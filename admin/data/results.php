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

?>
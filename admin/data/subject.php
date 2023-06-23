<?php
// All Subjects
function getAllSubjects($conn){
    $sql = "SELECT * FROM subjects";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    if ($stmt->rowCount()>=1){
        $subjects = $stmt->fetchAll();
        return $subjects;
    }
    else{
        return 0;
    }

}



?>
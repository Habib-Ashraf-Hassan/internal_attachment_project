<?php  

// Get Teacher by ID
function getTeacherById($teacher_id, $conn){
   $sql = "SELECT * FROM teachers
           WHERE teacher_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$teacher_id]);

   if ($stmt->rowCount() == 1) {
     $teacher = $stmt->fetch();
     return $teacher;
   }else {
    return 0;
   }
}

function teacherPasswordVerify($teacher_pass, $conn, $teacher_id){
  $sql = "SELECT * FROM teachers
          WHERE teacher_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$teacher_id]);

  if ($stmt->rowCount() == 1) {
    $teacher = $stmt->fetch();
    $pass  = $teacher['password'];

    if (password_verify($teacher_pass, $pass)) {
       return 1;
    }else {
       return 0;
    }
  }else {
   return 0;
  }
}


function findCommonCharacters($str1, $str2) {
    $commonChars = array();

    $charCount1 = array_count_values(str_split($str1));
    $charCount2 = array_count_values(str_split($str2));

    foreach ($charCount1 as $char => $count) {
        if (isset($charCount2[$char])) {
            $commonChars[] = $char;
        }
    }

    return $commonChars;
}







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

// All Teachers 
function getAllTeachers($conn){
   $sql = "SELECT * FROM teachers";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $teachers = $stmt->fetchAll();
     return $teachers;
   }else {
   	return 0;
   }
}

// Check if the username Unique
function unameIsUnique($uname, $conn, $teacher_id=0){
   $sql = "SELECT username, teacher_id FROM teachers
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($teacher_id == 0) {
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      return 1;
     }
   }else {
    if ($stmt->rowCount() >= 1) {
       $teacher = $stmt->fetch();
       if ($teacher['teacher_id'] == $teacher_id) {
         return 1;
       }else {
        return 0;
      }
     }else {
      return 1;
     }
   }
   
}

// Check if the Employee number Unique
function employeeNoIsUnique($emp_no, $conn, $teacher_id=0){
  $sql = "SELECT employee_number, teacher_id FROM teachers
          WHERE employee_number=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$emp_no]);
  
  if ($teacher_id == 0) {
    if ($stmt->rowCount() >= 1) {
      return 0;
    }else {
     return 1;
    }
  }else {
   if ($stmt->rowCount() >= 1) {
      $teacher = $stmt->fetch();
      if ($teacher['teacher_id'] == $teacher_id) {
        return 1;
      }else {
       return 0;
     }
    }else {
     return 1;
    }
  }
  
}
// Check if national ID is unique
function natioanlIDIsUnique($n_id, $conn, $teacher_id=0){
  $sql = "SELECT national_id, teacher_id FROM teachers
          WHERE national_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$n_id]);
  
  if ($teacher_id == 0) {
    if ($stmt->rowCount() >= 1) {
      return 0;
    }else {
     return 1;
    }
  }else {
   if ($stmt->rowCount() >= 1) {
      $teacher = $stmt->fetch();
      if ($teacher['teacher_id'] == $teacher_id) {
        return 1;
      }else {
       return 0;
     }
    }else {
     return 1;
    }
  }
  
}

// DELETE
function removeTeacher($id, $conn){
   $sql  = "DELETE FROM teachers
           WHERE teacher_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}

// Search 
function searchTeachers($key, $conn){
   $key = preg_replace('/(?<!\\\)([%_])/', '\\\$1',$key);

   $sql = "SELECT * FROM teachers
           WHERE teacher_id LIKE ? 
           OR fname LIKE ?
           OR national_id LIKE ?
           OR username LIKE ?
           OR employee_number LIKE ?
           OR phone_number LIKE ?
           OR gender LIKE ?
           OR email_address LIKE ?
           OR address LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key, $key, $key, $key,$key, $key, $key, $key]);

   if ($stmt->rowCount() >= 1) {
     $teachers = $stmt->fetchAll();
     return $teachers;
   }else {
    return 0;
   }
}

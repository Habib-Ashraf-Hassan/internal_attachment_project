<?php  

// Get r_user by ID
function getR_usersById($r_user_id, $conn){
   $sql = "SELECT * FROM registrar_office
           WHERE r_user_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$r_user_id]);

   if ($stmt->rowCount() == 1) {
     $teacher = $stmt->fetch();
     return $teacher;
   }else {
    return 0;
   }
}

// All r_users 
function getAllR_users($conn){
   $sql = "SELECT * FROM registrar_office";
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
function unameIsUnique($uname, $conn, $r_user_id=0){
   $sql = "SELECT username, r_user_id FROM registrar_office
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($r_user_id == 0) {
     if ($stmt->rowCount() >= 1) {
       return 0;
     }else {
      return 1;
     }
   }else {
    if ($stmt->rowCount() == 1) {
       $r_user = $stmt->fetch();
       if ($r_user['r_user_id'] == $r_user_id) {
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
function removeRUser($id, $conn){
   $sql  = "DELETE FROM registrar_office
           WHERE r_user_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}

function registrarPasswordVerify($r_pass, $conn, $r_user_id){
  $sql = "SELECT * FROM registrar_office
          WHERE r_user_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$r_user_id]);

  if ($stmt->rowCount() == 1) {
    $registrar = $stmt->fetch();
    $pass  = $registrar['password'];

    if (password_verify($r_pass, $pass)) {
       return 1;
    }else {
       return 0;
    }
  }else {
   return 0;
  }
}
function adminPasswordVerify($admin_pass, $conn, $admin_id){
  $sql = "SELECT * FROM admin
          WHERE admin_id=?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$admin_id]);

  if ($stmt->rowCount() == 1) {
    $admin = $stmt->fetch();
    $pass  = $admin['password'];

    if (password_verify($admin_pass, $pass)) {
      return 1;
    }else {
      return 0;
    }
  }else {
   return 0;
  }
}
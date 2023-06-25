<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['grade_code']) &&
    isset($_POST['grade'])) {
    
    include '../../DB_connection.php';

    $grade_code = $_POST['grade_code'];
    $grade = $_POST['grade'];
    
    $data = 'grade_code='.$grade_code.'&grade='.$grade;

  if (empty($grade_code)) {
		$em  = "Class category is required";
		header("Location: ../grade-add.php?error=$em&$data");
		exit;
	}else if (empty($grade)) {
		$em  = "Class level is required";
		header("Location: ../grade-add.php?error=$em&$data");
		exit;
	}else {
        $sql  = "INSERT INTO
                 grades(grade, grade_code)
                 VALUES(?,?)";
        $stmt = $conn->prepare($sql);
        $re = $stmt->execute([$grade, $grade_code]);
        if ($re) {
          // Call the renumber_grades stored procedure
          $re = $conn->exec("CALL renumber_grades()");
          if ($re !== false) {
            $sm = "New Class created successfully";
            header("Location: ../grade-add.php?success=$sm");
            exit;
          } else {
            $em = "An error occurred";
            header("Location: ../grade-add.php?error=$em");
            exit;
          }
        } else {
          $em = "An error occurred";
          header("Location: ../grade-add.php?error=$em");
          exit;
        }
        
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../grade-add.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 

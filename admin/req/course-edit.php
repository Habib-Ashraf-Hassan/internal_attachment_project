<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['course_name']) &&
    isset($_POST['course_code']) &&
    isset($_POST['grade'])       &&
    isset($_POST['course_id'])) {
    
    include '../../DB_connection.php';

    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $course_id = $_POST['course_id'];

    $grade = "";
    foreach ($_POST['grade'] as $class) {
    	$grade .=$class;
    }

    $data = 'course_id='.$course_id;

    if (empty($course_id)) {
        $em  = "Subject id is required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "Class is required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_name)) {
        $em  = "Subject is required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_code)) {
        $em  = "Subject code is required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else {
        $sql = "UPDATE subjects SET subject=?, subject_code=?, grade=?
        WHERE subject_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$course_name,$course_code, $grade,$course_id]);
        $sm = "successfully updated!";
        header("Location: ../course-edit.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../course.php?error=$em");
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


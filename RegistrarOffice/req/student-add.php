<?php 
session_start();
if (isset($_SESSION['r_user_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Registrar Office') {
    	

if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['pass'])     &&
    isset($_POST['address'])  &&
    isset($_POST['gender'])   &&
    isset($_POST['email_address']) &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['parent_fname'])  &&
    isset($_POST['parent_phone_number']) &&
    isset($_POST['grade'])) {
    
    include '../../DB_connection.php';
    include "../data/student.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['parent_fname'];
    $parent_phone_number = $_POST['parent_phone_number'];

    $grade = $_POST['grade'];
    $subjects = "";
    
    

    $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname.'&address='.$address.'&gender='.$email_address.'&pfn='.$parent_fname.'&ppn='.$parent_phone_number;

    if (empty($fname)) {
		$em  = "First name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Last name is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Username is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Username is taken! try another";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Email address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_fname)) {
        $em  = "Parent first name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Parent phone number is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "Class is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else {
        if ($grade == 1 || $grade == 2 || $grade == 3 || $grade == 4){
            $subjects = "1234";
        }
        else if ($grade == 5 || $grade == 6 || $grade == 7){
            $subjects = "1256";
        }
        else if ($grade == 8 || $grade == 9){
            $subjects = "125678";
        }
        else{
            $subjects = "0";
        }
        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql  = "INSERT INTO
                 students(username, password, fname, admission_number, grade, subjects, address, gender, email_address, date_of_birth, parent_fname, parent_phone_number)
                 VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $fname, $lname, $grade, $subjects, $address, $gender, $email_address, $date_of_birth, $parent_fname, $parent_phone_number]);
        $sm = "New student registered successfully";
        header("Location: ../student-add.php?success=$sm");
        exit;
	}
    
  }else {
  	$em = "An error occurred";
    header("Location: ../student-add.php?error=$em");
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

<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['fname']) &&
    
    isset($_POST['username']) &&
    isset($_POST['pass'])     &&
    isset($_POST['address'])  &&
    isset($_POST['employee_number']) &&
    isset($_POST['phone_number'])  &&
    
    isset($_POST['email_address']) &&
    isset($_POST['date_of_birth'])) {
    
    include '../../DB_connection.php';
    include "../data/registrar_office.php";

    $fname = $_POST['fname'];
    
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    $address = $_POST['address'];
    $employee_number = $_POST['employee_number'];
    $phone_number = $_POST['phone_number'];
    
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];



    $data = 'uname='.$uname.'&fname='.$fname.'&address='.$address.'&en='.$employee_number.'&pn='.$phone_number.'&email='.$email_address;

    if (empty($fname)) {
		$em  = "First name is required";
		header("Location: ../registrar-office-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Username is required";
		header("Location: ../registrar-office-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Username is taken! try another";
		header("Location: ../registrar-office-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em  = "Password is required";
		header("Location: ../registrar-office-add.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($employee_number)) {
        $em  = "Employee number is required";
        header("Location: ../registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em  = "Phone number is required";
        header("Location: ../registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Email address is required";
        header("Location: ../registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender address is required";
        header("Location: ../registrar-office-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth address is required";
        header("Location: ../registrar-office-add.php?error=$em&$data");
        exit;
    }else {
        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql  = "INSERT INTO
                 registrar_office(username, password, fname, address, employee_number, date_of_birth, phone_number, gender, email_address)
                 VALUES(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $fname, $address, $employee_number, $date_of_birth, $phone_number, $gender, $email_address]);
        $sm = "New Registrar registered successfully";
        header("Location: ../registrar-office-add.php?success=$sm");
        exit;
	}
    
  }else {
  	$em = "Error! KIndly fill in all fields";
    header("Location: ../registrar-office-add.php?error=$em");
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
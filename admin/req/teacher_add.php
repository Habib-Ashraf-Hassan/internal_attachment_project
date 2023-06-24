<?php
session_start();
if (isset($_SESSION['admin_id ']) && 
    isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Admin'){
    if (isset($_POST['fname']) &&
        isset($_POST['age']) &&
        isset($_POST['username']) &&
        isset($_POST['pass']) &&
        isset($_POST['gender']) &&
        isset($_POST['subjects']) &&
        isset($_POST['grades'])){

        include "../../DB_connection.php";
        include "../data/teacher.php";

        $fname = $_POST['fname'];
        $lname = $_POST['age'];
        $uname = $_POST['username'];
        $pass = $_POST['pass'];
        $gender = $_POST['gender'];

        $subjects = "";
        foreach ($_POST['subjects'] as $subject){
            $subjects .= $subject;
        }
        $grades = "";
        foreach ($_POST['grades'] as $grade){
            $grades .= $grade;
        }
        if (empty($fname)){
            $em = "First name is required";
            header("Location: ../teacher_add.php?error=$em");
            exit;
        }
        else if (empty($lname)){
            $em = "Age name is required";
            header("Location: ../teacher_add.php?error=$em");
            exit;
        }
        else if (empty($pass)){
            $em = "Password is required";
            header("Location: ../teacher_add.php?error=$em");
            exit;
        }
        else if (empty($uname)){
            $em = "Employee no. is required";
            header("Location: ../teacher_add.php?error=$em");
            exit;
        }
        else if (empty($gender)){
            $em = "Gender is required";
            header("Location: ../teacher_add.php?error=$em");
            exit;
        }
        else if (!unameIsUnique($uname, $conn)){
            $em = "Employee No. is already taken, try another one";
            header("Location: ../teacher_add.php?error=$em");
            exit;
        }
        else{
            // Hash the password
            $real_pass = $pass;
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "INSERT INTO teachers(username, password, real_password,fname, age, gender, subjects, grades)
                    VALUES(?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$uname, $pass, $real_pass, $fname, $lname, $gender, $subjects, $grades]);

            $sm = "New teacher registered successfully :)";
            header("Location: ../teacher_add.php?success=$sm");
            exit;
        }
        


        


        
        }else{
            $em = "Ensure to fill in all the fields!";
            header("Location: ../teacher_add.php?error=$em");
            exit;
        }     
        }else{
            header("Location: ../../logout.php");
            exit;
        } 
        
        }else{
            header("Location: ../../logout.php");
            exit;
        }

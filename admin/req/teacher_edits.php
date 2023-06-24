<?php
session_start();
if (isset($_SESSION['admin_id ']) || 
    isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Admin'){
    if (isset($_POST['fname'])         &&
        isset($_POST['lname'])         &&
        isset($_POST['username'])      &&
        isset($_POST['teacher_id'])    &&
        isset($_POST['gender'])        &&
        isset($_POST['subjects'])      &&
        isset($_POST['grades'])){

        include "../../DB_connection.php";
        include "../data/teacher.php";

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
        $teacher_id = $_POST['teacher_id'];
        $gender = $_POST['gender'];

        $subjects = "";
        foreach ($_POST['subjects'] as $subject){
            $subjects .= $subject;
        }
        $grades = "";
        foreach ($_POST['grades'] as $grade){
            $grades .= $grade;
        }
        $data = 'teacher_id='.$teacher_id;
        if (empty($fname)){
            $em = "First name is required";
            header("Location: ../teacher_edit.php?error=$em&$data");
            exit;
        }
        else if (empty($lname)){
            $em = "Age name is required";
            header("Location: ../teacher_edit.php?error=$em&$data");
            exit;
        }
        
        else if (empty($uname)){
            $em = "Employee no. is required";
            header("Location: ../teacher_edit.php?error=$em&$data");
            exit;
        }
        else if (empty($gender)){
            $em = "Gender is required";
            header("Location: ../teacher_edit.php?error=$em&$data");
            exit;
        }
        else if (!unameIsUnique($uname, $conn)){
            $em = "Employee No. is already taken, try another one";
            header("Location: ../teacher_edit.php?error=$em");
            exit;
        }
        else{
            echo "okay";
        }
        


        


        
        }else{
            $em = "Ensure to fill in all the fields!";
            header("Location: ../teacher_edit.php?error=$em");
            exit;
        }     
    }else{
        header("Location: ../teacher_edit.php");
        exit;
    } 
        
}else{
    header("Location: ../teacher_edit.php");
    exit;
}

?>
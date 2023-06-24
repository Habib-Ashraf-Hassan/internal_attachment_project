<?php
session_start();
if (isset($_SESSION['admin_id ']) &&
    isset($_SESSION['role']) &&
    isset($_GET['teacher_id'])){

    if ($_SESSION['role'] == 'Admin'){

        include "../DB_connection.php";
        include "data/teacher.php";

        $id = $_GET['teacher_id'];
        if (deleteTeacher($id, $conn)){

            $sm = "Teacher deleted successfully :)";
            header("Location: teacher.php?success=$sm");
            exit;
        }
        else{
            $em = "Unknown error occured!Try again";
            header("Location: teacher.php?error=$em");
            exit;
        }

    }else{
        header("Location: teacher.php");
        exit;
    } 

}else{
    header("Location: teacher.php");
    exit;
}
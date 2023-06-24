<?php
session_start();
if (isset($_SESSION['admin_id ']) && isset($_SESSION['role'])){

    if ($_SESSION['role'] == 'Admin'){
        include "../DB_connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/grade.php";
        $teachers = getAllTeachers($conn);
        
        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Teachers</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/Madrassa_logo2.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
    <?php
        include "inc/navbar.php";

        if ($teachers != 0){

        
    ?>
    <div class="container mt-5">
        <a href="teacher_add.php" class="btn btn-dark">Add new Teacher(Maalim)</a>

        <?php 
            if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger mt-3 n-table" role="alert">
                <?=$_GET['error']?>
                </div>

        <?php  }  ?>

        <?php 
            if(isset($_GET['success'])){ ?>
                <div class="alert alert-info mt-3 n-table" role="alert">
                <?=$_GET['success']?>
                </div>

        <?php  }  ?>

        <div class="table-responsive">
        <table class="table table-bordered mt-3 n-table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Age</th>
                <th scope="col">Employee No.</th>
                <th scope="col">Date started</th>
                <th scope="col">Gender</th>
                <th scope="col">Subject teaching</th>
                <th scope="col">Classes teaching</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($teachers as $teacher){ ?>

                 
                <tr>
                    <th scope="row">1</th>
                    <td><?=$teacher['teacher_id'] ?></td>
                    <td><?=$teacher['fname'] ?></td>
                    <td><?=$teacher['age'] ?></td>
                    <td><?=$teacher['username'] ?></td>
                    <td><?=$teacher['date_of_employment'] ?></td>
                    <td><?=$teacher['gender'] ?></td>
                    <td>
                        <?php
                            $s = '';
                            $subjects = str_split(trim($teacher['subjects']));
                            
                            foreach ($subjects as $subject){
                                $s_temp = getSubjectsById($subject, $conn);
                                if ($s_temp != 0)
                                $s .= $s_temp['subject_code'].', ';
                            }
                            echo $s;
                        ?>
                    </td>
                    <td>
                    <?php
                            $g = '';
                            $grades = str_split(trim($teacher['grades']));
                            
                            foreach ($grades as $grade){
                                $g_temp = getGradeById($grade, $conn);
                                if ($g_temp != 0)
                                $g .= $g_temp['grade_code'].'-'.$g_temp['grade'].', ';
                            }
                            echo $g;
                        ?>
                    </td>
                    <!-- This is for action  -->
                    <td>
                        <a href="teacher_edit.php?teacher_id=<?=$teacher['teacher_id'] ?>" class="btn btn-warning">Edit</a>
                        <br>
                        <a href="teacher_delete.php?teacher_id=<?=$teacher['teacher_id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                    
                </tr>

                <?php  } ?>
                
            </tbody>
        </table>
        </div>
        <?php }else{ ?>
            <div class="alert alert-info .w-450 m-5" role="alert">
                Empty!
            </div>

        <?php }?>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
    <script>
        $(document).ready(function(){
               $("#navLinks li:nth-child(2) a").addClass('active'); 
            });
    </script>
</body>
</html>

<?php
}else{
    header("Location: ../login.php");
    exit;
} 

}else{
    header("Location: ../login.php");
    exit;
}

?>
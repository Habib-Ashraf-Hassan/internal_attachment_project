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
    <title>Admin - Add Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/Madrassa_logo2.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body>
    <?php
        include "inc/navbar.php";

    ?>
    <div class="container mt-5">
        <a href="teacher.php" class="btn btn-dark">Go Back</a>
        
        <form method="post" class="shadow p-3 mt-5 form-w" action="">
            <!-- <div class="text-center">
                <img src="../images/Madrassa_logo2.png" width="85" height="75">
            </div> -->
            <h3>Add New Teacher(Maalim)</h3>
            
            <div class="mb-3">
                <label class="form-label">Employee/Admission no.</label>
                <input type="text" class="form-control" name="uname">
            </div>
            
            
            
            
            <button type="submit" class="btn btn-primary">Add</button>
            
        </form>
        
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
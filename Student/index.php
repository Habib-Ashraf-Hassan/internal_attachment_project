<?php 
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/section.php";

       $student_id = $_SESSION['student_id'];

       $student = getStudentById($student_id, $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student - Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/Madrassa_logo2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
     <?php 
        if ($student != 0) {
     ?>
      <div class="row">
        <div class="col-md-6">
        <div class="container mt-5">
         <div class="card" style="width: 22rem;">
          <img src="../img/student-<?=$student['gender']?>.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center">@<?=$student['username']?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Full name: <?=$student['fname']?></li>
            
            <li class="list-group-item">Admission No.: <?=$student['admission_number']?></li>
            <li class="list-group-item">Location/Address: <?=$student['address']?></li>
            <li class="list-group-item">Date of birth: <?=$student['date_of_birth']?></li>
            <li class="list-group-item">Student/Guardian's email: <?=$student['email_address']?></li>
            <li class="list-group-item">Gender: <?=$student['gender']?></li>
            <li class="list-group-item">Date joined: <?=$student['date_of_joined']?></li>

            <li class="list-group-item">Grade: 
                 <?php 
                      $grade = $student['grade'];
                      $g = getGradeById($grade, $conn);
                      echo $g['grade_code'].'-'.$g['grade'];
                  ?>
            </li>
            
            <br><br>
            <li class="list-group-item">Parent first name: <?=$student['parent_fname']?></li>
            
            <li class="list-group-item">Parent phone number: <?=$student['parent_phone_number']?></li>
          </ul>
        </div>
     </div>

        </div>

        <div class="col-md-6">

        <div class="container mt-5">
         <div class="container text-center">
             <div class="row row-cols-5">
               <a href="grade.php" 
                  class="col btn btn-dark m-2 py-3 col-5">
                 <i class="fa fa-book fs-1" aria-hidden="true"></i><br>
                  Grade summary
               </a> 
               
               <a href="pass.php" class="col btn btn-info m-2 py-3 col-5">
                 <i class="fa fa-cogs fs-1" aria-hidden="true"></i><br>
                  Change Password
               </a> 
               <a href="../logout.php" class="col btn btn-warning m-2 py-3 col-10">
                 <i class="fa fa-sign-out fs-1" aria-hidden="true"></i><br>
                  Logout
               </a> 
             </div>
          </div>
        </div>

        </div>
      </div>
     
     <?php 
        }else {
          header("Location: student.php");
          exit;
        }
     ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
   <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
        });
    </script>
</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>
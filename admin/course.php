<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../DB_connection.php";
       include "data/subject.php";
       include "data/grade.php";
       $courses = getAllSubjects($conn);
       
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Subjects</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/Madrassa_logo2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($courses != 0) {
     ?>
     <div class="container mt-5">
        <a href="course-add.php"
           class="btn btn-dark">Add New Subjects</a>

           <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" 
                 role="alert">
              <?=$_GET['error']?>
            </div>
            <?php } ?>

          <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" 
                 role="alert">
              <?=$_GET['success']?>
            </div>
            <?php } ?>

           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Classes taught in</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($courses as $course ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td>
                      <?php 
                          echo $course['subject'];
                       ?>
                    </td>
                    <td>
                      <?php 
                          echo $course['subject_code'];
                       ?>
                    </td>
                    <td>
                      <?php
                          $g = '';
                          $grades = str_split(trim($course['grade']));
                          foreach ($grades as $grade) {
                             $g_temp = getGradeById($grade, $conn);
                             if ($g_temp != 0) 
                               $g .=$g_temp['grade_code'].'-'.$g_temp['grade'].', ';
                          }
                          echo $g; 
                          // $grade = getGradeById($course['grade'], $conn);
                          // echo $grade['grade_code'].'-'.$grade['grade'];
                       ?>
                    </td>
                    <td>
                        <a href="course-edit.php?course_id=<?=$course['subject_id']?>"
                          class="btn btn-warning">Edit</a>
                           
                        <a href="#" onclick="confirmDelete(<?=$course['subject_id']?>)" 
                          class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                Empty!
              </div>
         <?php } ?>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(7) a").addClass('active');
        });
    </script>
    <script>
      function confirmDelete(courseId) {
        if (confirm("Are you sure you want to delete this course?")) {
          // User clicked "OK" in the confirmation dialog
          // Execute the deletion code by redirecting to course-delete.php with the course_id parameter
          window.location.href = "course-delete.php?course_id=" + courseId;
        } else {
          // User clicked "Cancel" in the confirmation dialog
          // Do nothing or provide alternative action
        }
      }
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
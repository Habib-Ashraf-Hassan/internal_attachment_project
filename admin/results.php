<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/grade.php";
       include "data/results.php";
       $students = getAllresults($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Results</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../images/Madrassa_logo2.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
        if ($students != 0) {
     ?>
     <div class="container mt-5">
        
           <form action="student-search-r.php" 
                 class="mt-3 n-table"
                 method="get">
             <div class="input-group mb-3">
                
                <!-- <select class="form-control" name="searchKey"
                    placeholder="Search by duration...">
                    <option value="current_year">Current year</option>
                    <option value="current_year_current_semester">Current year, Current term</option>
                    <option value="current_year_previous_semester">Current year, previous term</option>
                    <option value="previous_year">Previous year</option>
                    
                </select> -->
                <label class="form-label">Enter Year</label>
                <input type="number" 
                 class="form-control"
                 min="2020" max="2040" value="2021"
                 name="searchKey">
                <button class="btn btn-primary">
                        <i class="fa fa-search" 
                           aria-hidden="true"></i>
                      </button>
             </div>
           </form>

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
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Admission number</th>
                    <th scope="col">Class</th>
                    <th scope="col">Year</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Total marks</th>

                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($students as $student ) { 
                    $i++;  ?>
                  <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$student['student_id']?></td>
                    <td>
                      <a href="student-view-r.php?student_id=<?=$student['student_id']?>">
                        <?=$student['fname']?>
                      </a>
                    </td>
                    <td><?=$student['adm_number']?></td>
                    <td>
                      <?php
                      $grade_id = $student['class_id'];
                      $g = "";
                      $grade = getGradeById($grade_id, $conn);
                      $g = $grade['grade_code']."-".$grade['grade'];
                      echo $g;
                      ?>
                    </td>
                    <td>
                    <?=$student['year']?>
                    </td>
                    <td>
                    <?=$student['semester']?>
                    </td>
                    <td>
                    <?=$student['total']?>
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
             $("#navLinks li:nth-child(6) a").addClass('active');
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
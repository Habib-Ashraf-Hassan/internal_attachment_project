<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['course_id'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../DB_connection.php";
       include "data/subject.php";
       include "data/grade.php";
       $course_id = $_GET['course_id'];
       $course = getSubjectById($course_id, $conn);
       $grades = getAllGrades($conn);

       if ($course == 0) {
         header("Location: section.php");
         exit;
       }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Edit Subject</title>
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
     <div class="container mt-5">
        <a href="course.php"
           class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/course-edit.php">
        <h3>Edit Subject</h3><hr>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
        <?php } ?>
        <div class="mb-3">
          <label class="form-label">Subject Name</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$course['subject']?>" 
                 name="course_name">
        </div>
        <div class="mb-3">
          <label class="form-label">Subject Code</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$course['subject_code']?>" 
                 name="course_code">
        </div>
        <div class="mb-3">
          <label class="form-label">Classes taught</label>
          <div class="row row-cols-5">
                <?php
                    $grade_ids = str_split(trim($course['grade']));
                     foreach ($grades as $grade){
                        $checked = 0;
                        foreach ($grade_ids as $grade_id){
                            if ($grade_id == $grade['grade_id']){
                                $checked = 1;
                            }
                        }
                     
                    ?>

                <div class="col">
                <input type="checkbox" name="grade[]" 
                <?php if ($checked) echo "checked"; ?>
                value="<?=$grade['grade_id']?>">
                <?=$grade['grade_code']?>-<?=$grade['grade']?>
                </div>
                <?php } ?>
            </div>
        </div>
        <input type="text" 
                 class="form-control"
                 value="<?=$course['subject_id']?>"
                 name="course_id"
                 hidden>

      <button type="submit" 
              class="btn btn-primary">
              Update</button>
     </form>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(7) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

  }else {
    header("Location: course.php");
    exit;
  } 
}else {
	header("Location: course.php");
	exit;
} 

?>